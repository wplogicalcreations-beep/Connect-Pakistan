<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Requests every GET page as the role that is allowed to see it and fails on any 5xx.
 *
 * Runs against the configured database inside a transaction that is rolled back,
 * so sample data and test users created here never persist.
 * A JSON report is written to storage/framework/testing/smoke-report.json.
 */
class RouteSmokeTest extends TestCase
{
    use DatabaseTransactions;

    /** GET routes that change state or stream files; never crawl these. */
    private const SKIP = '/logout|delete|destroy|remove|export|download|sanctum|_ignition|storage\/|up$/i';

    /** Route parameter name => table its id comes from. */
    private const PARAM_TABLES = [
        'event' => 'events',
        'space' => 'coworking_spaces',
        'job' => 'job_posts',
        'user' => 'users',
        'organization' => 'organizations',
        'lov' => 'lovs',
        'skill' => 'skills',
    ];

    /** URI prefix => table for generic {id} parameters. */
    private const ID_TABLES = [
        'co-working-space/workspace-enquiry' => 'booking_requests',
        'crm/dashboard/leads' => 'action_items',
        'events/edit-event' => 'events',
        'knowledge-base' => 'knowledge_bases',
        'knowledge' => 'knowledge_bases',
        'organizations' => 'organizations',
        'skilled-individual' => 'users',
        'user/profile/certificate' => 'certificates',
        'user/profile/education' => 'educations',
        'user/profile/experience' => 'experiences',
    ];

    private array $users = [];

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['EventSeeder', 'CoworkingSpaceSeeder', 'JobPostsTableSeeder', 'TemplatePageSettingSeeder'] as $seeder) {
            try {
                DB::transaction(fn () => $this->seed('Database\\Seeders\\' . $seeder));
            } catch (\Throwable $e) {
                fwrite(STDERR, "Seeder {$seeder} skipped: " . Str::limit($e->getMessage(), 150) . "\n");
            }
        }

        $this->users['super_admin'] = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();

        $org = User::create(['name' => 'Smoke Org', 'email' => 'smoke-org@example.test', 'phone' => '03000000000', 'is_active' => 1]);
        $org->assignRole('organization_admin');
        $org->organization()->create(['name' => 'Smoke Org Ltd', 'ceo_name' => 'Smoke Org', 'ceo_email' => $org->email, 'step' => '4']);
        $this->users['organization_admin'] = $org;

        $customer = User::create(['name' => 'Smoke Customer', 'email' => 'smoke-customer@example.test', 'phone' => '03000000001', 'is_active' => 1]);
        $customer->assignRole('customer');
        $customer->individualProfile()->create([]);
        $customer->educations()->create(['degree_type' => 'BS', 'institution' => 'Smoke Uni', 'degree_name' => 'CS', 'country_id' => DB::table('countries')->value('id'), 'start_date' => '2015-01-01', 'currently_studying' => 0]);
        $customer->experiences()->create(['job_title' => 'Dev', 'company_name' => 'Smoke Co', 'country_id' => DB::table('countries')->value('id'), 'start_date' => '2019-01-01', 'currently_working' => 1]);
        $customer->certificates()->create(['title' => 'Smoke Cert']);
        $this->users['customer'] = $customer;
    }

    public function test_every_get_page_renders_without_server_error(): void
    {
        $results = [];

        foreach ($this->targets() as [$role, $uri]) {
            if ($role !== 'guest') {
                $this->actingAs($this->users[$role]);
            } else {
                $this->app['auth']->forgetGuards();
            }

            $response = $this->get('/' . ltrim($uri, '/'));
            $status = $response->getStatusCode();
            $results[] = [
                'role' => $role,
                'uri' => $uri,
                'status' => $status,
                'error' => $status >= 500 && $response->exception
                    ? get_class($response->exception) . ': ' . Str::limit($response->exception->getMessage(), 300)
                        . ' @ ' . str_replace(base_path() . DIRECTORY_SEPARATOR, '', $response->exception->getFile()) . ':' . $response->exception->getLine()
                    : null,
            ];
        }

        file_put_contents(storage_path('framework/testing/smoke-report.json'), json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $failures = array_filter($results, fn ($r) => $r['status'] >= 500);
        $this->assertSame([], array_values($failures), count($failures) . ' of ' . count($results) . ' pages returned a server error');
    }

    /** @return array<int, array{0: string, 1: string}> [role, uri] pairs */
    private function targets(): array
    {
        $targets = [];

        foreach (RouteFacade::getRoutes() as $route) {
            /** @var Route $route */
            if (!in_array('GET', $route->methods()) || preg_match(self::SKIP, $route->uri())) {
                continue;
            }

            $role = $this->roleFor($route);

            if ($route->uri() === 'template/setting/{id}/{page}') {
                foreach (DB::table('template_page_settings')->select('template_id', 'name')->distinct()->get() as $setting) {
                    $targets[] = [$role, "template/setting/{$setting->template_id}/{$setting->name}"];
                }
                continue;
            }

            foreach ($this->expandParameters($route) as $uri) {
                $targets[] = [$role, $uri];
            }
        }

        return $targets;
    }

    private function roleFor(Route $route): string
    {
        $middleware = implode(',', $route->gatherMiddleware());

        return match (true) {
            (bool) preg_match('/(OrgCustomerRoleMiddleware|org_customer_role):organization_admin/', $middleware) => 'organization_admin',
            (bool) preg_match('/(OrgCustomerRoleMiddleware|org_customer_role):customer/', $middleware) => 'customer',
            (bool) preg_match('/EmbassyDashboardAuth|embassy_auth/', $middleware) => 'super_admin',
            default => 'guest',
        };
    }

    /** @return string[] */
    private function expandParameters(Route $route): array
    {
        $uri = $route->uri();

        if ($uri === 'events/store-event/{type}') {
            return ['events/store-event/event', 'events/store-event/meeting'];
        }
        if ($uri === 'events/edit-event/{id}/{type}') {
            $id = DB::table('events')->value('id') ?? 1;
            return ["events/edit-event/{$id}/event", "events/edit-event/{$id}/meeting"];
        }
        if ($uri === 'lov/{type}') {
            return DB::table('lov_types')->pluck('slug')->filter()->map(fn ($slug) => "lov/{$slug}")->all() ?: ['lov/industry'];
        }
        if ($uri === 'lov/category/{category}') {
            return DB::table('lov_types')->pluck('category')->filter()->unique()->map(fn ($c) => "lov/category/{$c}")->values()->all() ?: ['lov/category/general'];
        }

        return [preg_replace_callback('/\{(\w+)\??\}/', function ($m) use ($uri) {
            $name = $m[1];
            $table = self::PARAM_TABLES[$name] ?? null;

            if ($name === 'id') {
                foreach (self::ID_TABLES as $prefix => $candidate) {
                    if (str_starts_with($uri, $prefix)) {
                        $table = $candidate;
                        break;
                    }
                }
            }

            if ($table === 'users' && str_contains($uri, 'match-making')) {
                return $this->users['customer']->id;
            }
            if ($table === 'users') {
                return $this->users['customer']->id;
            }
            if ($table === 'organizations') {
                return $this->users['organization_admin']->organization->id;
            }

            return $table ? (DB::table($table)->orderByDesc('id')->value('id') ?? 1) : 1;
        }, $uri)];
    }
}
