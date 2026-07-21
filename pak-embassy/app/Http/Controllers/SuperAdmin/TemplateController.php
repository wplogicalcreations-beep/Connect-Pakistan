<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Models\TemplatePageSetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CommonPageSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Services\TemplatePageSettingService;

class TemplateController extends Controller
{
    protected $templatePageSettingService;

    public function __construct(
        TemplatePageSettingService $template_page_setting_service
    )
    {
        $this->templatePageSettingService = $template_page_setting_service;
    }

    public function userHomePage()
    {
        $lang = 'en';
        $homepage_setting = TemplatePageSetting::where('name', 'home_page')->where('status', 1)->first();
        $events = $this->getEvents();
        if ($homepage_setting) {
            $template = Template::find($homepage_setting->template_id);
            $data = $this->getSettingData($homepage_setting);
            if ($data) {
                return view('website.home', ['data' => $data, 'events' => $events]);
            }
            return view('website.home', ['events' => $events]);
        }
        return view('website.home', ['events' => $events]);
    }

    public function getHomePageTemplates()
    {
        $templates = Template::where('name', 'like', 'homePageTemplate%')->where('status', 'Active')->get();
        $templates->map(function ($template) {
            $template->keys = json_decode($template->keys);
        });

        return view('super-admin.template.landing-page', compact('templates'));
    }
    
    public function previewLandingPage() {
        $events = $this->getEvents();

        return view("super-admin.template.landing-page-preview", compact('events'));
    }

    public function editTemplateSetting(Request $request, $id, $page = 'home_page') {
        try {
            $data = $request->all();
            $template = Template::with('setting','settings')->find($id);
            $template->keys = json_decode($template->keys, true);
            $current_setting = TemplatePageSetting::where('status', 1)->where('template_id',$id)->where('name', $page)->first();
            $all_settings = TemplatePageSetting::where('name', $page)->get();
            $template_setting = TemplatePageSetting::where('template_id', $id)->where('name', $page)->first();
            if ($current_setting && $current_setting->template_id == $id) {
                $setting = $this->getSettingData($current_setting, 'en');
            } elseif ($template_setting) {
                if (!empty($all_settings)) {
                    foreach ($all_settings as $set) {
                        $set->update(['status' => 0]);
                    }
                }
                $template_setting->update(['status' => 1]);
                $setting = $this->getSettingData($template_setting, 'en');
            } else {
                $setting = null;
            }

            $pages = TemplatePageSetting::where('template_id', $id)->select('id','name')->get();
            $current_page_setting = TemplatePageSetting::where('template_id', $id)->where('name', $page)->first();

            $data['template'] = $template;
            $data['setting'] = $setting;
            $data['pages'] = $pages;
            $data['current_page'] = $page;
            $data['current_page_setting'] = $current_page_setting ?? null;
            $data['lang'] = 'en';
            $events = $this->getEvents();
            $data['events'] = $events;

            return view('super-admin.template.template-setting', $data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return $exception->getMessage();
        }
    }

    public function saveTemplateSetting(Request $request) {
        $page_setting = TemplatePageSetting::where('template_id', $request->template_id)->where('name',$request->name)->first();
        $all_settings = TemplatePageSetting::where('template_id', $request->template_id)->where('name', $request->name)->get();
        if ($page_setting) {
            $this->updateSetting($page_setting->id, $request, $request->name);
        } else {
            foreach ($all_settings as $set) {
                $set->update(['status' => 0]);
            }
            $page_setting = $this->saveSetting($request, $request->name);
        }
        $request->merge(['id' => $request->template_id]);

        return redirect()->route('template-setting',['id' => $request->template_id, 'page' => $request->name]);
    }

    public function saveSetting($request) {
        $insertedImage = "";
        $setting = TemplatePageSetting::create(array_merge(
        $request->except(['_token', 'created_by', 'content']),
            [
                'created_by' => Auth::id() ?? 1,
            ]
        ));
        if ($setting) {
            $lang = $request->lang ?? 'en';
            $data = $request->all();
            function handleUpload($value, $path, $isNew)
            {
                return $isNew ? UPLOAD_FILE($value, $path) : $value;
            }
            if (!isset($data['content'][$lang]) || !is_array($data['content'][$lang])) {
                $data['content'][$lang] = [];
            }
            foreach ($data['content'][$lang] as $contentKey => $array) {
                if (!is_array($array)) {
                    $array = [];
                }
                if ($contentKey === 'Logo' || $contentKey === 'old_Logo') {
                    if ($request->hasFile("content.$lang.Logo")) {
                        $insertedImage = handleUpload(
                            $request->file("content.$lang.Logo"),
                            'setting/' . $setting->id . '/logo',
                            true
                        );
                        $data['content'][$lang]['Logo'] = $insertedImage;
                        $data['content'][$lang]['old_Logo'] = $insertedImage;
                    } else {
                        $oldLogo = $request->input("content.$lang.old_Logo");
                        $data['content'][$lang]['Logo'] = $oldLogo;
                        $data['content'][$lang]['old_Logo'] = $oldLogo;
                    }
                    continue;
                }
                if (in_array($contentKey, ['HeroSection1', 'HeroSection2', 'HeroSection3'])) {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Image', 'old_Image'])) {
                            $array['Image'] = handleUpload($column, 'setting/' . $setting->id . '/image', $section === 'Image');
                        } else {
                            $array[$section] = $column;
                        }
                        if (in_array($section, ['Background Image', 'old_Background Image'])) {
                            $array['Background Image'] = handleUpload($column, 'setting/' . $setting->id . '/background', $section === 'Background Image');
                        } else {
                            $array[$section] = $column;
                        }
                    }
                }
                if ($contentKey === 'AmbassadorMessageSection') {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Title Icon', 'old_Icon'])) {
                            $array['Title Icon'] = handleUpload($column, 'setting/' . $setting->id . '/icon', $section === 'Title Icon');
                        }
                        if (in_array($section, ['Image', 'old_Image'])) {
                            $array['Image'] = handleUpload($column, 'setting/' . $setting->id . '/image', $section === 'Image');
                        } else {
                            $array[$section] = $column;
                        }
                    }
                }
                if ($contentKey === 'WhyNeedUsSection') {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Title Icon', 'old_Icon'])) {
                            $array['Title Icon'] = handleUpload($column, 'setting/' . $setting->id . '/icon', $section === 'Title Icon');
                        }
                        if (in_array($section, ['Image', 'old_Image'])) {
                            $array['Image'] = handleUpload($column, 'setting/' . $setting->id . '/image', $section === 'Image');
                        }
                        if (in_array($section, ['Business Growth', 'Talent Discovery']) && is_array($column)) {
                            foreach ($column as $item => $sub_column) {
                                if (in_array($item, ['Icon', 'old_Icon'])) {
                                    $column['Icon'] = handleUpload($sub_column, 'setting/' . $setting->id . '/icon', $item === 'Icon');
                                } else {
                                    $column[$item] = $sub_column;
                                }
                            }
                        }
                        $array[$section] = $column;
                    }
                }
                if ($contentKey === 'BenefitsSection') {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Title Icon', 'old_Icon'])) {
                            $array['Title Icon'] = handleUpload($column, 'setting/' . $setting->id . '/icon', $section === 'Title Icon');
                        }
                        if ($section === 'Cards' && is_array($column)) {
                            foreach ($column as $item => $sub_column) {
                                foreach ($sub_column as $tab => $sub_sub_column) {
                                    if (in_array($tab, ['Image', 'old_Image'])) {
                                        $sub_column['Image'] = handleUpload($sub_sub_column, 'setting/' . $setting->id . '/image', $tab === 'Image');
                                    } else {
                                        $sub_column[$tab] = $sub_sub_column;
                                    }
                                }
                                $column[$item] = $sub_column;
                            }
                        }
                        $array[$section] = $column;
                    }
                }
                if (in_array($contentKey, ['HowItWorksSection', 'EventsSection', 'CallToAction'])) {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Title Icon', 'old_Icon'])) {
                            $array['Title Icon'] = handleUpload($column, 'setting/' . $setting->id . '/icon', $section === 'Title Icon');
                        } else {
                            $array[$section] = $column;
                        }
                        if (in_array($section, ['Background Image', 'old_Background Image'])) {
                            $array['Background Image'] = handleUpload($column, 'setting/' . $setting->id . '/background', $section === 'Background Image');
                        } else {
                            $array[$section] = $column;
                        }
                    }
                }
                if ($contentKey === 'FooterSection') {
                    foreach ($array as $section => $column) {
                        if (in_array($section, ['Title Icon', 'old_Icon'])) {
                            $array['Title Icon'] = handleUpload($column, 'setting/' . $setting->id . '/icon', $section === 'Title Icon');
                        }
                        if ($section === 'Map' && is_array($column)) {
                            foreach ($column as $item => $sub_column) {
                                if (in_array($item, ['Title Icon', 'old_Icon'])) {
                                    $column['Title Icon'] = handleUpload($sub_column, 'setting/' . $setting->id . '/icon', $item === 'Title Icon');
                                } else {
                                    $column[$item] = $sub_column;
                                }
                            }
                        }
                        if ($section === 'Useful Links' && is_array($column)) {
                            foreach ($column as $item => $sub_column) {
                                if (in_array($item, ['Portal', 'Knowledge Base', 'Job Notice Board', 'Events']) && is_array($sub_column)) {
                                    foreach ($sub_column as $tab => $sub_sub_column) {
                                        if (in_array($tab, ['Icon', 'old_Icon'])) {
                                            $sub_column['Icon'] = handleUpload($sub_sub_column, 'setting/' . $setting->id . '/icon', $tab === 'Icon');
                                        } else {
                                            $sub_column[$tab] = $sub_sub_column;
                                        }
                                    }
                                }
                                $column[$item] = $sub_column;
                            }
                        }
                        if ($section === 'Newsletter' && is_array($column)) {
                            foreach ($column as $item => $sub_column) {
                                if (in_array($item, ['Title Icon', 'old_Icon'])) {
                                    $column['Title Icon'] = handleUpload($sub_column, 'setting/' . $setting->id . '/icon', $item === 'Title Icon');
                                } else {
                                    $column[$item] = $sub_column;
                                }
                            }
                        }
                        $array[$section] = $column;
                    }
                }
                $data['content'][$lang][$contentKey] = $array;
            }

            return $setting->update(['content' => is_array($data['content']) ? json_encode($data['content']) : $data['content']]);
        } else
            return false;
    }

    public function updateSetting($setting_id, $request)
    {
        return $this->templatePageSettingService->updateSetting($setting_id, $request);
    }

    public static function getSettingData($setting, $lang = 'en')
    {
        $commonSetting = CommonPageSetting::firstOrCreate([]);
        $commonContent = json_decode($commonSetting->content, true);

        $data = json_decode($setting->content, true);

        // Make sure the language exists to avoid null errors
        $pageData = $data[$lang] ?? [];
        $commonData = $commonContent[$lang] ?? [];

        // Merge - commonData overwrites pageData where keys match
        $merged = array_replace_recursive($pageData, $commonData);

        return $merged ?? null;
    }

    protected function getEvents()
    {
        return Event::with('images')->where('status_id', 1)
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
    }
}
