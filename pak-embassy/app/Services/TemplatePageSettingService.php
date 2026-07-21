<?php

namespace App\Services;

use App\Models\CommonPageSetting;
use App\Models\TemplatePageSetting;
use Illuminate\Http\Request;

class TemplatePageSettingService
{
    protected $setting;

    public function updateSetting($setting_id, $request)
    {
        $this->setting = TemplatePageSetting::find($setting_id);
        if (!$this->setting) {
            return false;
        }
        $lang = $request->lang ?? 'en';
        $data = $request->all();
        
        $existingContent = json_decode($this->setting->content, true) ?? [];
        $existingContent[$lang] = $existingContent[$lang] ?? [];
        $commonContent[$lang] = [];
        $data['content'][$lang] = $data['content'][$lang] ?? [];
        foreach ($data['content'][$lang] as $contentKey => $array) {
            if ($contentKey === 'Logo') {
                $logoPath = $this->handleUpload(
                    $array,
                    'setting/' . $this->setting->id . '/logo',
                    $array instanceof \Illuminate\Http\UploadedFile
                );
                $existingContent[$lang][$contentKey] = $logoPath;
                $commonContent[$lang][$contentKey] = $logoPath;
                continue;
            }
            if (!is_array($array)) {
                $array = [];
            }
            if (isset($existingContent[$lang][$contentKey]) && is_array($existingContent[$lang][$contentKey])) {
                $array = array_replace_recursive($existingContent[$lang][$contentKey], $array);
            }

            if (in_array($contentKey, ['HeroSection1', 'HeroSection2', 'HeroSection3'])) {
                $this->processUpload($array, 'Image', 'image');
                $this->processUpload($array, 'Background Image', 'image');
            }
            if ($contentKey === 'AmbassadorMessageSection') {
                $this->processUpload($array, 'Title Icon', 'icon');
                $this->processUpload($array, 'Image', 'image');
            }
            if ($contentKey === 'WhyNeedUsSection') {
                $this->processUpload($array, 'Title Icon', 'icon');
                $this->processUpload($array, 'Image', 'image');
                foreach (['Business Growth', 'Talent Discovery'] as $subKey) {
                    if (isset($array[$subKey]) && is_array($array[$subKey])) {
                        $this->processUpload($array[$subKey], 'Icon', 'icon');
                    }
                }
            }
            if ($contentKey === 'BenefitsSection') {
                $this->processUpload($array, 'Title Icon', 'icon');
                if (isset($array['Cards']) && is_array($array['Cards'])) {
                    foreach ($array['Cards'] as &$card) {
                        $this->processUpload($card, 'Image', 'image');
                    }
                }
            }
            if (in_array($contentKey, ['HowItWorksSection', 'EventsSection'])) {
                $this->processUpload($array, 'Title Icon', 'icon');
                $this->processUpload($array, 'Background Image', 'image');
            }
            if (in_array($contentKey, ['CallToAction'])) {
                $this->processUpload($array, 'Background Image', 'image');
            }
            if (in_array($contentKey, ['BannerSection'])) {
                $this->processUpload($array, 'Background Image', 'image');
            }
            if ($contentKey === 'FooterSection') {
                $this->processUpload($array, 'Title Icon', 'icon');
                if (isset($array['Map']) && is_array($array['Map'])) {
                    $this->processUpload($array['Map'], 'Title Icon', 'icon');
                }
                if (isset($array['Useful Links']) && is_array($array['Useful Links'])) {
                    foreach ($array['Useful Links'] as &$linkGroup) {
                        if (is_array($linkGroup)) {
                            $this->processUpload($linkGroup, 'Icon', 'icon');
                        }
                    }
                }
                if (isset($array['Newsletter']) && is_array($array['Newsletter'])) {
                    $this->processUpload($array['Newsletter'], 'Title Icon', 'icon');
                }
            }

            // common setting used in the pages will be stored in the separate table
            if(in_array($contentKey, TemplatePageSetting::COMMON_CONTENT)){
                $commonContent[$lang][$contentKey] = $array;
            }

            $existingContent[$lang][$contentKey] = $array;
        }

        $this->updateCommonSetting($commonContent);

        return $this->setting->update([
            'content' => json_encode($existingContent, JSON_UNESCAPED_UNICODE)
        ]);
    }

    private function handleUpload($value, $path, $isNew)
    {
        if ($isNew && $value instanceof \Illuminate\Http\UploadedFile) {
            return UPLOAD_FILE($value, $path);
        }
        return $value;
    }

    private function processUpload($target, $keyName, $path)
    {
        if (isset($target[$keyName]) || isset($target["old_" . $keyName])) {
            $target[$keyName] = $this->handleUpload(
                $target[$keyName] ?? $target["old_" . $keyName] ?? null,
                "setting/" . $this->setting->id . "/$path",
                isset($target[$keyName]) // is new?
            );
        }
    }

    private function updateCommonSetting($commonContent)
    {
        $commonSetting = CommonPageSetting::firstOrCreate([]);

        // Decode existing content to associative array
        $existingContent = json_decode($commonSetting->content ?? '{}', true);

        // Deep merge new content into existing content
        $mergedContent = $this->deepMergeContent($existingContent, $commonContent);

        // Step 3: Preserve required keys from COMMON_CONTENT if missing
        foreach ($existingContent as $key => $value) {
            if (!array_key_exists($key, $mergedContent) && in_array($key, TemplatePageSetting::COMMON_CONTENT)) {
                $mergedContent[$key] = $value;
            }
        }

        // Update database
        $commonSetting->update([
            'content' => json_encode($mergedContent, JSON_UNESCAPED_UNICODE),
        ]);

        // dd(json_decode($commonSetting->fresh()->content, true));
    }

    private function deepMergeContent(array $old, array $new): array
    {
        foreach ($new as $key => $value) {
            if (is_array($value) && isset($old[$key]) && is_array($old[$key])) {
                // If both old and new are arrays, merge deeply
                $old[$key] = $this->deepMergeContent($old[$key], $value);
            } else {
                // Otherwise, override or add the new value
                $old[$key] = $value;
            }
        }
        return $old;
    }

}