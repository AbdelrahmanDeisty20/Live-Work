@include('admin.layouts.header')
@unless(View::hasSection('is-login'))
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    @include('admin.layouts.side-bar')
@endunless
@yield('content')
@include('admin.layouts.footer')