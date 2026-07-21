<?php

namespace App\Http\Controllers\SuperAdmin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Show General Settings form
     */
    public function index()
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();

        return view('super-admin.settings.general', compact('settings'));
    }

    /**
     * Store or Update General Settings
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'site_logo'  => 'nullable|image|mimes:webp,png,jpg,jpeg|max:2048',
            'favicon'    => 'nullable|image|mimes:png,ico|max:1024',
            'linkedin'   => 'nullable|string|max:255',
            'facebook'   => 'nullable|string|max:255',
            'twitter'    => 'nullable|string|max:255',
            'instagram'  => 'nullable|string|max:255',
        ]);

        $settings = GeneralSetting::firstOrNew();
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $image = upload_image(
                $settings,
                $file,
                'settings',
                'site_logo',
                true,
                true,
                $settings->site_logo
            );
            $settings->site_logo = $image->path;
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $image = upload_image(
                $settings,
                $file,
                'settings',
                'favicon',
                true,
                true,
                $settings->favicon
            );
            $settings->favicon = $image->path;
        }
        if($request->has('social_links')) {
            $settings->linkedin  = $data['linkedin'] ?? '#';
            $settings->facebook  = $data['facebook'] ?? '#';
            $settings->twitter   = $data['twitter'] ?? '#';
            $settings->instagram = $data['instagram'] ?? '#';
        }
        $settings->save();

        return redirect()->back()->with('success', 'General settings updated successfully');
    }
}