@php
    $pages = \App\Models\Page::all()->pluck('value', 'key');
@endphp

<footer class="footer-cyber">
        <div class="footer-grid-bg"></div>
        <div class="container">
            <div class="footer-main-layout">
                <!-- Brand Info Block -->
                <div class="footer-brand-block">
                    <a href="#" class="logo-cyber">
                        {{ $pages['site_name'] }}<span class="highlight">.dev</span>
                    </a>
                    <p class="footer-brand-desc">Architecting robust full-stack applications with sophisticated design systems and futuristic digital interfaces.</p>
                    <div class="footer-status-tag">
                        <span class="pulse-dot"></span>
                        <span>SECURE NODE ONLINE // PORT 443</span>
                    </div>
                </div>

                <!-- Social Links / Channels Block -->
                <div class="footer-links-block">
                    <h4>// DIGITAL CHANNELS</h4>
                    <div class="social-grid-cyber">
                        <a href="https://github.com" target="_blank" class="social-card-cyber github-card">
                            <div class="social-card-inner">
                                <i data-lucide="github" style="width:20px;height:20px;"></i>
                                <span class="social-name">GitHub</span>
                                <span class="social-alias">@livework-dev</span>
                            </div>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="social-card-cyber linkedin-card">
                            <div class="social-card-inner">
                                <i data-lucide="linkedin" style="width:20px;height:20px;"></i>
                                <span class="social-name">LinkedIn</span>
                                <span class="social-alias">LiveWork Profile</span>
                            </div>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="social-card-cyber facebook-card">
                            <div class="social-card-inner">
                                <i data-lucide="facebook" style="width:20px;height:20px;"></i>
                                <span class="social-name">Facebook</span>
                                <span class="social-alias">LiveWork Tech</span>
                            </div>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="social-card-cyber instagram-card">
                            <div class="social-card-inner">
                                <i data-lucide="instagram" style="width:20px;height:20px;"></i>
                                <span class="social-name">Instagram</span>
                                <span class="social-alias">@livework.dev</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Quick Navigation -->
                <div class="footer-nav-block">
                    <h4>// INDEX DIRECTORY</h4>
                    <ul class="footer-nav-list">
                        <li><a href="#home"><span class="bullet">&gt;</span> // HOME</a></li>
                        <li><a href="#projects"><span class="bullet">&gt;</span> // PROJECTS</a></li>
                        <li><a href="#skills"><span class="bullet">&gt;</span> // SKILLS</a></li>
                        <li><a href="#contact"><span class="bullet">&gt;</span> // CONTACT</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <p class="credit-cyber">&copy; {{ date('Y') }} {{ $pages['site_name'] }} Dev. All rights reserved. Secure host session verified.</p>
                <div class="footer-telemetry">
                    <span>PING: <strong class="telemetry-ping">12ms</strong></span>
                    <span class="separator">|</span>
                    <span>DB STATUS: <strong class="telemetry-status">OPTIMAL</strong></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- CONSOLE TOAST NOTIFICATION -->
    <div class="console-toast-container">
        <div class="console-toast" id="console-toast">
            <span id="toast-text">SYS:: CONNECTING TO DATABASE STREAM...</span>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <!-- Script execution link -->
   <script src="{{ asset('assets/script.js') }}"></script>
    <script>
        // Init Lucide after DOM load
        lucide.createIcons();
    </script>
    @stack('extra-scripts')
</body>
</html>
