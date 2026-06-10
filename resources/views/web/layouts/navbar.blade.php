@php
    $PageData = \App\Models\Page::pluck('value', 'key');
@endphp
<div class="bg-layer">
    <canvas id="matrix-canvas"></canvas>
    <div class="glow-orb orb-1"></div>
    <div class="glow-orb orb-2"></div>
    <div class="cyber-overlay"></div>
</div>

<!-- Header navigation dock -->
<header>
    <div class="container">
        <nav class="navbar-cyber">
            <a href="#" class="logo-cyber">
                &lt;{{ $PageData['site_name'] }}<span>.dev</span> /&gt;
            </a>
            <ul class="nav-links-cyber">
                <li class="active"><a href="#about">About</a></li>
                <li><a href="#works">Works</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <button class="btn-terminal" onclick="location.href='#contact'">Let's talk</button>
        </nav>
    </div>
</header>