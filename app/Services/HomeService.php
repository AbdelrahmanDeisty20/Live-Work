<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Work;

class HomeService
{
    public function index()
    {
        $works = Work::with('tecknicals')->get();
        $skills = Skill::with('contents')->get();
        $pages = Page::all()->pluck('value', 'key');
        $settings = Setting::first();

        if (!session()->has('visited')) {
            session()->put('visited', true);
            if (!\Illuminate\Support\Facades\Cache::has('unique_views')) {
                \Illuminate\Support\Facades\Cache::put('unique_views', 1248, now()->addYears(10));
            } else {
                \Illuminate\Support\Facades\Cache::increment('unique_views');
            }
        }

        return view('web.home', compact('works', 'skills', 'pages', 'settings'));
    }
}
