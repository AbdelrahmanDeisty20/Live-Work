<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Node Not Found</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;700&family=Outfit:wght@800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --bg-dark: #060713;
            --text-primary: #e2e8f0;
            --text-secondary: #94a3b8;
            --neon-cyan: #00f2fe;
            --neon-purple: #a855f7;
            --border-color: rgba(0, 242, 254, 0.15);
            --font-mono: 'Fira Code', monospace;
            --font-display: 'Outfit', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            font-family: var(--font-mono);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            padding: 2rem;
        }

        /* Background grid overlay */
        .cyber-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background-image: 
                linear-gradient(rgba(0, 242, 254, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 242, 254, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .glow-orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.05) 0%, rgba(0,0,0,0) 70%);
            filter: blur(50px);
            pointer-events: none;
            z-index: 1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .error-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 600px;
            background: rgba(10, 11, 30, 0.75);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .terminal-header {
            background: rgba(6, 7, 19, 0.95);
            padding: 0.75rem 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .window-dots {
            display: flex;
            gap: 0.4rem;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-red { background: #ef4444; }
        .dot-yellow { background: #eab308; }
        .dot-green { background: #22c55e; }

        .terminal-title {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
        }

        .error-body {
            padding: 3rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .glitch-code {
            font-family: var(--font-display);
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(0, 242, 254, 0.2);
            margin-bottom: 0.5rem;
            animation: pulse 2s infinite alternate;
        }

        .error-title {
            color: var(--neon-cyan);
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .error-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 420px;
        }

        .btn-neon-cyber {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            color: #060713;
            font-weight: 700;
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(0, 242, 254, 0.25);
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-neon-cyber:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 242, 254, 0.45);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.05); }
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .glitch-code {
                font-size: 5rem;
            }
            .error-title {
                font-size: 1rem;
            }
            .error-body {
                padding: 2rem 1.2rem;
            }
            .error-desc {
                font-size: 0.82rem;
            }
        }
    </style>
</head>
<body>

    <div class="cyber-overlay"></div>
    <div class="glow-orb"></div>

    <div class="error-container">
        <div class="terminal-header">
            <div class="window-dots">
                <div class="dot dot-red"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
            </div>
            <span class="terminal-title">SYS::ROUTE_EXCEPTION</span>
            <span style="opacity:0.25;"><i data-lucide="alert-triangle" style="width:14px;height:14px;color:#ef4444;"></i></span>
        </div>
        <div class="error-body">
            <div class="glitch-code">404</div>
            <h1 class="error-title">Illegal Route Detected</h1>
            <p class="error-desc">The requested transmission path does not exist on this node. It may have been decommissioned or moved to a different sector.</p>
            <a href="/" class="btn-neon-cyber">
                Return to Secure Session
                <i data-lucide="terminal" style="width:16px;height:16px;"></i>
            </a>
        </div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>
