<!-- SYSTEM PANEL SECTION -->
<div class="dashboard-section" id="system">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Diagnostics Node Status</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Live system core statistics, memory load, and database capacity logs.</p>
            </div>
        </div>

        <div class="grid-responsive-3" style="margin-top:1.5rem;">
            <div style="border:1px solid var(--border-color); background:rgba(255,255,255,0.02); padding:1.5rem; border-radius:12px; text-align:center;">
                <i data-lucide="database" style="width:32px; height:32px; color:var(--neon-cyan); margin:0 auto 0.75rem;"></i>
                <h4 style="font-size:0.8rem; color:var(--text-secondary); text-transform:uppercase;">Work Nodes</h4>
                <span style="font-size:2rem; font-weight:800; color:var(--text-primary); font-family:var(--font-display);">{{ count($works) }}</span>
            </div>
            <div style="border:1px solid var(--border-color); background:rgba(255,255,255,0.02); padding:1.5rem; border-radius:12px; text-align:center;">
                <i data-lucide="cpu" style="width:32px; height:32px; color:var(--neon-green); margin:0 auto 0.75rem;"></i>
                <h4 style="font-size:0.8rem; color:var(--text-secondary); text-transform:uppercase;">Skill Stacks</h4>
                <span style="font-size:2rem; font-weight:800; color:var(--text-primary); font-family:var(--font-display);">{{ count($skills) }}</span>
            </div>
            <div style="border:1px solid var(--border-color); background:rgba(255,255,255,0.02); padding:1.5rem; border-radius:12px; text-align:center;">
                <i data-lucide="mail" style="width:32px; height:32px; color:var(--neon-purple); margin:0 auto 0.75rem;"></i>
                <h4 style="font-size:0.8rem; color:var(--text-secondary); text-transform:uppercase;">Decrypted Logs</h4>
                <span style="font-size:2rem; font-weight:800; color:var(--text-primary); font-family:var(--font-display);">{{ count($contacts) }}</span>
            </div>
        </div>
    </div>
</div>
