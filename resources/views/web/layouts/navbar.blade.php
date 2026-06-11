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
            <ul class="nav-links-cyber" id="nav-links">
                <li class="active"><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#works">Works</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <button class="btn-terminal" onclick="location.href='#contact'">Let's talk</button>
            <button class="mobile-menu-toggle-btn" id="mobile-menu-toggle" aria-label="Toggle Menu">
                <i data-lucide="menu" class="icon-menu" style="width: 20px; height: 20px;"></i>
                <i data-lucide="x" class="icon-close" style="width: 20px; height: 20px;"></i>
            </button>
        </nav>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.getElementById("mobile-menu-toggle");
        const navLinks = document.getElementById("nav-links");

        if (toggleBtn && navLinks) {
            toggleBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                navLinks.classList.toggle("active");
                toggleBtn.classList.toggle("active");
            });

            // Close menu when clicking on a link
            navLinks.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", () => {
                    navLinks.classList.remove("active");
                    toggleBtn.classList.remove("active");
                });
            });

            // Close menu when clicking outside
            document.addEventListener("click", (e) => {
                if (!navLinks.contains(e.target) && !toggleBtn.contains(e.target)) {
                    navLinks.classList.remove("active");
                    toggleBtn.classList.remove("active");
                }
            });
        }
    });
</script>