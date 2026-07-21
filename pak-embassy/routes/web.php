<?php

use App\Http\Controllers\LovController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DiasporaDashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\KnowledgeBaseController;
use App\Http\Controllers\KnowledgeBaseSectionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationAuthController;
use App\Http\Controllers\SuperAdmin\UserManagement\SkilledIndividualController;
use App\Http\Controllers\SuperAdmin\UserManagement\OrganizationController;
use App\Http\Controllers\OrganizationDashboardController;
use App\Http\Controllers\SuperAdmin\ACL\AclController;
use App\Http\Controllers\SuperAdmin\ACL\DepartmentController;
use App\Http\Controllers\SuperAdmin\ACL\UserController;
use App\Http\Controllers\SuperAdmin\MatchMaking\IndividualController;
use App\Http\Controllers\SuperAdmin\MatchMaking\OrganizationController as MatchMakingOrganizationController;
use App\Http\Controllers\SuperAdmin\EventManagementController;
use App\Http\Controllers\SuperAdmin\JobBoardController;
use App\Http\Controllers\SuperAdmin\CRM\DashboardController as CrmDashboardController;
use App\Http\Controllers\SuperAdmin\CRM\LeadsController;
use App\Http\Controllers\SuperAdmin\TemplateController;
use App\Http\Controllers\SuperAdmin\Reports\ReportsManagementController;
use App\Http\Controllers\SuperAdmin\Settings\GeneralSettingController;
use App\Http\Controllers\SuperAdmin\CoworkingSpaceController;
use App\Http\Controllers\WebPagesController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-all-cache', function () {
    // Clear application cache
    Artisan::call('cache:clear');
    
    // Clear route cache (fixes "Route not defined" errors)
    Artisan::call('route:clear');
    
    // Clear config cache
    Artisan::call('config:clear');
    
    // Clear compiled view files
    Artisan::call('view:clear');
    
    return response()->json([
        'status' => 'success',
        'message' => 'All caches (application, route, config, and view) have been successfully cleared!'
    ]);
});


Route::get('super-admin/dashboard', [DashboardController::class, 'data']);
Route::get('events', [ViewController::class, 'events']);
Route::get('departments', [ViewController::class, 'departments']);
Route::get('add-role', [ViewController::class, 'saveRole']);
Route::get('create-match-making-event', [ViewController::class, 'createMatchMakingEvent']);
Route::get('co-working-space', [ViewController::class, 'coWorkingSpace']);
Route::get('create-co-working-space', [ViewController::class, 'createCoWorkingSpace']);
Route::get('login', [ViewController::class, 'login'])->name('login');
Route::get('organization-signup', [ViewController::class, 'organizationSignUp']);
Route::get('diaspora-signup', action: [ViewController::class, 'diasporaSignup']);


Route::get('/user/knowledge-area', action: [ViewController::class, 'knknowledgeArea']);











// profile
Route::get('/user/profile', action: [ViewController::class, 'profile']);


// Company dashboard route











// --------------- Organization Auth ---------------
Route::prefix('organization')->group(function () {
    Route::post('company-identity', [OrganizationAuthController::class, 'storeCompanyIdentity'])
        ->name('organization.company-identity');
    Route::post('company-info', [OrganizationAuthController::class, 'storeCompanyInfo'])
        ->name('organization.company-info');
    Route::post('products-info', [OrganizationAuthController::class, 'storeProductsInfo'])
        ->name('organization.products-info');
    Route::post('service-info', [OrganizationAuthController::class, 'storeServiceInfo'])
        ->name('organization.service-info');
    Route::post('store-passcode', [OrganizationAuthController::class, 'storePasscode'])
        ->name('organization.store-passcode');
    Route::post('account-verification', [OrganizationAuthController::class, 'accountVerification'])
        ->name('organization.account-verification');
    Route::post('organization-check-email', [OrganizationAuthController::class, 'checkEmail'])
        ->name('organization.checkEmail');
    Route::post('organization-signin', [OrganizationAuthController::class, 'signIn'])
        ->name('organization.signIn');
    Route::post('get-organization-data', [OrganizationAuthController::class, 'getOrganizationData'])
        ->name('organization.get-data');
});
// --------------- Organization Auth ---------------

// Individual Signup
Route::controller(RegistrationController::class)->prefix('')->group(function () {
    Route::controller(RegistrationController::class)->prefix('individual-signup')->group(function () {
        Route::get('', 'diasporaRegistration')
            ->name('register.individual.signup');

        Route::post('/step1', 'storePersonalInfo')
            ->name('register.individual.step1');

        Route::post('/step2', 'storeEmploymentInfo')
            // ->middleware('ensure.registration.step:2')
            ->name('register.individual.step2');

        Route::post('/step3', 'storeEmploymentArea')
            // ->middleware('ensure.registration.step:3')
            ->name('register.individual.step3');
        Route::post('/step5', 'finalizeRegistration')
            // ->middleware('ensure.registration.step:4')
            ->name('register.individual.finalize');
        Route::get('/step4', 'individualDetails')
            ->name('register.individual.details');
    });
});

Route::middleware(['org_customer_role:customer'])->group(function () {

    Route::get('user/dashboard', [DiasporaDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/knowledge-area', action: [ViewController::class, 'knknowledgeArea']);

    //co-working space
    Route::get('/user/co-work-space', [DiasporaDashboardController::class, 'workSpace'])->name('co-work-space.list');
    Route::get('/user/co-work-space-detail/{space}', [DiasporaDashboardController::class, 'workSpaceDetail']);

    //profile
    Route::get('/user/profile', action: [ViewController::class, 'profile'])->name('user.profile');
    Route::post('/user/logout', [OrganizationAuthController::class, 'logout']);
    Route::post('/user/change-passcode', [OrganizationAuthController::class, 'changePasscode'])->name('user.change-passcode');

    // Profile management routes
    Route::prefix('user/profile')->group(function () {
        // Education routes
        Route::post('/education', [App\Http\Controllers\UserProfileController::class, 'storeEducation'])->name('user.education.store');
        Route::get('/education/{id}', [App\Http\Controllers\UserProfileController::class, 'getEducation'])->name('user.education.get');
        Route::put('/education/{id}', [App\Http\Controllers\UserProfileController::class, 'updateEducation'])->name('user.education.update');
        Route::delete('/education/{id}', [App\Http\Controllers\UserProfileController::class, 'deleteEducation'])->name('user.education.delete');

        // Experience routes
        Route::post('/experience', [App\Http\Controllers\UserProfileController::class, 'storeExperience'])->name('user.experience.store');
        Route::get('/experience/{id}', [App\Http\Controllers\UserProfileController::class, 'getExperience'])->name('user.experience.get');
        Route::put('/experience/{id}', [App\Http\Controllers\UserProfileController::class, 'updateExperience'])->name('user.experience.update');
        Route::delete('/experience/{id}', [App\Http\Controllers\UserProfileController::class, 'deleteExperience'])->name('user.experience.delete');

        // Certificate routes
        Route::post('/certificate', [App\Http\Controllers\UserProfileController::class, 'storeCertificate'])->name('user.certificate.store');
        Route::get('/certificate/{id}', [App\Http\Controllers\UserProfileController::class, 'getCertificate'])->name('user.certificate.get');
        Route::put('/certificate/{id}', [App\Http\Controllers\UserProfileController::class, 'updateCertificate'])->name('user.certificate.update');
        Route::delete('/certificate/{id}', [App\Http\Controllers\UserProfileController::class, 'deleteCertificate'])->name('user.certificate.delete');

        // Get profile data
        Route::get('/data', [App\Http\Controllers\UserProfileController::class, 'getProfileData'])->name('user.profile.data');

        // Get countries
        Route::get('/countries', [App\Http\Controllers\UserProfileController::class, 'getCountries'])->name('user.profile.countries');
    });

    // job
    Route::get('/user/discover-job', [DiasporaDashboardController::class, 'discoverJob'])->name('jobs.list');
    Route::get('/user/detail-job/{job}',[DiasporaDashboardController::class, 'detailJob'])->name('job.details');

    //job Applications
    Route::get('/user/applications', [DiasporaDashboardController::class, 'userJobApplications'])->name('applications.list');
    Route::get('/user/job-apply/{job}', [JobApplicationController::class, 'create'])->name("application.create");
    Route::post('/user/job-apply', [JobApplicationController::class, 'store'])->name('application.store');
    Route::get('/user/applied-job', [DiasporaDashboardController::class, 'userJobApplications']);

    // event

    Route::get('/user/your-event', action: [DiasporaDashboardController::class, 'userEvents'])->name('user.events');
    Route::get('/user/event-detail/{event}', [DiasporaDashboardController::class, 'eventDetail'])->name('event.details');
});

Route::middleware(['org_customer_role:organization_admin'])->group(function () {
    Route::get('company/dashboard', [OrganizationDashboardController::class, 'index'])->name('company.dashboard');
    Route::get('/company/knowledge-area', action: [ViewController::class, 'companyknknowledgeArea']);
    Route::get('/company/discover-job', [OrganizationDashboardController::class, 'companydiscoverJob'])->name('company.jobs.list');
    Route::get('/company/detail-job/{job}', action: [OrganizationDashboardController::class, 'companydetailJob'])->name('company.detail.job');
    Route::get('/company/job-apply', action: [OrganizationDashboardController::class, 'companyjobApply']);
    Route::get('/company/applied-job',[OrganizationDashboardController::class, 'recieved_applications'])->name('company.recieved.applications');
    Route::get('/company/public-event', [OrganizationDashboardController::class, 'companypublicEvent']);
    Route::get('/company/event-detail/{event}', action: [OrganizationDashboardController::class, 'companyeventDetail'])->name('company.event.details');
    Route::get('/company/your-event',[OrganizationDashboardController::class, 'companyEvents'])->name('company.your.events');
    Route::get('/company/co-work-space',[OrganizationDashboardController::class, 'companyworkSpace'])->name('company.co-work-space.list');
    Route::get('/company/co-work-space-detail/{space}',[OrganizationDashboardController::class, 'companyworkSpaceDetail']);
    Route::get('/company/profile', action: [ViewController::class, 'companyprofile'])->name('company.profile');
    Route::post('/company/logout', [OrganizationAuthController::class, 'logout']);
    Route::post('/company/change-passcode', [OrganizationAuthController::class, 'changePasscode'])->name('company.change-passcode');




    Route::get('/company/knowledge-area', action: [ViewController::class, 'companyknknowledgeArea']);

// job
    Route::get('/company/create/job', [JobPostController::class, 'create'])->name('company.create.job');
    Route::post('/company/post-job', [JobPostController::class, 'store'])->name('company.post.job');

});

Route::get('/user/event-detail/{event}', [DiasporaDashboardController::class, 'eventDetail'])->name('event.details');
Route::get('/user/public-event', action: [DiasporaDashboardController::class, 'eventsListing'])->name('events.list');
Route::post('/user/event/enroll', [EventController::class, 'enrollEvent'])->name('user.enroll');
 Route::post('/user/co-work-space/booking', [BookingRequestController::class, 'bookingRequest'])->name('user.co-work-space.booking');

Route::get('embassy/login', [SuperAdminDashboardController::class, 'loginForm'])->name('dashboard.loginForm');
Route::post('dashboard/signin', [SuperAdminDashboardController::class, 'signin'])->name('dashboard.signin');

Route::middleware(['embassy_auth'])->group(function () {
    Route::get('dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::post('embassy/logout', [SuperAdminDashboardController::class, 'logout']);

    // --------------- Logs ---------------
    Route::prefix('logs')->controller(\App\Http\Controllers\LogController::class)->group(function () {
        Route::get('/', 'index')->name('logs.index');
        Route::get('/unread-count', 'getUnreadCount')->name('logs.unread-count');
    });
    // --------------- Logs ---------------

    // --------------- User Management ---------------
    Route::controller(SkilledIndividualController::class)->group(function () {
        Route::get('skilled-individuals', 'index')->name('skilled_individuals.index');
        Route::get('skilled-individuals/create', 'create')->name('skilled_individuals.create');
        Route::post('skilled-individuals', 'store')->name('skilled_individuals.store');
        Route::get('skilled-individuals/{id}/edit', 'edit')->name('skilled_individuals.edit');
        Route::put('skilled-individuals/{id}', 'update')->name('skilled_individuals.update');
        Route::patch('skilled-individuals/{id}', 'update');
        Route::post('skilled_individuals/invite', 'invite')->name('skilled_individuals.invite');
        Route::get('skilled-individual/details/{id}', 'show')->name('skilled_individuals.show');
        Route::post('skilled-individual/update-status', 'updateStatus');
        Route::post('skilled-individual/{id}', 'destroy')->name('skilled-individuals.destroy');
    });

    Route::controller(OrganizationController::class)->group(function () {
        Route::get('organizations', 'index')->name('organizations.index');
        Route::get('organizations/create', 'create')->name('organizations.create');
        Route::post('organizations', 'store')->name('organizations.store');
        Route::get('organizations/details/{id}', 'show')->name('organizations.show');
        Route::get('organizations/{id}/edit', 'edit')->name('organizations.edit');
        Route::put('organizations/{id}', 'update')->name('organizations.update');
        Route::patch('organizations/{id}', 'update');
        Route::post('organizations/invite', 'invite')->name('organizations.invite');
        Route::post('organizations/update-status', 'updateStatus');
        Route::post('organizations/{id}/approve', 'approve')->name('organizations.approve');
        Route::post('organizations/{id}/decline', 'decline')->name('organizations.decline');
        Route::delete('organizations/{id}', 'destroy')->name('organizations.destroy');
    });
    // --------------- User Management ---------------

    // --------------- Users ---------------
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::post('/', 'store')->name('users.store');
        Route::put('/{id}', 'update')->name('users.update');
        Route::post('/{id}', 'destroy')->name('users.destroy');
    });
    // --------------- Users ---------------

    // --------------- ACL ---------------
    Route::prefix('acl')->controller(AclController::class)->group(function () {
        Route::get('/', 'index')->name('acl.index');
        Route::post('/role', 'storeRole')->name('acl.storeRole');
        Route::put('/role/{id}', 'updateRole')->name('acl.updateRole');
        Route::post('/role/{id}', 'deleteRole')->name('acl.deleteRole');
        Route::get('/assign-permissions', 'assignPermissionsForm')->name('acl.assignPermissionsForm');
        Route::get('/roles/permissions', 'getPermissions')->name('roles.getPermissions');
        Route::post('/assign', 'assignPermissions')->name('acl.assignPermissions');
    });
    // --------------- ACL ---------------

    // --------------- Departments ---------------
    Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('departments.index');
        Route::post('/', 'store')->name('departments.store');
        Route::put('/{id}', 'update')->name('departments.update');
        Route::post('/{id}', 'destroy')->name('departments.destroy');
    });
    // --------------- Departments ---------------

    //LOVs management - Category-based routes
    Route::controller(LovController::class)->prefix('lov')->group(function () {
        // Category-based routes (must come before type routes to avoid conflicts)
        Route::get('category/{category}', 'categoryIndex')->name('lov.category.index');
        
        // Legacy type-based routes (for backward compatibility)
        Route::get('{type}', 'index')->name('lov.index');
        Route::post('store/{type}', 'store')->name('lov.save');
        Route::put('update/{lov}', 'update')->name('lov.update');
        Route::get('show/{lov}', 'show')->name('lov.show');
        Route::delete('delete/{lov}', 'destroy')->name('lov.delete');
    });

    //Skills management
    Route::controller(SkillController::class)->prefix('skill')->group(function () {
        Route::get('', 'index')->name('skill.index');
        Route::post('store', 'store')->name('skill.store');
        Route::put('update/{skill}', 'update')->name('skill.update');
        Route::get('show/{skill}', 'show')->name('skill.show');
        Route::delete('delete/{skill}', 'destroy')->name('skill.delete');
    });

    // --------------- MatchMaking ---------------
    Route::prefix('match-making')->group(function () {
        Route::post('store-private-event/{type}', [IndividualController::class, 'getPrivateEventForm'])->name('match-making.store-private-event');

        Route::prefix('individual')->controller(IndividualController::class)->group(function () {
            Route::get('/', 'index')->name('individual.index');
            Route::get('view-match-making-individual/{user}', 'viewMatchMaking')->name('individual.view-match-making-individual');
        });

        Route::prefix('organization')->controller(MatchMakingOrganizationController::class)->group(function () {
            Route::get('/', 'index')->name('organization.index');
            Route::get('view-match-making-organization/{organization}', 'viewMatchMaking')->name('organization.view-match-making-organization');
        });
    });
    // --------------- MatchMaking ---------------

    // --------------- Events Management ---------------
    Route::prefix('events')->controller(EventManagementController::class)->group(function () {
        Route::get('/', 'index')->name('events.index');
        Route::post('/{id}/minutes', 'saveMinutes')->name('events.save-minutes');
        Route::get('/{event}/minutes', 'viewMinutes')->name('events.view-minutes');
        Route::get('/{event}', 'viewEvent')->name('events.view');
        Route::get('store-event/{type}', 'getEventForm')->name('events.store-event');
        Route::post('store-event', 'store')->name('events.store');
        Route::get('edit-event/{id}/{type}', 'getEditEventForm')->name('events.edit-event');
        Route::post('edit-event/{id}', 'update')->name('events.edit');
        Route::post('/{id}', 'destroy')->name('events.destroy');
        
        // Action Items routes
        Route::get('/{event}/action-items', 'getActionItems')->name('events.action-items');
        Route::post('/{event}/action-items', 'storeActionItem')->name('events.action-items.store');
        Route::put('/action-items/{actionItem}', 'updateActionItem')->name('events.action-items.update');
        Route::delete('/action-items/{actionItem}', 'deleteActionItem')->name('events.action-items.delete');
    });
    // --------------- Events Management ---------------

    // --------------- Jobs Board ---------------
    Route::prefix('jobs-board')->controller(JobBoardController::class)->group(function () {
        Route::get('/', 'index')->name('jobs-board.index');
        Route::get('/get-statuses', 'getStatuses')->name('jobs-board.statuses');
        Route::post('/update-status', 'updateStatus');
    });
    // --------------- Jobs Board ---------------

    // --------------- CRM Dashboard ---------------
    Route::prefix('crm')->controller(JobBoardController::class)->group(function () {
        Route::prefix('dashboard')->controller(CrmDashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
            Route::get('/leads/{id}/view', 'view')->name('dashboard.leads.view');
        });

        Route::prefix('leads')->controller(LeadsController::class)->group(function () {
            Route::get('/', 'index')->name('leads.index');
        });
    });
    // --------------- CRM Dashboard ---------------

    // --------------- Template Management ---------------
    Route::controller(TemplateController::class)->group(function () {
        Route::get('home-page-template', 'getHomePageTemplates')->name('template-management');
        Route::get('preview-template', 'previewLandingPage')->name('preview-template');
        Route::get('template/setting/{id}/{page}', 'editTemplateSetting')->name('template-setting');
        Route::post('template/setting/save', 'saveTemplateSetting')->name('save-template-setting');
    });
    // --------------- Template Management ---------------

    // --------------- Reports Management ---------------
    Route::controller(ReportsManagementController::class)->group(function () {
        Route::get('users-reports', 'usersReport')->name('users-reports.index');
        Route::get('jobs-reports', 'jobsReport')->name('jobs-reports.index');
        Route::get('event-reports', 'eventsReport')->name('event-reports.index');
        Route::get('match-making-reports', 'matchMakingReport')->name('match-making-reports.index');
        Route::get('co-working-space-reports', 'coWorkingSpaceReport')->name('co-working-space-reports.index');
    });
    // --------------- Reports Management ---------------

    // --------------- Settings  ---------------
    Route::prefix('settings')->controller(GeneralSettingController::class)->group(function () {
        Route::get('general', 'index')->name('settings.general.index');
        Route::post('general', 'store')->name('settings.general.store');
    });
    // --------------- Settings ---------------

    // --------------- Co-working-space  ---------------
    Route::prefix('co-working-space')->controller(CoworkingSpaceController::class)->group(function () {
        Route::get('/', 'index')->name('co-working-space.index');
        Route::get('/{space}/show', 'show')->name('co-working-space.show');
        Route::get('/{space}/requests', 'spaceRequests')->name('co-working-space.requests');
        Route::post('/', 'store')->name('co-working-space.store');
        Route::get('requests', 'spacesRequestIndex');
        Route::get('/workspace-enquiry/{id}', 'showEnquiry')->name('co-working-space.enquiry');

        // accept or reject enquiry
        Route::post('/workspace-enquiry/{id}/accept', 'acceptEnquiry')->name('co-working-space.accept-enquiry');
        Route::post('/workspace-enquiry/{id}/reject', 'rejectEnquiry')->name('co-working-space.reject-enquiry');
        Route::post('/workspace-enquiry/{id}/in-review', 'inReviewEnquiry')->name('co-working-space.in-review-enquiry');
    });
    // --------------- Co-working-space ---------------

    // --------------- knowledge  ---------------
    
    Route::get('knowledge',[KnowledgeBaseController::class, 'index'])->name('knowledge.index');
    Route::get('knowledge/create',[KnowledgeBaseController::class, 'create'])->name('knowledge.create');
    Route::post('knowledge/store',[KnowledgeBaseController::class, 'store'])->name('knowledge.store');
    Route::get('knowledge/{id}/edit',[KnowledgeBaseController::class, 'edit'])->name('knowledge.edit');
    Route::post('knowledge/{id}/update',[KnowledgeBaseController::class, 'update'])->name('knowledge.update');
    Route::post('knowledge/{id}/update-status',[KnowledgeBaseController::class, 'updateStatus'])->name('knowledge.update-status');
    Route::post('knowledge/{id}/delete',[KnowledgeBaseController::class, 'destroy'])->name('knowledge.destroy');
    Route::get('knowledge/{id}/show',[KnowledgeBaseController::class, 'show'])->name('knowledge.show');

    // --------------- knowledge ---------------

    // --------------- knowledge section  ---------------
    
    Route::get('knowledge-section/create',[KnowledgeBaseSectionController::class, 'create'])->name('knowledge.section.create');
    Route::post('knowledge-section/store',[KnowledgeBaseSectionController::class, 'store'])->name('knowledge.section.store');
    Route::post('knowledge-section/{id}/update',[KnowledgeBaseSectionController::class, 'update'])->name('knowledge.section.update');

    // --------------- knowledge section ---------------
});

Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');

Route::get('/', [WebPagesController::class, 'home'])->name('home');
Route::get('contact-us', [WebPagesController::class, 'contactUs'])->name('contact');
Route::get('event', [WebPagesController::class, 'event'])->name('event');
Route::get('job-notice-board', [WebPagesController::class, 'jobNoticeBoard'])->name('job');
Route::get('knowledge-base', [WebPagesController::class, 'knowledgeBase'])->name('knowledge');
Route::get('knowledge-base/{id}', [WebPagesController::class, 'knowledgeBaseDetail'])->name('knowledge.detail');

// Route::get('/', [TemplateController::class, 'userHomePage'])->name('home');
// Route::get('contact-us', [TemplateController::class, 'contactUs'])->name('contact');

Route::get('/check-version', function () {
    return response()->json([
        'php_version' => phpversion(),
        'laravel_version' => app()->version(),
    ]);
});
