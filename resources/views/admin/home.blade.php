@extends('admin.layouts.app')
@section('content')
    @php
        $works = \App\Models\Work::all();
        $skills = \App\Models\Skill::all();
        $contacts = \App\Models\Contact::orderBy('created_at', 'desc')->get();
        $pages = \App\Models\Page::all();
        $settingData = \App\Models\Setting::first() ?? new \App\Models\Setting([
            'email' => 'admin@aetheria.sys',
            'phone' => '+1 (555) 019-2831',
            'address' => 'Grid Sector 4, Neo-Tokyo',
            'avaliable_time' => '08:00 - 18:00 UTC'
        ]);

        $viewsCount = \Illuminate\Support\Facades\Cache::get('unique_views', 1248);
        $inquiriesCount = count($contacts);
    @endphp
    <main>
        <!-- Header -->
        <header>
            <button class="mobile-sidebar-toggle" id="mobile-sidebar-toggle" aria-label="Toggle Navigation">
                <i data-lucide="menu" style="width:20px;height:20px;color:var(--neon-cyan);"></i>
            </button>
            <div class="search-box">
                <i data-lucide="search" style="width:16px;height:16px;color:var(--text-secondary);"></i>
                <input type="text" placeholder="Search system routes..." aria-label="Search inputs">
                <span class="search-shortcut">⌘K</span>
            </div>

            <div class="header-meta">
                <div class="meta-metric">
                    <span>Response:</span>
                    <span class="val">{{ round((microtime(true) - LARAVEL_START) * 1000) }} ms</span>
                </div>
                <div class="meta-metric">
                    <span>Traffic:</span>
                    <span class="val">99.8%</span>
                </div>
            </div>
        </header>

        <!-- Dashboard views container -->
        <div class="dashboard-content">
            @include('admin.sections.overview')
            @include('admin.sections.projects')
            @include('admin.sections.skills')
            @include('admin.sections.inquiries')
            @include('admin.sections.pages')
            @include('admin.sections.settings')
            @include('admin.sections.system')
        </div>
    </main>

    <!-- CONSOLE TOAST NOTIFICATION -->
    <div class="console-toast-container">
        <div class="console-toast" id="console-toast">
            <span id="toast-text">SYS:: CONNECTING TO DATABASE STREAM...</span>
        </div>
    </div>
@endsection

@push('extra-scripts')
    <script>
        window.dashboardStats = {
            viewsCount: {{ $viewsCount }},
            inquiriesCount: {{ $inquiriesCount }},
            worksCount: {{ count($works) }},
            skillsCount: {{ count($skills) }}
        };

        // Success Flash Toast Trigger
        @if(session('success'))
            const toast = document.getElementById("console-toast");
            const toastText = document.getElementById("toast-text");
            if (toast && toastText) {
                toastText.innerText = "SYS:: {{ session('success') }}";
                toast.classList.add("active");
                setTimeout(() => {
                    toast.classList.remove("active");
                }, 4000);
            }
        @endif
    </script>
@endpush