// Cyber-Dashboard script controller

document.addEventListener("DOMContentLoaded", () => {
    // Mobile Sidebar Toggle Logic
    const sidebar = document.querySelector("aside");
    const sidebarOverlay = document.getElementById("sidebar-overlay");
    const mobileToggleBtn = document.getElementById("mobile-sidebar-toggle");

    if (mobileToggleBtn && sidebar) {
        mobileToggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle("active");
            }
        });
    }

    if (sidebarOverlay && sidebar) {
        sidebarOverlay.addEventListener("click", () => {
            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");
        });
    }

    // Also close sidebar on menu item click (on mobile)
    const sidebarMenuItems = document.querySelectorAll(".sidebar-menu .menu-item");
    sidebarMenuItems.forEach(item => {
        item.addEventListener("click", () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove("active");
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove("active");
                }
            }
        });
    });

    // 1. Sidebar Tab Transitions
    const menuItems = document.querySelectorAll(".menu-item");
    const sections = document.querySelectorAll(".dashboard-section");

    menuItems.forEach(item => {
        item.addEventListener("click", () => {
            const targetSection = item.getAttribute("data-tab");
            
            // Toggle active menu class
            menuItems.forEach(mi => mi.classList.remove("active"));
            item.classList.add("active");

            // Toggle active section
            sections.forEach(sec => {
                sec.classList.remove("active");
                if (sec.id === targetSection) {
                    sec.classList.add("active");
                }
            });
        });
    });

    // 2. Custom Interactive SVG Chart rendering
    const chartContainer = document.querySelector(".chart-container");
    
    const baseViews = [120, 240, 180, 320, 410, 380, 520, 480, 600, 750, 690];
    const baseInquiries = [5, 12, 8, 15, 22, 18, 30, 25, 42, 38, 45];
    
    const realViews = window.dashboardStats ? window.dashboardStats.viewsCount : 840;
    const realInquiries = window.dashboardStats ? window.dashboardStats.inquiriesCount : 50;

    const pointsData = {
        views: [...baseViews, realViews],
        inquiries: [...baseInquiries, realInquiries]
    };

    function renderChart(type) {
        if (!chartContainer) return;
        chartContainer.innerHTML = "";

        const data = pointsData[type];
        const width = chartContainer.clientWidth;
        const height = chartContainer.clientHeight;
        const padding = 30;

        const maxVal = Math.max(...data) * 1.15;
        const minVal = 0;

        // Create SVG element
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("width", "100%");
        svg.setAttribute("height", "100%");
        svg.setAttribute("viewBox", `0 0 ${width} ${height}`);

        // Generate Path coordinates
        let pointsString = "";
        let areaPointsString = `${padding},${height - padding} `;

        const stepX = (width - padding * 2) / (data.length - 1);
        const calcY = (val) => {
            const ratio = (val - minVal) / (maxVal - minVal);
            return height - padding - ratio * (height - padding * 2);
        };

        data.forEach((val, i) => {
            const x = padding + i * stepX;
            const y = calcY(val);
            pointsString += `${x},${y} `;
            areaPointsString += `${x},${y} `;
        });

        areaPointsString += `${width - padding},${height - padding}`;

        // Grid lines (horizontal)
        for (let i = 0; i <= 4; i++) {
            const y = padding + (i * (height - padding * 2)) / 4;
            const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
            line.setAttribute("x1", padding);
            line.setAttribute("y1", y);
            line.setAttribute("x2", width - padding);
            line.setAttribute("y2", y);
            line.setAttribute("stroke", "rgba(0, 242, 254, 0.04)");
            line.setAttribute("stroke-dasharray", "4");
            svg.appendChild(line);
        }

        // Fill Area Gradient
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        const grad = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
        grad.setAttribute("id", "chartGrad");
        grad.setAttribute("x1", "0");
        grad.setAttribute("y1", "0");
        grad.setAttribute("x2", "0");
        grad.setAttribute("y2", "1");
        
        const stop1 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
        stop1.setAttribute("offset", "0%");
        stop1.setAttribute("stop-color", "rgba(0, 242, 254, 0.2)");
        
        const stop2 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
        stop2.setAttribute("offset", "100%");
        stop2.setAttribute("stop-color", "rgba(0, 242, 254, 0)");
        
        grad.appendChild(stop1);
        grad.appendChild(stop2);
        defs.appendChild(grad);
        svg.appendChild(defs);

        // Render Area Path
        const areaPath = document.createElementNS("http://www.w3.org/2000/svg", "polyline");
        areaPath.setAttribute("fill", "url(#chartGrad)");
        areaPath.setAttribute("points", areaPointsString);
        svg.appendChild(areaPath);

        // Render Line Path
        const polyline = document.createElementNS("http://www.w3.org/2000/svg", "polyline");
        polyline.setAttribute("fill", "none");
        polyline.setAttribute("stroke", "url(#lineGrad)");
        polyline.setAttribute("stroke-width", "2.5");
        polyline.setAttribute("points", pointsString);
        
        // Add Line Gradient
        const lineGrad = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
        lineGrad.setAttribute("id", "lineGrad");
        lineGrad.setAttribute("x1", "0");
        lineGrad.setAttribute("y1", "0");
        lineGrad.setAttribute("x2", "1");
        lineGrad.setAttribute("y2", "0");
        
        const lineStop1 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
        lineStop1.setAttribute("offset", "0%");
        lineStop1.setAttribute("stop-color", "#00f2fe");
        const lineStop2 = document.createElementNS("http://www.w3.org/2000/svg", "stop");
        lineStop2.setAttribute("offset", "100%");
        lineStop2.setAttribute("stop-color", "#a855f7");
        
        lineGrad.appendChild(lineStop1);
        lineGrad.appendChild(lineStop2);
        defs.appendChild(lineGrad);
        
        polyline.setAttribute("stroke", "url(#lineGrad)");
        svg.appendChild(polyline);

        // Render interactive indicator dots
        data.forEach((val, i) => {
            const x = padding + i * stepX;
            const y = calcY(val);

            const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
            circle.setAttribute("cx", x);
            circle.setAttribute("cy", y);
            circle.setAttribute("r", "4");
            circle.setAttribute("fill", "#04050d");
            circle.setAttribute("stroke", "#00f2fe");
            circle.setAttribute("stroke-width", "2");
            circle.style.cursor = "pointer";

            // Tooltip interactivity
            circle.addEventListener("mouseenter", (e) => {
                circle.setAttribute("r", "6");
                circle.setAttribute("fill", "#00f2fe");
                showTooltip(e.clientX, e.clientY, val, type);
            });
            circle.addEventListener("mouseleave", () => {
                circle.setAttribute("r", "4");
                circle.setAttribute("fill", "#04050d");
                hideTooltip();
            });

            svg.appendChild(circle);
        });

        chartContainer.appendChild(svg);
    }

    // Tooltip elements
    const tooltip = document.createElement("div");
    tooltip.style.position = "fixed";
    tooltip.style.background = "rgba(6, 7, 20, 0.95)";
    tooltip.style.border = "1px solid #00f2fe";
    tooltip.style.boxShadow = "0 0 15px rgba(0, 242, 254, 0.2)";
    tooltip.style.padding = "0.4rem 0.8rem";
    tooltip.style.borderRadius = "6px";
    tooltip.style.fontSize = "0.75rem";
    tooltip.style.fontFamily = "var(--font-mono)";
    tooltip.style.color = "#00f2fe";
    tooltip.style.pointerEvents = "none";
    tooltip.style.opacity = "0";
    tooltip.style.transition = "opacity 0.2s ease";
    tooltip.style.zIndex = "1000";
    document.body.appendChild(tooltip);

    function showTooltip(x, y, value, type) {
        tooltip.innerHTML = `Value: <strong>${value}</strong> <span style="color:#fff;">${type}</span>`;
        tooltip.style.left = `${x + 10}px`;
        tooltip.style.top = `${y - 35}px`;
        tooltip.style.opacity = "1";
    }

    function hideTooltip() {
        tooltip.style.opacity = "0";
    }

    // Toggle views vs inquiries
    const toggleButtons = document.querySelectorAll(".chart-toggle-btn");
    toggleButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            toggleButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            renderChart(btn.getAttribute("data-type"));
        });
    });

    renderChart("views");

    // Re-render chart on window resizing
    window.addEventListener("resize", () => {
        const activeBtn = document.querySelector(".chart-toggle-btn.active");
        renderChart(activeBtn ? activeBtn.getAttribute("data-type") : "views");
    });

    // 3. Dynamic Terminal Logger simulation
    const terminalLogs = document.getElementById("terminal-logs");
    const worksCount = window.dashboardStats ? window.dashboardStats.worksCount : 3;
    const inquiriesCount = window.dashboardStats ? window.dashboardStats.inquiriesCount : 48;
    const skillsCount = window.dashboardStats ? window.dashboardStats.skillsCount : 5;

    const logPool = [
        { tag: "SYS", msg: "Scanning firewall endpoints..." },
        { tag: "API", msg: "GET /api/v1/works 200 OK (18ms)" },
        { tag: "DB", msg: `Query cached details: ${worksCount} project nodes active` },
        { tag: "DB", msg: `Synced skill matrix: ${skillsCount} stack categories online` },
        { tag: "DB", msg: `Inbox decrypt status: ${inquiriesCount} secure transmission envelopes logged` },
        { tag: "SEC", msg: "Security Shield: Blocked request from IP 185.220.101.4" },
        { tag: "PORT", msg: "New guest transmission registered in stream queue" },
        { tag: "SYS", msg: "Worker process job dispatch: SyncAssetsCache" },
        { tag: "API", msg: "GET /admin/dashboard 200 OK (24ms)" }
    ];

    function appendLog() {
        if (!terminalLogs) return;
        
        // Remove oldest log if matching limit
        if (terminalLogs.children.length > 8) {
            terminalLogs.removeChild(terminalLogs.firstChild);
        }

        const now = new Date();
        const timeStr = now.toTimeString().split(" ")[0];
        const randomLog = logPool[Math.floor(Math.random() * logPool.length)];

        const logLine = document.createElement("div");
        logLine.className = "log-line";
        logLine.innerHTML = `
            <span class="log-time">[${timeStr}]</span>
            <span class="log-tag">[${randomLog.tag}]</span>
            <span class="log-msg">${randomLog.msg}</span>
        `;
        
        terminalLogs.appendChild(logLine);
        terminalLogs.scrollTop = terminalLogs.scrollHeight;
    }

    // Populate initial logs
    for (let i = 0; i < 5; i++) {
        appendLog();
    }
    // Append a log every 3.5 seconds
    setInterval(appendLog, 3500);

    // === 4. Modal Interactions (Projects & Skills) ===
    const projectModal = document.getElementById("project-modal");
    const skillModal = document.getElementById("skill-modal");
    const openProjectBtn = document.getElementById("open-project-modal");
    const openSkillBtn = document.getElementById("open-skill-modal");
    const closeButtons = document.querySelectorAll(".close-modal");

    // Helper to open modal
    function openModal(modal) {
        if (modal) modal.classList.add("active");
    }

    // Helper to close modal
    function closeModal(modal) {
        if (modal) modal.classList.remove("active");
    }

    if (openProjectBtn) {
        openProjectBtn.addEventListener("click", () => {
            // Reset form for "Add" mode
            const form = document.getElementById("project-form");
            if (form) {
                form.reset();
                form.action = "/admin/projects";
                document.getElementById("project-form-method").value = "POST";
                document.getElementById("project-tags").value = "";
                document.getElementById("project-modal-title").innerText = "SYS:: INITIALIZE NEW PROJECT NODE";
                document.getElementById("project-submit-btn").innerText = "Commit Node";
            }
            openModal(projectModal);
        });
    }

    if (openSkillBtn) {
        openSkillBtn.addEventListener("click", () => {
            // Reset form for "Add" mode
            const form = document.getElementById("skill-form");
            if (form) {
                form.reset();
                form.action = "/admin/skills";
                document.getElementById("skill-form-method").value = "POST";
                document.getElementById("skill-modal-title").innerText = "SYS:: REGISTER NEW SKILL NODE";
                document.getElementById("skill-submit-btn").innerText = "Commit Node";
            }
            openModal(skillModal);
        });
    }

    // Close buttons handler
    closeButtons.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            closeModal(projectModal);
            closeModal(skillModal);
        });
    });

    // Close when clicking backdrop
    [projectModal, skillModal].forEach(modal => {
        if (modal) {
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    closeModal(modal);
                }
            });
        }
    });

    // Edit Project Button Click Handler
    document.querySelectorAll(".edit-project-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            if (btn.getAttribute("data-demo")) {
                alert("Demo node edit action initialized. (Real database node required to save)");
                return;
            }
            const id = btn.getAttribute("data-id");
            const title = btn.getAttribute("data-title");
            const description = btn.getAttribute("data-description");
            const link = btn.getAttribute("data-link");
            const tags = btn.getAttribute("data-tags");

            const form = document.getElementById("project-form");
            if (form) {
                form.action = `/admin/projects/${id}`;
                document.getElementById("project-form-method").value = "PUT";
                document.getElementById("project-title").value = title;
                document.getElementById("project-description").value = description;
                document.getElementById("project-link").value = link || "";
                document.getElementById("project-tags").value = tags || "";
                document.getElementById("project-modal-title").innerText = `SYS:: EDIT PROJECT NODE: ${title.toUpperCase()}`;
                document.getElementById("project-submit-btn").innerText = "Update Node";
                openModal(projectModal);
            }
        });
    });

    // Edit Skill Button Click Handler
    document.querySelectorAll(".edit-skill-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            if (btn.getAttribute("data-demo")) {
                alert("Demo node edit action initialized. (Real database node required to save)");
                return;
            }
            const id = btn.getAttribute("data-id");
            const title = btn.getAttribute("data-title");

            const form = document.getElementById("skill-form");
            if (form) {
                form.action = `/admin/skills/${id}`;
                document.getElementById("skill-form-method").value = "PUT";
                document.getElementById("skill-title").value = title;
                document.getElementById("skill-modal-title").innerText = `SYS:: EDIT SKILL NODE: ${title.toUpperCase()}`;
                document.getElementById("skill-submit-btn").innerText = "Update Node";
                openModal(skillModal);
            }
        });
    });
});
