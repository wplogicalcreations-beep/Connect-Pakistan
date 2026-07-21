<?php

namespace App\Http\Controllers;

use App\Support\HomePageTemplateDefaults;
use App\Models\CommonPageSetting;
use App\Models\CommonPageSettings;
use App\Models\Event;
use App\Models\JobPost;
use App\Models\KnowledgeBase;
use App\Models\TemplatePageSetting;
use App\Services\SuperAdmin\KnowledgeBaseService;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    protected $lang;
    protected $knowledgeBaseService;

    public function __construct(KnowledgeBaseService $knowledgeBaseService)
    {
        $this->lang = 'en';
        $this->knowledgeBaseService = $knowledgeBaseService;
    }

    public function home()
    {
        $data = $this->getPageSettingData('home_page');
        $events = Event::with('images')->where('status_id', 1)->orderBy('id', 'desc')->take(3)->get();
        return view('website.home', ['data' => $data, 'events' => $events]);
    }

    public function contactUs()
    {
        $data = $this->getPageSettingData('contact_page');
        return view('website.contact', ['data' => $data]);
    }

    public function event()
    {
        $data = $this->getPageSettingData('event_page');
        $events = Event::with('images')->where('status_id', 1)->orderBy('id', 'desc')->take(12)->get();
        return view('website.event', ['data' => $data, 'events' => $events]);
    }

    public function jobNoticeBoard()
    {
        $data = $this->getPageSettingData('job_notice_board_page');
        $jobs = JobPost::with('organization','organization.images')->orderBy('id', 'desc')->take(12)->get();
        return view('website.jobNoticeBoard', ['data' => $data, 'jobs' => $jobs]);
    }

    public function knowledgeBase(Request $request)
    {
        $data = $this->getPageSettingData('knowledge_base_page');
        
        // Create a mock request object for the service
        $serviceRequest = new Request();
        $serviceRequest->merge([
            'per_page' => 50, // Get more items for the frontend
            'sort_by' => 'id',
            'sort_order' => 'desc'
        ]);
        
        $knowledgeItems = $this->knowledgeBaseService->getAll($serviceRequest);
        
        return view('website.knowledgeBase', ['data' => $data, 'knowledgeItems' => $knowledgeItems]);
    }

    public function knowledgeBaseDetail($id)
    {
        $knowledgeBase = $this->knowledgeBaseService->getById($id);
        
        if (!$knowledgeBase) {
            abort(404, 'Knowledge base not found');
        }
        
        return view('website.knowledge-base-detail', compact('knowledgeBase'));
    }

    private function getPageSettingData($page, $lang = 'en')
    {
        $setting = TemplatePageSetting::where('name', $page)->where('status', 1)->first();
        $commonSetting = CommonPageSetting::firstOrCreate([]);
        $pageData = $setting ? json_decode($setting->content, true) : [];
        $commonData = $commonSetting && $commonSetting->content ? json_decode($commonSetting->content, true) : [];
        $localizedPageData = $pageData[$lang] ?? [];
        $data = array_merge($localizedPageData, $commonData[$lang] ?? []);

        if ($page === 'home_page') {
            $data = array_replace_recursive(HomePageTemplateDefaults::english(), $data ?? []);
        }

        return $data ?? null;
    }
}
