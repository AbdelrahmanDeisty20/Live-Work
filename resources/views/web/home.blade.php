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
                    @forelse($skills as $skill)
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber">
                                @php
                                    $titleLower = strtolower($skill->title);
                                    $icon = 'cpu';
                                    if (str_contains($titleLower, 'back') || str_contains($titleLower, 'infra')) $icon = 'terminal';
                                    elseif (str_contains($titleLower, 'front') || str_contains($titleLower, 'dev') || str_contains($titleLower, 'web')) $icon = 'layers';
                                    elseif (str_contains($titleLower, 'design') || str_contains($titleLower, 'ui') || str_contains($titleLower, 'ux')) $icon = 'git-branch';
                                    elseif (str_contains($titleLower, 'database') || str_contains($titleLower, 'sql') || str_contains($titleLower, 'db')) $icon = 'database';
                                    elseif (str_contains($titleLower, 'cloud') || str_contains($titleLower, 'server')) $icon = 'cloud';
                                    elseif (str_contains($titleLower, 'mobile') || str_contains($titleLower, 'app')) $icon = 'smartphone';
                                    elseif (str_contains($titleLower, 'security') || str_contains($titleLower, 'crypt')) $icon = 'shield';
                                    elseif (str_contains($titleLower, 'test') || str_contains($titleLower, 'qa')) $icon = 'check-square';
                                    elseif (str_contains($titleLower, 'ai') || str_contains($titleLower, 'learn') || str_contains($titleLower, 'intel')) $icon = 'brain';
                                    elseif (str_contains($titleLower, 'chart') || str_contains($titleLower, 'analy')) $icon = 'bar-chart-2';
                                    elseif (str_contains($titleLower, 'api') || str_contains($titleLower, 'link')) $icon = 'link';
                                    elseif (str_contains($titleLower, 'micro')) $icon = 'server';
                                    elseif (str_contains($titleLower, 'docker') || str_contains($titleLower, 'container')) $icon = 'box';
                                    elseif (str_contains($titleLower, 'serverless') || str_contains($titleLower, 'lambda')) $icon = 'zap';
                                    elseif (str_contains($titleLower, 'os') || str_contains($titleLower, 'linux') || str_contains($titleLower, 'system')) $icon = 'hard-drive';
                                    elseif (str_contains($titleLower, 'git') || str_contains($titleLower, 'version')) $icon = 'git-pull-request';
                                    elseif (str_contains($titleLower, 'time') || str_contains($titleLower, 'socket')) $icon = 'clock';
                                    elseif (str_contains($titleLower, 'game') || str_contains($titleLower, 'play')) $icon = 'gamepad-2';
                                    elseif (str_contains($titleLower, 'network') || str_contains($titleLower, 'globe')) $icon = 'globe';
                                @endphp
                                <i data-lucide="{{ $icon }}" style="width:20px;height:20px;"></i>
                            </div>
                            <h3>{{ $skill->title }}</h3>
                            <div class="skill-list-cyber">
                                @foreach($skill->contents as $item)
                                    <div class="skill-element-cyber">
                                        <div class="skill-label-cyber">
                                            <span class="skill-name-cyber">{{ $item->title }}</span>
                                            <span class="skill-percent-cyber">{{ is_numeric(trim($item->value)) ? trim($item->value) . '%' : $item->value }}</span>
                                        </div>
                                        <div class="skill-meter-bg">
                                            <div class="skill-meter-fill" data-val="{{ $item->percentage }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <!-- Static Fallback: Backend Infrastructure (12 items to test scrollbar overflow) -->
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="terminal" style="width:20px;height:20px;"></i></div>
                            <h3>Backend Infrastructure</h3>
                            <div class="skill-list-cyber">
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">PHP 8 / Laravel 11</span>
                                        <span class="skill-percent-cyber">95%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="95"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">RESTful API Design</span>
                                        <span class="skill-percent-cyber">90%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="90"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">SQL Optimization</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Firebase Realtime DB</span>
                                        <span class="skill-percent-cyber">80%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="80"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Redis Caching</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Docker Containerization</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">GraphQL APIs</span>
                                        <span class="skill-percent-cyber">80%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="80"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Node.js / Express</span>
                                        <span class="skill-percent-cyber">75%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="75"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Python / Django</span>
                                        <span class="skill-percent-cyber">70%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="70"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Git workflows</span>
                                        <span class="skill-percent-cyber">90%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="90"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Serverless AWS Lambda</span>
                                        <span class="skill-percent-cyber">82%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="82"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Bash Scripting</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                            </div>
                        </div>

                        <!-- Static Fallback: Frontend Engineering -->
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="layers" style="width:20px;height:20px;"></i></div>
                            <h3>Frontend Engineering</h3>
                            <div class="skill-list-cyber">
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">JavaScript ES6 / TS</span>
                                        <span class="skill-percent-cyber">90%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="90"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Vue.js / React</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">CSS Grid / Flexbox</span>
                                        <span class="skill-percent-cyber">95%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="95"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Tailwind CSS styling</span>
                                        <span class="skill-percent-cyber">92%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="92"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">HTML5 Semantics</span>
                                        <span class="skill-percent-cyber">98%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="98"></div></div>
                                </div>
                            </div>
                        </div>

                        <!-- Static Fallback: DevOps & Cloud -->
                        <div class="skill-matrix-card">
                            <div class="skill-card-icon-cyber"><i data-lucide="cloud" style="width:20px;height:20px;"></i></div>
                            <h3>DevOps & Cloud</h3>
                            <div class="skill-list-cyber">
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">CI/CD Pipelines</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">AWS / GCP Admin</span>
                                        <span class="skill-percent-cyber">80%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="80"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Kubernetes setup</span>
                                        <span class="skill-percent-cyber">75%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="75"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">Figma Prototyping</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                                <div class="skill-element-cyber">
                                    <div class="skill-label-cyber">
                                        <span class="skill-name-cyber">OWASP Security Top 10</span>
                                        <span class="skill-percent-cyber">85%</span>
                                    </div>
                                    <div class="skill-meter-bg"><div class="skill-meter-fill" data-val="85"></div></div>
                                </div>
                            </div>
                        </div>
                    @endforelse
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