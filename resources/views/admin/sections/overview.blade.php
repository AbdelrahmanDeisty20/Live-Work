<!-- OVERVIEW PANEL SECTION -->
<div class="dashboard-section active" id="overview">
    <!-- Top Statistics Cards -->
    <div class="stats-grid">
        <!-- Stat 1 -->
        <div class="stat-card">
            <div class="stat-header">
                <span>Unique Views</span>
                <div class="stat-icon-box"><i data-lucide="eye" style="width:16px;height:16px;"></i></div>
            </div>
            <span class="stat-val">{{ number_format($viewsCount ?? 1248) }}</span>
            <div class="stat-trend trend-up">
                <i data-lucide="arrow-up-right" style="width:14px;height:14px;"></i>
                +12.4% this week
            </div>
        </div>
        <!-- Stat 2 -->
        <div class="stat-card">
            <div class="stat-header">
                <span>Inquiries Logged</span>
                <div class="stat-icon-box"><i data-lucide="message-square-plus" style="width:16px;height:16px;"></i></div>
            </div>
            <span class="stat-val">{{ $inquiriesCount ?? 0 }}</span>
            <div class="stat-trend trend-up">
                <i data-lucide="arrow-up-right" style="width:14px;height:14px;"></i>
                +8.1% this week
            </div>
        </div>
        <!-- Stat 3 -->
        <div class="stat-card">
            <div class="stat-header">
                <span>Server Load</span>
                <div class="stat-icon-box"><i data-lucide="activity" style="width:16px;height:16px;"></i></div>
            </div>
            <span class="stat-val">1.24%</span>
            <div class="stat-trend trend-down">
                <i data-lucide="arrow-down-left" style="width:14px;height:14px;"></i>
                -0.4% stable
            </div>
        </div>
        <!-- Stat 4 -->
        <div class="stat-card">
            <div class="stat-header">
                <span>Active Deployments</span>
                <div class="stat-icon-box"><i data-lucide="check-circle-2" style="width:16px;height:16px;"></i></div>
            </div>
            <span class="stat-val">3 / 3</span>
            <div class="stat-trend trend-up">
                <i data-lucide="shield-check" style="width:14px;height:14px;"></i>
                All SSL Verified
            </div>
        </div>
    </div>

    <!-- Mid charts & logs Row -->
    <div class="visual-row">
        <!-- Interactive SVG Chart Card -->
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title-box">
                    <h3>Network Metrics</h3>
                    <p>Interactive representation of visitor patterns</p>
                </div>
                <div class="chart-toggle-buttons">
                    <button class="chart-toggle-btn active" data-type="views">Views</button>
                    <button class="chart-toggle-btn" data-type="inquiries">Inquiries</button>
                </div>
            </div>
            <div class="chart-container">
                <!-- SVG Rendered dynamically by script -->
            </div>
        </div>

        <!-- System Logs Console Box -->
        <div class="terminal-card">
            <div class="terminal-head">
                <div class="window-dots">
                    <div class="dot dot-r"></div>
                    <div class="dot dot-y"></div>
                    <div class="dot dot-g"></div>
                </div>
                <span class="terminal-title">system_events.log</span>
                <i data-lucide="refresh-cw" style="width:12px;height:12px;opacity:0.4;cursor:pointer;"></i>
            </div>
            <div class="terminal-body" id="terminal-logs">
                <!-- Simulated logs filled dynamically -->
            </div>
        </div>
    </div>

    <!-- Bottom panels: Recent inquiries & projects table -->
    <div class="data-row">
        <!-- Recent Inquiries -->
        <div class="panel-card">
            <div class="panel-header">
                <h3>Transmission Envelope Queue</h3>
                <span class="proj-badge">Secure Stream</span>
            </div>
            <div class="messages-list">
                @forelse(($contacts ?? [])->take(3) as $contact)
                    <div class="message-item">
                        <div class="message-meta">
                            <div>
                                <span class="sender-name">{{ $contact->name }}</span>
                                <span class="sender-email">{{ $contact->email }}</span>
                            </div>
                            <span class="message-time" title="{{ $contact->created_at->format('Y-m-d H:i:s') }}">
                                {{ $contact->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="message-body" style="font-weight: 700; color: var(--neon-cyan); margin-bottom: 0.25rem;">
                            Subject: {{ $contact->subject }}
                        </p>
                        <p class="message-body">{{ $contact->message }}</p>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--text-secondary); padding: 3rem; font-family: var(--font-mono);">
                        No secure transmission envelopes found.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Projects Panel Table -->
        <div class="panel-card">
            <div class="panel-header">
                <h3>Index of Active Projects</h3>
                <i data-lucide="plus-circle" style="width:18px;height:18px;color:var(--neon-cyan);cursor:pointer;" onclick="document.querySelector('[data-tab=projects]').click()"></i>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Stack</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($works ?? []) as $work)
                            <tr>
                                <td style="font-weight:700;">{{ $work->title }}</td>
                                <td>
                                    <div style="display: flex; gap: 0.25rem; flex-wrap: wrap;">
                                        @forelse($work->tecknicals as $tech)
                                            <span class="proj-badge">{{ $tech->name }}</span>
                                        @empty
                                            <span class="proj-badge" style="opacity:0.5;">No tag</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td>
                                    <span class="proj-status status-active">
                                        <span class="pulse-dot"></span>Active
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center; color:var(--text-secondary); padding:2rem;">No active project nodes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
