<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fluid Aura - Premium Creative Developer Portfolio using warm ivory layouts and soft gradients.">
    <title>Fluid Aura | Creative Studio Portfolio</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,400;1,400&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-light: #faf9f6;
            --card-bg: rgba(255, 255, 255, 0.45);
            --card-border: rgba(255, 255, 255, 0.7);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.01);
            --card-shadow-hover: 0 20px 40px rgba(139, 92, 246, 0.08), 0 1px 5px rgba(139, 92, 246, 0.02);
            
            --text-dark: #1e293b;
            --text-muted: #64748b;
            
            --primary-color: #8b5cf6;
            --primary-light: #a78bfa;
            --primary-gradient: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            
            --pastel-purple: rgba(139, 92, 246, 0.06);
            --pastel-teal: rgba(20, 184, 166, 0.06);
            --pastel-peach: rgba(245, 158, 11, 0.06);
            --pastel-pink: rgba(236, 72, 153, 0.06);
        }

        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        button, input, textarea {
            font-family: inherit;
            outline: none;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-light);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Fluid Aura Background Blobs */
        .aura-container {
            position: fixed;
            inset: 0;
            z-index: -2;
            overflow: hidden;
            pointer-events: none;
        }

        .aura-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.45;
            mix-blend-mode: multiply;
            animation: floatBlob 25s infinite alternate ease-in-out;
        }

        .blob-1 {
            width: 500px;
            height: 500px;
            background: #c084fc;
            top: -10%;
            left: -10%;
        }

        .blob-2 {
            width: 600px;
            height: 600px;
            background: #fed7aa;
            bottom: -15%;
            right: -10%;
            animation-delay: -5s;
        }

        .blob-3 {
            width: 450px;
            height: 450px;
            background: #99f6e4;
            top: 40%;
            left: 50%;
            animation-delay: -10s;
        }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, -50px) scale(1.1); }
            100% { transform: translate(-30px, 30px) scale(0.95); }
        }

        /* Light beam spotlight tracker */
        .light-beam {
            position: fixed;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(253, 186, 116, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: -1;
            border-radius: 50%;
        }

        /* Grid overlay pattern */
        .grid-lines {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: -1;
            pointer-events: none;
        }

        /* Container */
        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header Navbar navigation */
        header {
            position: fixed;
            top: 1.5rem;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            padding: 0.8rem 2rem;
            border-radius: 100px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .nav-logo {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .nav-logo span {
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .nav-links a:hover {
            color: var(--text-dark);
        }

        .nav-btn {
            background: var(--text-dark);
            color: #fff;
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: var(--primary-color);
            transform: translateY(-1px);
        }

        /* General Section rules */
        section {
            padding: 8rem 0 4rem;
        }

        /* Hero Section */
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 3.5rem;
            align-items: center;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .hero-badge {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.65);
            border: 1px solid var(--card-border);
            padding: 0.4rem 1rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-color);
            box-shadow: var(--card-shadow);
        }

        .hero-title {
            font-size: 3.6rem;
            line-height: 1.15;
            letter-spacing: -2px;
            color: var(--text-dark);
        }

        .editorial-serif {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 400;
            color: var(--primary-color);
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: #fff;
            padding: 0.85rem 2rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid var(--card-border);
            color: var(--text-dark);
            padding: 0.85rem 2rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: var(--card-shadow);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        /* Hero Avatar Card */
        .avatar-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 30px;
            padding: 1rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .avatar-card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-4px);
        }

        .avatar-inner {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 22px;
            overflow: hidden;
            background: #f1f5f9;
        }

        .avatar-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Sections headers styling */
        .section-header {
            margin-bottom: 3.5rem;
        }

        .section-header h2 {
            font-size: 2.2rem;
            letter-spacing: -1px;
            margin-bottom: 0.6rem;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 500px;
        }

        /* Projects grid and cards */
        .projects-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .project-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            display: flex;
            gap: 2.5rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(139, 92, 246, 0.2);
        }

        .project-img {
            width: 320px;
            aspect-ratio: 16/10;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.03);
            flex-shrink: 0;
        }

        .project-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .project-tags {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .project-tags span {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
        }

        /* Pastel tag colored frames */
        .tag-laravel { background: var(--pastel-teal); color: #0d9488; }
        .tag-vue { background: var(--pastel-purple); color: #7c3aed; }
        .tag-react { background: var(--pastel-peach); color: #d97706; }
        .tag-python { background: var(--pastel-pink); color: #db2777; }

        .project-info h3 {
            font-size: 1.4rem;
            margin-bottom: 0.8rem;
            color: var(--text-dark);
        }

        .project-info p {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .project-link {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .project-link:hover {
            color: var(--primary-color);
        }

        .project-link svg {
            transition: transform 0.3s ease;
        }

        .project-card:hover .project-link svg {
            transform: translateX(3px);
        }

        /* Skills Column grid layouts */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.8rem;
        }

        .skill-category-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 2.2rem;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .skill-category-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .skill-category-card h3 {
            font-size: 1.15rem;
            margin-bottom: 1.2rem;
            color: var(--text-dark);
            border-bottom: 1px solid rgba(0,0,0,0.03);
            padding-bottom: 0.6rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .skill-tag {
            background: rgba(255,255,255,0.7);
            border: 1px solid var(--card-border);
            padding: 0.4rem 0.85rem;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            border-color: var(--primary-color);
            background: #fff;
            transform: scale(1.03);
        }

        /* Contact form glass panel */
        .contact-layout {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 4rem;
        }

        .contact-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 2.2rem;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-icon {
            width: 44px;
            height: 44px;
            background: #fff;
            border: 1px solid var(--card-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            box-shadow: var(--card-shadow);
        }

        .contact-details h4 {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .contact-details p {
            font-size: 1rem;
            font-weight: 600;
        }

        .contact-form {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.7);
            border: 1px solid var(--card-border);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.92rem;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            background: #fff;
            box-shadow: 0 0 10px rgba(139, 92, 246, 0.05);
        }

        textarea.form-input {
            resize: none;
            min-height: 110px;
        }

        .form-btn {
            width: 100%;
            background: var(--text-dark);
            color: #fff;
            border: none;
            padding: 0.85rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-btn:hover {
            background: var(--primary-color);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
        }

        /* Footer */
        footer {
            padding: 3rem 0;
            text-align: center;
            border-top: 1px solid rgba(0,0,0,0.03);
            background: rgba(255, 255, 255, 0.15);
        }

        footer p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Responsive configurations */
        @media (max-width: 900px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .hero-badge {
                align-self: center;
            }
            
            .hero-desc {
                margin: 0 auto;
            }
            
            .hero-actions {
                justify-content: center;
            }
            
            .project-card {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .project-img {
                width: 100%;
            }
            
            .skills-grid {
                grid-template-columns: 1fr;
            }
            
            .contact-layout {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Background Auras -->
    <div class="aura-container">
        <div class="aura-blob blob-1"></div>
        <div class="aura-blob blob-2"></div>
        <div class="aura-blob blob-3"></div>
    </div>

    <!-- Interactive Mouse Spotlight Light Beam -->
    <div class="light-beam" id="light-beam"></div>

    <!-- Soft Grid Overlay Pattern -->
    <div class="grid-lines"></div>

    <!-- Navigation Bar Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="#" class="nav-logo">
                    Aether<span>.</span>
                </a>
                <ul class="nav-links">
                    <li><a href="#about">About</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <button class="nav-btn" onclick="location.href='#contact'">Let's talk</button>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero-section" id="about">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <div class="hero-badge">Full Stack Engineer</div>
                    <h1 class="hero-title">
                        Designing experiences that feel <span class="editorial-serif">fluid</span>, building systems that scale.
                    </h1>
                    <p class="hero-desc">
                        I bridge logic with clean, minimalist aesthetics. Specialized in PHP/Laravel backend architecture and interactive frontend user layouts.
                    </p>
                    <div class="hero-actions">
                        <button class="btn-primary" onclick="location.href='#projects'">
                            View Projects
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                        <button class="btn-secondary" onclick="location.href='#contact'">Get In Touch</button>
                    </div>
                </div>
                
                <div class="avatar-card">
                    <div class="avatar-inner">
                        <img src="/images/avatar.png" alt="Developer Studio Profile">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects">
        <div class="container">
            <div class="section-header">
                <h2>Selected Works</h2>
                <p>A collection of applications engineered with clean code architecture and premium minimalist UI designs.</p>
            </div>

            <div class="projects-grid">
                <!-- Project 1 -->
                <div class="project-card">
                    <div class="project-img">
                        <img src="/images/aetheria.png" alt="Aetheria Premium Real Estate Portal preview">
                    </div>
                    <div class="project-info">
                        <div>
                            <div class="project-tags">
                                <span class="tag-laravel">Laravel</span>
                                <span class="tag-vue">Vue.js</span>
                            </div>
                            <h3>Aetheria Platform</h3>
                            <p>Luxury real estate application hosting premium dark layouts, sqlite caching matrices, and clean UI components.</p>
                        </div>
                        <a href="#" class="project-link">
                            Explore Application
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="project-card">
                    <div class="project-img">
                        <img src="/images/vortex.png" alt="Vortex Data Analytics Dashboard preview">
                    </div>
                    <div class="project-info">
                        <div>
                            <div class="project-tags">
                                <span class="tag-react">React</span>
                                <span class="tag-laravel">PHP 8.3</span>
                            </div>
                            <h3>Vortex Dashboard</h3>
                            <p>Futuristic data analytics dashboard integrating dynamic SVG layout visualizations and real-time metric trackers.</p>
                        </div>
                        <a href="#" class="project-link">
                            Explore Application
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="project-card">
                    <div class="project-img">
                        <img src="/images/nova.png" alt="Nova AI Asset Manager portal preview">
                    </div>
                    <div class="project-info">
                        <div>
                            <div class="project-tags">
                                <span class="tag-laravel">Laravel</span>
                                <span class="tag-python">OpenAI API</span>
                            </div>
                            <h3>Nova AI Portal</h3>
                            <p>AI-assisted digital asset management suite. Integrates LLM interfaces with clean analytics dashboard panels.</p>
                        </div>
                        <a href="#" class="project-link">
                            Explore Application
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SKILLS SECTION -->
    <section id="skills">
        <div class="container">
            <div class="section-header">
                <h2>Capabilities</h2>
                <p>Technologies and systems that I work with to design and construct applications.</p>
            </div>

            <div class="skills-grid">
                <!-- Backend -->
                <div class="skill-category-card">
                    <h3>Backend Architecture</h3>
                    <div class="skills-list">
                        <span class="skill-tag">PHP 8.3</span>
                        <span class="skill-tag">Laravel 11</span>
                        <span class="skill-tag">REST APIs</span>
                        <span class="skill-tag">SQL / SQLite</span>
                        <span class="skill-tag">Docker</span>
                    </div>
                </div>

                <!-- Frontend -->
                <div class="skill-category-card">
                    <h3>Frontend Engineering</h3>
                    <div class="skills-list">
                        <span class="skill-tag">JavaScript ES6</span>
                        <span class="skill-tag">Vue.js / React</span>
                        <span class="skill-tag">CSS3 / Tailwind</span>
                        <span class="skill-tag">HTML5 Semantic</span>
                        <span class="skill-tag">Vite / Webpack</span>
                    </div>
                </div>

                <!-- Tools -->
                <div class="skill-category-card">
                    <h3>Design & Operations</h3>
                    <div class="skills-list">
                        <span class="skill-tag">Figma</span>
                        <span class="skill-tag">Git / GitHub</span>
                        <span class="skill-tag">CI/CD Workflows</span>
                        <span class="skill-tag">Web Audio API</span>
                        <span class="skill-tag">SEO Audit</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" style="padding-bottom: 8rem;">
        <div class="container">
            <div class="section-header">
                <h2>Initiate Project</h2>
                <p>Have an idea or project? Drop a line and let's construct it together.</p>
            </div>

            <div class="contact-layout">
                <div class="contact-card">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div class="contact-details">
                            <h4>Email Me</h4>
                            <p>contact@aetheria.studio</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="contact-details">
                            <h4>Location</h4>
                            <p>Cairo, Egypt</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <form id="aura-contact-form">
                        <div class="form-group">
                            <label for="form-name">Name</label>
                            <input type="text" id="form-name" class="form-input" required placeholder="Your name">
                        </div>
                        <div class="form-group">
                            <label for="form-email">Email Address</label>
                            <input type="email" id="form-email" class="form-input" required placeholder="Your email address">
                        </div>
                        <div class="form-group">
                            <label for="form-message">Message Details</label>
                            <textarea id="form-message" class="form-input" required placeholder="Outline your project..."></textarea>
                        </div>
                        <button type="submit" class="form-btn">Transmit message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>&copy; 2026 Aetheria Studio. Crafted with Laravel and premium CSS assets.</p>
        </div>
    </footer>

    <!-- JavaScript Actions & Animations -->
    <script>
        // 1. Mouse Tracking Spotlight & Aura Parallax
        const lightBeam = document.getElementById('light-beam');
        const blobs = document.querySelectorAll('.aura-blob');

        let mouseX = 0;
        let mouseY = 0;
        let currentX = 0;
        let currentY = 0;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            // Slight parallax movement on background aura blobs
            const offsetX = (e.clientX - window.innerWidth / 2) * 0.015;
            const offsetY = (e.clientY - window.innerHeight / 2) * 0.015;
            
            blobs.forEach((blob, idx) => {
                const factor = (idx + 1) * 0.5;
                blob.style.transform = `translate(${offsetX * factor}px, ${offsetY * factor}px)`;
            });
        });

        // Smooth lerp animation for the cursor spotlight light beam
        function animateLight() {
            const dx = mouseX - currentX;
            const dy = mouseY - currentY;
            
            currentX += dx * 0.1;
            currentY += dy * 0.1;
            
            if (lightBeam) {
                lightBeam.style.left = `${currentX}px`;
                lightBeam.style.top = `${currentY}px`;
            }
            
            requestAnimationFrame(animateLight);
        }
        animateLight();

        // 2. Interactive Page Scroll Navigation triggers
        const nav = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.style.padding = '0.6rem 1.8rem';
                nav.style.background = 'rgba(255, 255, 255, 0.75)';
                nav.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.05)';
            } else {
                nav.style.padding = '0.8rem 2rem';
                nav.style.background = 'rgba(255, 255, 255, 0.4)';
                nav.style.boxShadow = 'var(--card-shadow)';
            }
        });

        // 3. Contact Form Submission Logic
        const form = document.getElementById('aura-contact-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                const submitBtn = form.querySelector('button[type="submit"]');
                const origText = submitBtn.textContent;
                submitBtn.textContent = 'Sending Message...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    submitBtn.textContent = 'Message Received! ✨';
                    submitBtn.style.background = '#10b981';
                    
                    alert('Your message was successfully logged. I will contact you back shortly.');
                    form.reset();
                    
                    setTimeout(() => {
                        submitBtn.textContent = origText;
                        submitBtn.style.background = '';
                        submitBtn.disabled = false;
                    }, 3000);
                }, 1200);
            });
        }
    </script>
</body>
</html>
