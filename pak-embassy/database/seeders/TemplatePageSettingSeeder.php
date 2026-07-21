<?php

namespace Database\Seeders;

use App\Support\HomePageTemplateDefaults;
use App\Models\Template;
use App\Models\TemplatePageSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class TemplatePageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $template = Template::where('name', 'homePageTemplate1')->first();
        $superAdmin = User::where('email', 'superadmin@embassy.com')->first();
        $status = 1;

        $homePageTemplate = TemplatePageSetting::where('name', 'home_page')->first();

        $pages = [
            ['name' => 'home_page', 'template_page' => 'template-home', 'template_image' => 'images/templates/home_page_template.png'],
            ['name' => 'contact_page', 'template_page' => 'template-contact', 'template_image' => 'images/templates/contact_page_template.png'],
            ['name' => 'event_page', 'template_page' => 'template-event', 'template_image' => 'images/templates/event_page_template.png'],
            ['name' => 'job_notice_board_page', 'template_page' => 'template-job-notice-board', 'template_image' => 'images/templates/job_page_template.png'],
            ['name' => 'knowledge_base_page', 'template_page' => 'template-knowledge-base', 'template_image' => 'images/templates/know_page_template.png'],
        ];

        $keys = json_encode($this->dummyContent());

        $content = $homePageTemplate->content ?? $keys;

        foreach ($pages as $page) {    
            TemplatePageSetting::updateOrCreate(
                [
                    'name' => $page['name'],
                    'template_id' => $template->id
                ],
                [
                    'template_page' => $page['template_page'],
                    'content' => $content,
                    'template_image' => $page['template_image'],
                    'created_by' => $superAdmin->id,
                    'status' => $status
                ]
            );
        }
    }

    private function dummyContent()
    {
        return [
            'en' => HomePageTemplateDefaults::english(),
        ];
    }

}
