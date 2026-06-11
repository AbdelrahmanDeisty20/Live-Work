@extends('web.layouts.app')

@section('content')
    <section class="hero-section" id="about">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-info">
                    <div class="hero-badge-cyber">
                        <span class="blink-dot"></span>
                        {{ $pages['blue_title'] ?? 'Interactive' }}
                    </div>
                    <h1 class="hero-title-cyber">
                        {{ $pages['big_title'] }}
                    </h1>
                    <p class="hero-desc-cyber">
                        {{ $pages['small_title'] }}
                    </p>
                    <div class="hero-actions-cyber">
                        <button class="btn-neon" onclick="location.href='#works'">
                            Execute Works_
                            <i data-lucide="terminal" style="width:16px;height:16px;stroke-width:2.5;"></i>
                        </button>
                        <button class="btn-outline-cyber" onclick="location.href='#contact'">
                            Connect Session
                            <i data-lucide="network" style="width:16px;height:16px;"></i>
                        </button>
                    </div>
                </div>

                <div class="hero-frame-wrapper">
                    <div class="terminal-frame">
                        <div class="terminal-header">
                            <div class="window-dots">
                                <div class="dot dot-red"></div>
                                <div class="dot dot-yellow"></div>
                                <div class="dot dot-green"></div>
                            </div>
                            <span class="terminal-title">~/dev/avatar_display.sh</span>
                            <span style="opacity:0.25;"><i data-lucide="settings"
                                    style="width:12px;height:12px;"></i></span>
                        </div>
                        <div class="terminal-body">
                            <div class="avatar-container-cyber">
                                <img src="{{ asset('storage/' . $pages['image_about']) }}"
                                    alt="Creative engineering profile placeholder">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CAPABILITIES SECTION -->
    <section id="skills">
        <div class="container">
            <div class="header-cyber">
                <span class="tag-cyber">SYS::{{ $pages['blue_title_queries'] }}</span>
                <h2 class="title-cyber">{{ $pages['big_title_query'] }}</h2>
                <p class="desc-cyber">{{ $pages['queries_desc'] }}</p>
                <div class="slider-controls-cyber">

                    <button class="slider-arrow-btn prev-skills" aria-label="Previous skill card"><i
                            data-lucide="chevron-left"></i></button>
                    <button class="slider-arrow-btn next-skills" aria-label="Next skill card"><i
                            data-lucide="chevron-right"></i></button>
                </div>
            </div>

            <div class="skills-matrix-wrapper">
                <div class="skills-matrix">
                    @php $hasSkills = false; @endphp
                    @foreach($skills as $skill)
                        @foreach($skill->contents as $item)
                            @php $hasSkills = true; @endphp
                            <div class="skill-matrix-card">
                                <div class="skill-card-icon-cyber">
                                    @php
                                        $titleLower = strtolower($item->title);
                                        $icon = 'cpu';
                                        if (str_contains($titleLower, 'php') || str_contains($titleLower, 'laravel') || str_contains($titleLower, 'back') || str_contains($titleLower, 'infra') || str_contains($titleLower, 'node') || str_contains($titleLower, 'python') || str_contains($titleLower, 'django') || str_contains($titleLower, 'ruby') || str_contains($titleLower, 'go') || str_contains($titleLower, 'java') || str_contains($titleLower, 'c#') || str_contains($titleLower, 'asp') || str_contains($titleLower, 'api') || str_contains($titleLower, 'rest')) $icon = 'terminal';
                                        elseif (str_contains($titleLower, 'front') || str_contains($titleLower, 'dev') || str_contains($titleLower, 'web') || str_contains($titleLower, 'vue') || str_contains($titleLower, 'react') || str_contains($titleLower, 'angular') || str_contains($titleLower, 'js') || str_contains($titleLower, 'ts') || str_contains($titleLower, 'javascript') || str_contains($titleLower, 'typescript') || str_contains($titleLower, 'css') || str_contains($titleLower, 'html') || str_contains($titleLower, 'tailwind') || str_contains($titleLower, 'sass') || str_contains($titleLower, 'bootstrap')) $icon = 'layers';
                                        elseif (str_contains($titleLower, 'design') || str_contains($titleLower, 'ui') || str_contains($titleLower, 'ux') || str_contains($titleLower, 'figma') || str_contains($titleLower, 'photoshop') || str_contains($titleLower, 'illustrator') || str_contains($titleLower, 'adobe') || str_contains($titleLower, 'sketch')) $icon = 'git-branch';
                                        elseif (str_contains($titleLower, 'database') || str_contains($titleLower, 'sql') || str_contains($titleLower, 'db') || str_contains($titleLower, 'mysql') || str_contains($titleLower, 'postgres') || str_contains($titleLower, 'mongo') || str_contains($titleLower, 'oracle') || str_contains($titleLower, 'sqlite') || str_contains($titleLower, 'redis')) $icon = 'database';
                                        elseif (str_contains($titleLower, 'cloud') || str_contains($titleLower, 'server') || str_contains($titleLower, 'aws') || str_contains($titleLower, 'gcp') || str_contains($titleLower, 'azure') || str_contains($titleLower, 'hosting') || str_contains($titleLower, 'deploy')) $icon = 'cloud';
                                        elseif (str_contains($titleLower, 'mobile') || str_contains($titleLower, 'app') || str_contains($titleLower, 'flutter') || str_contains($titleLower, 'react native') || str_contains($titleLower, 'android') || str_contains($titleLower, 'ios') || str_contains($titleLower, 'swift') || str_contains($titleLower, 'kotlin')) $icon = 'smartphone';
                                        elseif (str_contains($titleLower, 'security') || str_contains($titleLower, 'crypt') || str_contains($titleLower, 'cyber') || str_contains($titleLower, 'penetration') || str_contains($titleLower, 'hack')) $icon = 'shield';
                                        elseif (str_contains($titleLower, 'test') || str_contains($titleLower, 'qa') || str_contains($titleLower, 'cypress') || str_contains($titleLower, 'jest') || str_contains($titleLower, 'unit')) $icon = 'check-square';
                                        elseif (str_contains($titleLower, 'ai') || str_contains($titleLower, 'learn') || str_contains($titleLower, 'intel') || str_contains($titleLower, 'gpt') || str_contains($titleLower, 'ml') || str_contains($titleLower, 'nlp')) $icon = 'brain';
                                        elseif (str_contains($titleLower, 'chart') || str_contains($titleLower, 'analy') || str_contains($titleLower, 'bi') || str_contains($titleLower, 'excel')) $icon = 'bar-chart-2';
                                        elseif (str_contains($titleLower, 'api') || str_contains($titleLower, 'link')) $icon = 'link';
                                        elseif (str_contains($titleLower, 'micro')) $icon = 'server';
                                        elseif (str_contains($titleLower, 'docker') || str_contains($titleLower, 'container') || str_contains($titleLower, 'k8s') || str_contains($titleLower, 'kubernetes')) $icon = 'box';
                                        elseif (str_contains($titleLower, 'serverless') || str_contains($titleLower, 'lambda')) $icon = 'zap';
                                        elseif (str_contains($titleLower, 'os') || str_contains($titleLower, 'linux') || str_contains($titleLower, 'system') || str_contains($titleLower, 'windows') || str_contains($titleLower, 'ubuntu')) $icon = 'hard-drive';
                                        elseif (str_contains($titleLower, 'git') || str_contains($titleLower, 'version') || str_contains($titleLower, 'github') || str_contains($titleLower, 'gitlab')) $icon = 'git-pull-request';
                                        elseif (str_contains($titleLower, 'time') || str_contains($titleLower, 'socket') || str_contains($titleLower, 'pusher') || str_contains($titleLower, 'realtime')) $icon = 'clock';
                                        elseif (str_contains($titleLower, 'game') || str_contains($titleLower, 'play') || str_contains($titleLower, 'unity') || str_contains($titleLower, 'unreal')) $icon = 'gamepad-2';
                                        elseif (str_contains($titleLower, 'network') || str_contains($titleLower, 'globe') || str_contains($titleLower, 'http') || str_contains($titleLower, 'dns')) $icon = 'globe';
                                    @endphp
                                    <i data-lucide="{{ $icon }}" style="width:24px;height:24px;"></i>
                                </div>
                                <h3>{{ $item->title }}</h3>
                                <span class="skill-tech-badge">SYS::{{ strtoupper(str_replace(' ', '_', $skill->title)) }}</span>
                            </div>
                        @endforeach
                    @endforeach

                    @if(!$hasSkills)
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:24px;height:24px;"></i></div>
                            <h3>PHP 8 / Laravel 11</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:24px;height:24px;"></i></div>
                            <h3>RESTful API Design</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:24px;height:24px;"></i></div>
                            <h3>SQL Optimization</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="database" style="width:24px;height:24px;"></i></div>
                            <h3>Firebase Realtime DB</h3>
                            <span class="skill-tech-badge">SYS::DATABASE</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="database" style="width:24px;height:24px;"></i></div>
                            <h3>Redis Caching</h3>
                            <span class="skill-tech-badge">SYS::INFRASTRUCTURE</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="box" style="width:24px;height:24px;"></i></div>
                            <h3>Docker Containerization</h3>
                            <span class="skill-tech-badge">SYS::DEVOPS</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="link" style="width:24px;height:24px;"></i></div>
                            <h3>GraphQL APIs</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:24px;height:24px;"></i></div>
                            <h3>Node.js / Express</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:24px;height:24px;"></i></div>
                            <h3>Python / Django</h3>
                            <span class="skill-tech-badge">SYS::BACKEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="git-pull-request" style="width:24px;height:24px;"></i></div>
                            <h3>Git workflows</h3>
                            <span class="skill-tech-badge">SYS::VERSION_CONTROL</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="zap" style="width:24px;height:24px;"></i></div>
                            <h3>Serverless AWS Lambda</h3>
                            <span class="skill-tech-badge">SYS::CLOUD</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="hard-drive" style="width:24px;height:24px;"></i></div>
                            <h3>Bash Scripting</h3>
                            <span class="skill-tech-badge">SYS::SYSTEM</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:24px;height:24px;"></i></div>
                            <h3>JavaScript ES6 / TS</h3>
                            <span class="skill-tech-badge">SYS::FRONTEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:24px;height:24px;"></i></div>
                            <h3>Vue.js / React</h3>
                            <span class="skill-tech-badge">SYS::FRONTEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:24px;height:24px;"></i></div>
                            <h3>CSS Grid / Flexbox</h3>
                            <span class="skill-tech-badge">SYS::FRONTEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:24px;height:24px;"></i></div>
                            <h3>Tailwind CSS styling</h3>
                            <span class="skill-tech-badge">SYS::FRONTEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:24px;height:24px;"></i></div>
                            <h3>HTML5 Semantics</h3>
                            <span class="skill-tech-badge">SYS::FRONTEND</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="cloud" style="width:24px;height:24px;"></i></div>
                            <h3>CI/CD Pipelines</h3>
                            <span class="skill-tech-badge">SYS::DEVOPS</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="cloud" style="width:24px;height:24px;"></i></div>
                            <h3>AWS / GCP Admin</h3>
                            <span class="skill-tech-badge">SYS::CLOUD</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="box" style="width:24px;height:24px;"></i></div>
                            <h3>Kubernetes setup</h3>
                            <span class="skill-tech-badge">SYS::DEVOPS</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="git-branch" style="width:24px;height:24px;"></i></div>
                            <h3>Figma Prototyping</h3>
                            <span class="skill-tech-badge">SYS::DESIGN</span>
                        </div>
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="shield" style="width:24px;height:24px;"></i></div>
                            <h3>OWASP Security Top 10</h3>
                            <span class="skill-tech-badge">SYS::SECURITY</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const container = document.querySelector(".skills-matrix");
                const prevBtn = document.querySelector(".prev-skills");
                const nextBtn = document.querySelector(".next-skills");

                if (container && prevBtn && nextBtn) {
                    const getScrollAmount = () => {
                        const card = container.querySelector(".skill-matrix-card");
                        if (!card) return 300;
                        return card.clientWidth + parseFloat(getComputedStyle(container).gap || 32);
                    };

                    prevBtn.addEventListener("click", () => {
                        container.scrollBy({
                            left: -getScrollAmount(),
                            behavior: "smooth"
                        });
                    });

                    nextBtn.addEventListener("click", () => {
                        container.scrollBy({
                            left: getScrollAmount(),
                            behavior: "smooth"
                        });
                    });
                }
            });
        </script>
    </section>

    <!-- PROJECTS/WORKS SECTION -->
    <section id="works">
        <div class="container">
            <div class="header-cyber">
                <span class="tag-cyber">SYS::{{ $pages['blue_title_works'] }}</span>
                <h2 class="title-cyber">{{ $pages['works_title'] }}</h2>
                <p class="desc-cyber">{{ $pages['works_desc'] }}</p>
            </div>

            <div class="projects-cyber-grid">
                @forelse ($works as $work)
                    <div class="project-card-cyber">
                        <div class="project-cover-cyber">
                            @if(strpos($work->image, 'http') === 0)
                                <img src="{{ $work->image }}" alt="{{ $work->title }}">
                            @else
                                <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}">
                            @endif
                        </div>
                        <div class="project-details-cyber">
                            <div>
                                <div class="project-tags-cyber">
                                    @foreach ($work->tecknicals as $tecknical)
                                        <span class="tag-badge-cyber">{{ $tecknical->name }}</span>
                                    @endforeach
                                </div>
                                <h3 class="project-title-cyber" style="margin-top:0.8rem;">{{ $work->title }}</h3>
                                <p class="project-desc-cyber" style="margin-top:0.5rem;">{{ $work->description }}</p>
                            </div>
                            <a href="{{ $work->link }}" class="project-link-cyber" style="margin-top:1rem;">
                                Initialize_Link
                                <i data-lucide="arrow-up-right" style="width:16px;height:16px;"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Project 1 (Fallback) -->
                    <div class="project-card-cyber">
                        <div class="project-cover-cyber">
                            <img src="./images/quantum.png" alt="Quantum Crypto ledger Terminal Preview">
                        </div>
                        <div class="project-details-cyber">
                            <div>
                                <div class="project-tags-cyber">
                                    <span class="tag-badge-cyber">Laravel 11</span>
                                    <span class="tag-badge-cyber">MySQL</span>
                                    <span class="tag-badge-cyber">Tailwind CSS</span>
                                </div>
                                <h3 class="project-title-cyber" style="margin-top:0.8rem;">Quantum Ledger</h3>
                                <p class="project-desc-cyber" style="margin-top:0.5rem;">Decentralized ledger monitor dashboard integrating real-time telemetry from multiple node pools and validator channels.</p>
                            </div>
                            <a href="#" class="project-link-cyber" style="margin-top:1rem;">
                                Initialize_Link
                                <i data-lucide="arrow-up-right" style="width:16px;height:16px;"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Project 2 (Fallback) -->
                    <div class="project-card-cyber">
                        <div class="project-cover-cyber">
                            <img src="./images/vortex.png" alt="Vortex Data Analytics Dashboard Preview">
                        </div>
                        <div class="project-details-cyber">
                            <div>
                                <div class="project-tags-cyber">
                                    <span class="tag-badge-cyber">React 18</span>
                                    <span class="tag-badge-cyber">PHP 8.3</span>
                                    <span class="tag-badge-cyber">Tailwind CSS</span>
                                </div>
                                <h3 class="project-title-cyber" style="margin-top:0.8rem;">Vortex Dashboard</h3>
                                <p class="project-desc-cyber" style="margin-top:0.5rem;">Metrics logging system streaming client diagnostics via web-sockets with real-time vector graphs and data throttle layers.</p>
                            </div>
                            <a href="#" class="project-link-cyber" style="margin-top:1rem;">
                                Initialize_Link
                                <i data-lucide="arrow-up-right" style="width:16px;height:16px;"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Project 3 (Fallback) -->
                    <div class="project-card-cyber">
                        <div class="project-cover-cyber">
                            <img src="./images/nova.png" alt="Nova AI Asset Manager preview">
                        </div>
                        <div class="project-details-cyber">
                            <div>
                                <div class="project-tags-cyber">
                                    <span class="tag-badge-cyber">Laravel JobQueue</span>
                                    <span class="tag-badge-cyber">OpenAI API</span>
                                    <span class="tag-badge-cyber">Python</span>
                                </div>
                                <h3 class="project-title-cyber" style="margin-top:0.8rem;">Nova AI Portal</h3>
                                <p class="project-desc-cyber" style="margin-top:0.5rem;">AI asset classification manager utilizing asynchronous jobs and workers to index, prompt, and process digital files.</p>
                            </div>
                            <a href="#" class="project-link-cyber" style="margin-top:1rem;">
                                Initialize_Link
                                <i data-lucide="arrow-up-right" style="width:16px;height:16px;"></i>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" style="padding-bottom: 8rem;">
        <div class="container">
            <div class="header-cyber">
                <span class="tag-cyber">SYS::{{ $pages['blue_title_contacts'] }}</span>
                <h2 class="title-cyber">{{ $pages['big_title_contacts'] }}</h2>
                <p class="desc-cyber">{{ $pages['desc_contacts'] }}</p>
            </div>

            <div class="contact-cyber-grid">
                <div class="contact-card-cyber">
                    <!-- Info 1 -->
                    <div class="info-box-cyber">
                        <div class="info-icon-cyber"><i data-lucide="mail" style="width:18px;height:18px;"></i></div>
                        <div class="info-details-cyber">
                            <h4>EmailAddress</h4>
                            <p>{{ $settings->email }}</p>
                        </div>
                    </div>
                    <!-- Info 2 -->
                    <div class="info-box-cyber">
                        <div class="info-icon-cyber"><i data-lucide="map-pin" style="width:18px;height:18px;"></i></div>
                        <div class="info-details-cyber">
                            <h4>Base Node</h4>
                            <p>{{ $settings->address }}</p>
                        </div>
                    </div>
                    <!-- Info 3 -->
                    <div class="info-box-cyber">
                        <div class="info-icon-cyber"><i data-lucide="cpu" style="width:18px;height:18px;"></i></div>
                        <div class="info-details-cyber">
                            <h4>Availability</h4>
                            <p>{{ $settings->avaliable_time }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Box -->
                <div class="form-box-cyber">
                    <form id="cyber-contact-form">
                        @csrf
                        <div class="form-group-cyber">
                            <label for="usr-name">Client Identifier</label>
                            <div class="input-cyber-wrapper">
                                <input type="text" id="usr-name" name="name" class="input-cyber" required placeholder="e.g. John Doe">
                            </div>
                        </div>
                        <div class="form-group-cyber">
                            <label for="usr-email">Email Node Address</label>
                            <div class="input-cyber-wrapper">
                                <input type="email" id="usr-email" name="email" class="input-cyber" required
                                    placeholder="e.g. client@domain.com">
                            </div>
                        </div>
                        <div class="form-group-cyber">
                            <label for="usr-phone">Phone Connection Node</label>
                            <div class="input-cyber-wrapper">
                                <input type="text" id="usr-phone" name="phone" class="input-cyber" required
                                    placeholder="e.g. +966501234567 or 01012345678">
                            </div>
                        </div>
                        <div class="form-group-cyber">
                            <label for="usr-message">Transmission Details</label>
                            <div class="input-cyber-wrapper">
                                <textarea id="usr-message" name="message" class="input-cyber" required
                                    placeholder="Describe task scope, technologies, timeline..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-cyber">
                            Dispatch Package
                            <i data-lucide="send" style="width:16px;height:16px;stroke-width:2.5;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('extra-scripts')
    <script>
        $(document).ready(function(){
            $('#cyber-contact-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 7,
                        maxlength: 16
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.css({ 
                        color: "#ef4444", 
                        fontSize: "0.75rem", 
                        marginTop: "5px", 
                        display: "block", 
                        fontFamily: "var(--font-mono)" 
                    });
                    element.closest(".form-group-cyber").append(error);
                },
                submitHandler: function(form) {
                    const $btn = $(form).find('button[type="submit"]');
                    const oldText = $btn.text();
                    $btn.prop('disabled', true).html('<i data-lucide="loader-2" style="width:16px;height:16px;stroke-width:2.5;" class="animate-spin"></i> Processing...');
                    lucide.createIcons();

                    $.ajax({
                        url: "{{ route('contact') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        success: function(response) {
                            $btn.prop('disabled', false).html(oldText);
                            if (response.success) {
                                Swal.fire({
                                    title: 'PACKAGE DELIVERED',
                                    text: 'SYS:: ' + response.message,
                                    icon: 'success',
                                    background: '#0a0b1e',
                                    color: '#e2e8f0',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                form.reset();
                            } else {
                                Swal.fire({
                                    title: 'TRANSMISSION FAILED',
                                    text: 'SYS:: ' + (response.message || 'Server error'),
                                    icon: 'error',
                                    background: '#0a0b1e',
                                    color: '#e2e8f0'
                                });
                            }
                        },
                        error: function(xhr) {
                            $btn.prop('disabled', false).html(oldText);
                            var msg = "Connection failed. Please try again.";
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                msg = Object.values(xhr.responseJSON.errors).map(function(e) { return e.join(', '); }).join(' ');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: 'NETWORK_ERROR',
                                text: 'SYS:: ' + msg,
                                icon: 'warning',
                                background: '#0a0b1e',
                                color: '#e2e8f0'
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush