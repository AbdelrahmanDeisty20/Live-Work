<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aetheria System Dashboard - Secure Terminal Login.">
    <title>Aetheria | Secure Node Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg-dark: #060713;
            --bg-card: rgba(10, 11, 30, 0.85);
            --border-color: rgba(0, 242, 254, 0.2);
            --border-glow: rgba(0, 242, 254, 0.4);
            --text-primary: #e2e8f0;
            --text-secondary: #94a3b8;
            --text-muted: #475569;
            --neon-cyan: #00f2fe;
            --neon-blue: #4facfe;
            --neon-purple: #a855f7;
            --grad-neon: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            --grad-text: linear-gradient(90deg, #00f2fe, #4facfe, #a855f7);
            --font-mono: 'Fira Code', 'Courier New', Courier, monospace;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            font-family: var(--font-sans);
            overflow: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-bg {
            position: fixed;
            inset: 0;
            z-index: -3;
            pointer-events: none;
            overflow: hidden;
        }

        .glow-orb {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 242, 254, 0.08) 0%, rgba(0,0,0,0) 70%);
            filter: blur(80px);
            pointer-events: none;
        }
        .orb-left { top: -10%; left: -10%; }
        .orb-right { bottom: -10%; right: -10%; background: radial-gradient(circle, rgba(168, 85, 247, 0.08) 0%, rgba(0,0,0,0) 70%); }

        .grid-lines {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(0, 242, 254, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 242, 254, 0.02) 1px, transparent 1px);
            background-size: 35px 35px;
            pointer-events: none;
        }

        #login-canvas {
            position: absolute;
            inset: 0;
            z-index: -2;
            opacity: 0.25;
        }

        .login-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            z-index: 10;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5), 0 0 40px rgba(0,242,254,0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-card:hover {
            border-color: var(--neon-cyan);
            box-shadow: 0 30px 70px rgba(0,242,254,0.12);
        }

        .terminal-header {
            background: rgba(6, 7, 19, 0.9);
            padding: 0.75rem 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .window-dots { display: flex; gap: 0.4rem; }

        .dot { width: 9px; height: 9px; border-radius: 50%; }
        .dot-red    { background: #ef4444; }
        .dot-yellow { background: #eab308; }
        .dot-green  { background: #22c55e; }

        .terminal-title {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .login-card-body {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .login-intro {
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .login-intro h2 {
            font-size: 1.8rem;
            font-family: var(--font-display);
            font-weight: 800;
        }

        .login-intro p {
            font-size: 0.82rem;
            color: var(--text-secondary);
            font-family: var(--font-mono);
        }

        .ssh-pre {
            background: rgba(4, 5, 13, 0.9);
            border: 1px solid rgba(0, 242, 254, 0.15);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            font-family: var(--font-mono);
            font-size: 0.72rem;
            color: var(--text-secondary);
            line-height: 1.5;
            text-align: left;
        }

        .ssh-pre span.cyan { color: var(--neon-cyan); }

        .form-group-cyber { display: flex; flex-direction: column; gap: 0.5rem; }

        .form-group-cyber label {
            font-family: var(--font-mono);
            font-size: 0.72rem;
            color: var(--text-secondary);
            text-transform: uppercase;
        }

        .input-cyber-wrapper { position: relative; width: 100%; }

        .input-cyber {
            width: 100%;
            background: rgba(6, 7, 19, 0.8) !important;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.85rem 1.2rem;
            font-size: 0.9rem;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
            font-family: var(--font-mono);
            outline: none;
        }

        .input-cyber:focus {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 15px rgba(0,242,254,0.2);
            background: rgba(0,242,254,0.02) !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            border: 1px solid var(--neon-cyan) !important;
            -webkit-text-fill-color: var(--text-primary) !important;
            -webkit-box-shadow: 0 0 0px 1000px #060713 inset !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            font-family: var(--font-mono);
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        .remember-me input { accent-color: var(--neon-cyan); cursor: pointer; }

        .bypass-link {
            color: var(--neon-cyan);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .bypass-link:hover { color: var(--neon-purple); }

        .status-terminal {
            font-family: var(--font-mono);
            font-size: 0.72rem;
            color: var(--neon-purple);
            text-align: center;
            min-height: 16px;
        }

        .btn-submit-cyber {
            width: 100%;
            background: var(--grad-neon);
            color: var(--bg-dark);
            padding: 0.9rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 0 20px rgba(0,242,254,0.2);
            transition: all 0.3s ease;
            border: none;
            outline: none;
        }

        .btn-submit-cyber:hover {
            box-shadow: 0 0 30px rgba(0,242,254,0.4);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Cyber Background Layer -->
    <div class="dashboard-bg">
        <canvas id="login-canvas"></canvas>
        <div class="glow-orb orb-left"></div>
        <div class="glow-orb orb-right"></div>
        <div class="grid-lines"></div>
    </div>

    @yield('content')

    <script>
        lucide.createIcons();

        // Matrix falling animation
        const canvas = document.getElementById("login-canvas");
        const ctx = canvas.getContext("2d");

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener("resize", resize);

        const columns = Math.floor(canvas.width / 20);
        const yPositions = Array(columns).fill(0);

        function drawMatrix() {
            ctx.fillStyle = "rgba(6, 7, 19, 0.05)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(0, 242, 254, 0.15)";
            ctx.font = "14px monospace";

            yPositions.forEach((y, index) => {
                const char = String.fromCharCode(33 + Math.random() * 93);
                const x = index * 20;
                ctx.fillText(char, x, y);
                if (y > 100 + Math.random() * 10000) {
                    yPositions[index] = 0;
                } else {
                    yPositions[index] = y + 20;
                }
            });
        }
        setInterval(drawMatrix, 40);

        // Submit Authorization Sequence
        const authForm = document.getElementById("auth-form");
        const statusTerminal = document.getElementById("status-terminal");

        if (authForm) {
            authForm.addEventListener("submit", (e) => {
                e.preventDefault();
                const submitBtn = authForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = `NEGOTIATING HANDSHAKE...`;
                submitBtn.disabled = true;

                setTimeout(() => {
                    statusTerminal.innerText = "SYS:: PARSING CERTIFICATE AUTHORIZATION...";
                    setTimeout(() => {
                        statusTerminal.innerText = "SYS:: SESSION VERIFIED. AUTHORIZING ACCESS...";
                        statusTerminal.style.color = "#10b981";
                        submitBtn.innerHTML = `ACCESS GRANTED`;
                        submitBtn.style.background = "#10b981";
                        setTimeout(() => {
                            window.location.href = "/admin";
                        }, 800);
                    }, 1000);
                }, 800);
            });
        }
    </script>
</body>
</html>
