// Dynamic Portfolio Control System

document.addEventListener("DOMContentLoaded", () => {
    // 1. Initialize Lucide Icons
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // 2. Light / Dark Theme Toggle
    const themeToggle = document.getElementById("theme-toggle");
    const sunIcon = document.getElementById("sun-icon");
    const moonIcon = document.getElementById("moon-icon");

    // Check saved theme or system preference
    const savedTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeIcons(savedTheme);

    themeToggle.addEventListener("click", () => {
        const currentTheme = document.documentElement.getAttribute("data-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        
        document.documentElement.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        updateThemeIcons(newTheme);
        
        // Spawn theme transition burst particles if canvas exists
        triggerThemeBurst();
    });

    function updateThemeIcons(theme) {
        if (theme === "light") {
            sunIcon.style.display = "none";
            moonIcon.style.display = "block";
        } else {
            sunIcon.style.display = "block";
            moonIcon.style.display = "none";
        }
    }

    // 3. HTML5 Canvas Particles System
    const canvas = document.getElementById("particle-canvas");
    const ctx = canvas.getContext("2d");
    let particlesArray = [];
    let mouse = { x: null, y: null, radius: 100 };

    window.addEventListener("mousemove", (event) => {
        mouse.x = event.x;
        mouse.y = event.y;
    });

    window.addEventListener("mouseout", () => {
        mouse.x = null;
        mouse.y = null;
    });

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
            this.alpha = Math.random() * 0.5 + 0.2;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = `rgba(139, 92, 246, ${this.alpha})`;
            ctx.fill();
        }

        update() {
            if (this.x > canvas.width || this.x < 0) {
                this.directionX = -this.directionX;
            }
            if (this.y > canvas.height || this.y < 0) {
                this.directionY = -this.directionY;
            }

            // Mouse collision checks
            let dx = mouse.x - this.x;
            let dy = mouse.y - this.y;
            let distance = Math.sqrt(dx * dx + dy * dy);
            if (distance < mouse.radius + this.size) {
                if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                    this.x += 2;
                }
                if (mouse.x > this.x && this.x > this.size * 10) {
                    this.x -= 2;
                }
                if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                    this.y += 2;
                }
                if (mouse.y > this.y && this.y > this.size * 10) {
                    this.y -= 2;
                }
            }

            this.x += this.directionX;
            this.y += this.directionY;
            this.draw();
        }
    }

    function initParticles() {
        particlesArray = [];
        let numberOfParticles = (canvas.width * canvas.height) / 14000;
        numberOfParticles = Math.min(numberOfParticles, 120); // Limit count
        for (let i = 0; i < numberOfParticles; i++) {
            let size = Math.random() * 2 + 1;
            let x = Math.random() * (innerWidth - size * 2) + size;
            let y = Math.random() * (innerHeight - size * 2) + size;
            let directionX = (Math.random() * 0.4) - 0.2;
            let directionY = (Math.random() * 0.4) - 0.2;
            let color = "rgba(139, 92, 246, 0.4)";
            particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    function connectParticles() {
        let opacityValue = 1;
        for (let a = 0; a < particlesArray.length; a++) {
            for (let b = a; b < particlesArray.length; b++) {
                let dx = particlesArray[a].x - particlesArray[b].x;
                let dy = particlesArray[a].y - particlesArray[b].y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < 110) {
                    opacityValue = 1 - (distance / 110);
                    ctx.strokeStyle = `rgba(139, 92, 246, ${opacityValue * 0.12})`;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                    ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, innerWidth, innerHeight);
        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
        }
        connectParticles();
        requestAnimationFrame(animateParticles);
    }

    initParticles();
    animateParticles();

    function triggerThemeBurst() {
        for (let i = 0; i < 15; i++) {
            let size = Math.random() * 4 + 2;
            let x = Math.random() * canvas.width;
            let y = Math.random() * canvas.height;
            let directionX = (Math.random() * 2) - 1;
            let directionY = (Math.random() * 2) - 1;
            particlesArray.push(new Particle(x, y, directionX, directionY, size, "rgba(217, 70, 239, 0.8)"));
        }
    }

    // 4. Interactive 3D Card Hover Tilt Effect
    const tiltCards = document.querySelectorAll(".work-card, .avatar-frame");
    tiltCards.forEach(card => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -8; // Max 8 degrees tilt
            const rotateY = ((x - centerX) / centerX) * 8;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)`;
        });
    });

    // 5. Work Projects Filter logic
    const filterButtons = document.querySelectorAll(".filter-btn");
    const workCards = document.querySelectorAll(".work-card");

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filterValue = btn.getAttribute("data-filter");

            workCards.forEach(card => {
                const category = card.getAttribute("data-category");
                if (filterValue === "all" || category === filterValue) {
                    card.style.display = "flex";
                    setTimeout(() => {
                        card.style.opacity = "1";
                        card.style.transform = "scale(1)";
                    }, 50);
                } else {
                    card.style.opacity = "0";
                    card.style.transform = "scale(0.95)";
                    setTimeout(() => {
                        card.style.display = "none";
                    }, 300);
                }
            });
        });
    });

    // 6. Project Details Modal Logic
    const projectData = {
        aetheria: {
            title: "Aetheria Platform",
            subtitle: "Luxury Real Estate Infrastructure",
            tags: ["Laravel", "Vue.js", "SQLite"],
            img: "./images/aetheria.png",
            desc: "Aetheria is an industry-leading property search engine optimized for luxury properties. Equipped with a custom Laravel 11 controller interface, a SQLite query optimization engine, and a fully reactive Vue.js search matrix. The product includes automated caching policies, spatial search capability, and a sleek dark mode user interface built with high-fidelity components.",
            client: "Aetheria Group Inc.",
            date: "May 2026",
            url: "https://aetheria.studio"
        },
        vortex: {
            title: "Vortex Analytics",
            subtitle: "Real-Time Metric Dashboard",
            tags: ["React", "PHP 8.3", "Vite"],
            img: "./images/vortex.png",
            desc: "Vortex delivers real-time analytics for developer tracking suites. Integrating interactive SVG vector canvases with clean REST endpoints, it provides microsecond latency rendering for chart systems. Scaled to handle millions of data points smoothly through canvas throttling and optimized web socket hooks.",
            client: "Vortex DevTools Corp",
            date: "March 2026",
            url: "https://vortex.io"
        },
        nova: {
            title: "Nova AI Portal",
            subtitle: "AI Asset Management Portal",
            tags: ["Laravel", "OpenAI", "Python"],
            img: "./images/nova.png",
            desc: "Nova AI serves as a central orchestrator for generative model fine-tuning and asset tracking. Integrating custom OpenAI LLM streaming interfaces with active Laravel job queues, users can process, prompt, and catalog assets synchronously with minimum overhead. Designed with high-performance security features and modular prompt configurations.",
            client: "Nova Labs Ltd.",
            date: "January 2026",
            url: "https://nova-ai.net"
        }
    };

    const modalOverlay = document.getElementById("modal-overlay");
    const modalCloseBtn = document.getElementById("modal-close-btn");
    const exploreButtons = document.querySelectorAll(".explore-project");

    exploreButtons.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            const projectKey = btn.getAttribute("data-project");
            const data = projectData[projectKey];

            if (data) {
                document.getElementById("modal-img").src = data.img;
                document.getElementById("modal-title").innerText = data.title;
                document.getElementById("modal-subtitle").innerText = data.subtitle;
                document.getElementById("modal-desc").innerText = data.desc;
                document.getElementById("modal-client").innerText = data.client;
                document.getElementById("modal-date").innerText = data.date;
                document.getElementById("modal-url").innerText = data.url;
                document.getElementById("modal-url").href = data.url;

                // Render badges
                const badgeContainer = document.getElementById("modal-tech-badges");
                badgeContainer.innerHTML = "";
                data.tags.forEach(t => {
                    const span = document.createElement("span");
                    span.className = `tag-badge ${t.toLowerCase().replace(".", "")}`;
                    span.innerText = t;
                    badgeContainer.appendChild(span);
                });

                modalOverlay.classList.add("active");
                document.body.style.overflow = "hidden";
            }
        });
    });

    modalCloseBtn.addEventListener("click", closeModal);
    modalOverlay.addEventListener("click", (e) => {
        if (e.target === modalOverlay) closeModal();
    });

    function closeModal() {
        modalOverlay.classList.remove("active");
        document.body.style.overflow = "";
    }

    // 7. Scroll-Triggered Progress Bar & Active Link Highlight
    const sections = document.querySelectorAll("section");
    const navItems = document.querySelectorAll(".nav-links li");

    window.addEventListener("scroll", () => {
        let current = "";
        const scrollY = window.scrollY;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 150;
            const sectionHeight = section.clientHeight;
            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                current = section.getAttribute("id");
            }
        });

        navItems.forEach(li => {
            li.classList.remove("active");
            const a = li.querySelector("a");
            if (a && a.getAttribute("href") === `#${current}`) {
                li.classList.add("active");
            }
        });

        // Trigger Skill Bars filling if they scroll into view
        const skillsSection = document.getElementById("skills");
        if (skillsSection) {
            const rect = skillsSection.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                fillSkillBars();
            }
        }
    });

    function fillSkillBars() {
        const skillFills = document.querySelectorAll(".skill-bar-fill");
        skillFills.forEach(fill => {
            const val = fill.getAttribute("data-val");
            fill.style.width = val + "%";
        });
    }

    // 8. Contact Form Handler & Toast System
    const contactForm = document.getElementById("portfolio-contact-form");
    const toast = document.getElementById("success-toast");

    if (contactForm) {
        contactForm.addEventListener("submit", (e) => {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = `Sending... <span class="status-dot" style="margin-left:5px;"></span>`;
            submitBtn.disabled = true;

            setTimeout(() => {
                // Success State
                showToast();
                contactForm.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1200);
        });
    }

    function showToast() {
        toast.classList.add("show");
        setTimeout(() => {
            toast.classList.remove("show");
        }, 4000);
    }
});
