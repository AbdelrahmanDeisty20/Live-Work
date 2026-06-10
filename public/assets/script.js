// Cyber-Constellation Script Controller

document.addEventListener("DOMContentLoaded", () => {
    // 1. Interactive 3D Constellation Sphere Background
    const canvas = document.getElementById("matrix-canvas");
    const ctx = canvas.getContext("2d");
    let particles = [];
    let mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };
    let rotationX = 0;
    let rotationY = 0;

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    // Track mouse coordinates relative to center
    window.addEventListener("mousemove", (e) => {
        mouse.targetX = (e.clientX - window.innerWidth / 2) * 0.05;
        mouse.targetY = (e.clientY - window.innerHeight / 2) * 0.05;
        
        // Update custom cursor positions
        const cursor = document.getElementById("custom-cursor");
        const dot = document.getElementById("custom-cursor-dot");
        if (cursor && dot) {
            cursor.style.left = e.clientX + "px";
            cursor.style.top = e.clientY + "px";
            dot.style.left = e.clientX + "px";
            dot.style.top = e.clientY + "px";
        }
    });

    // Expand custom cursor on hover
    const links = document.querySelectorAll("a, button, input, textarea, .project-card-cyber");
    const cursor = document.getElementById("custom-cursor");
    links.forEach(link => {
        link.addEventListener("mouseenter", () => {
            if (cursor) {
                cursor.style.width = "40px";
                cursor.style.height = "40px";
                cursor.style.backgroundColor = "rgba(0, 242, 254, 0.1)";
            }
        });
        link.addEventListener("mouseleave", () => {
            if (cursor) {
                cursor.style.width = "20px";
                cursor.style.height = "20px";
                cursor.style.backgroundColor = "transparent";
            }
        });
    });

    // 3D coordinates for points forming a sphere
    const sphereRadius = 250;
    const totalPoints = 90;

    class Point3D {
        constructor() {
            // Generate uniform points on a sphere using spherical coordinates
            const u = Math.random();
            const v = Math.random();
            const theta = u * 2.0 * Math.PI;
            const phi = Math.acos(2.0 * v - 1.0);
            
            this.x = sphereRadius * Math.sin(phi) * Math.cos(theta);
            this.y = sphereRadius * Math.sin(phi) * Math.sin(theta);
            this.z = sphereRadius * Math.cos(phi);
            
            this.baseX = this.x;
            this.baseY = this.y;
            this.baseZ = this.z;
        }

        project(rotatedX, rotatedY) {
            // Rotation on Y axis (left-right)
            let cosY = Math.cos(rotatedY);
            let sinY = Math.sin(rotatedY);
            let x1 = this.baseX * cosY - this.baseZ * sinY;
            let z1 = this.baseX * sinY + this.baseZ * cosY;

            // Rotation on X axis (up-down)
            let cosX = Math.cos(rotatedX);
            let sinX = Math.sin(rotatedX);
            let y2 = this.baseY * cosX - z1 * sinX;
            let z2 = this.baseY * sinX + z1 * cosX;

            // Perspective division
            const fov = 400; // Field of view
            const cameraDistance = 500;
            const scale = fov / (cameraDistance + z2);

            this.projX = (x1 * scale) + canvas.width / 2;
            this.projY = (y2 * scale) + canvas.height / 2;
            this.scale = scale;
            this.zDepth = z2;
        }

        draw() {
            // Color gets brighter/opaque as it comes closer to camera
            const alpha = Math.max(0.1, (sphereRadius - this.zDepth) / (sphereRadius * 2));
            ctx.beginPath();
            ctx.arc(this.projX, this.projY, 2 * this.scale, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(0, 242, 254, ${alpha * 0.8})`;
            ctx.fill();
        }
    }

    // Initialize sphere points
    for (let i = 0; i < totalPoints; i++) {
        particles.push(new Point3D());
    }

    function drawConnections() {
        for (let i = 0; i < particles.length; i++) {
            let matches = 0;
            for (let j = i + 1; j < particles.length; j++) {
                // Connect close particles in 3D coordinate space
                const dx = particles[i].baseX - particles[j].baseX;
                const dy = particles[i].baseY - particles[j].baseY;
                const dz = particles[i].baseZ - particles[j].baseZ;
                const dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                if (dist < 120 && matches < 3) {
                    const alpha = Math.max(0.02, 0.15 - (dist / 120)) * 0.5;
                    ctx.strokeStyle = `rgba(0, 242, 254, ${alpha})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].projX, particles[i].projY);
                    ctx.lineTo(particles[j].projX, particles[j].projY);
                    ctx.stroke();
                    matches++;
                }
            }
        }
    }

    function animateSphere() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Smooth mouse rotation transition (lerping)
        mouse.x += (mouse.targetX - mouse.x) * 0.05;
        mouse.y += (mouse.targetY - mouse.y) * 0.05;

        // Auto spin + mouse rotation override
        rotationY += 0.002 + mouse.x * 0.0005;
        rotationX += 0.001 + mouse.y * 0.0005;

        particles.forEach(p => p.project(rotationX, rotationY));
        drawConnections();
        particles.forEach(p => p.draw());

        requestAnimationFrame(animateSphere);
    }
    animateSphere();

    // 2. Skill Progress Bars Scroll trigger
    const skillsSection = document.getElementById("skills");
    let animatedSkills = false;

    window.addEventListener("scroll", () => {
        // Scroll Highlights Navbar active links
        const sections = document.querySelectorAll("section");
        const navItems = document.querySelectorAll(".nav-links-cyber li");
        let current = "";

        sections.forEach(sec => {
            const top = sec.offsetTop - 150;
            const height = sec.clientHeight;
            if (window.scrollY >= top && window.scrollY < top + height) {
                current = sec.getAttribute("id");
            }
        });

        navItems.forEach(li => {
            li.classList.remove("active");
            const a = li.querySelector("a");
            if (a && a.getAttribute("href") === `#${current}`) {
                li.classList.add("active");
            }
        });

        // Skill animation trigger
        if (skillsSection) {
            const rect = skillsSection.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100 && !animatedSkills) {
                animateMeters();
                animatedSkills = true;
            }
        }
    });

    function animateMeters() {
        const meters = document.querySelectorAll(".skill-meter-fill");
        meters.forEach(m => {
            const val = m.getAttribute("data-val");
            m.style.width = val + "%";
        });
    }

    // 3. Contact Form Submission Terminal Log
    const contactForm = document.getElementById("cyber-contact-form");
    const toast = document.getElementById("console-toast");
    const toastText = document.getElementById("toast-text");

    if (contactForm) {
        contactForm.addEventListener("submit", (e) => {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Console feedback steps
            submitBtn.innerHTML = `[EXECUTING LOG...]`;
            submitBtn.disabled = true;

            setTimeout(() => {
                showConsoleToast("SYS:: CONNECTING TO DATABASE STREAM...");
                setTimeout(() => {
                    showConsoleToast("SYS:: TRANSMITTING DATA ENVELOPE...");
                    setTimeout(() => {
                        showConsoleToast("SYS:: SUCCESS. SECURE SESSION ESTABLISHED.");
                        contactForm.reset();
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 1500);
                }, 1000);
            }, 500);
        });
    }

    function showConsoleToast(msg) {
        toastText.innerText = msg;
        toast.classList.add("active");
        setTimeout(() => {
            toast.classList.remove("active");
        }, 3000);
    }
});
