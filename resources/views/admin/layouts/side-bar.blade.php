<aside>
        <div class="brand-section">
            <h1 class="brand-title">&lt;Aetheria.sys /&gt;</h1>
            <div class="brand-status">
                <span class="pulse-dot"></span>
                Node active: {{ request()->server('SERVER_ADDR', '127.0.0.1') }}
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-item active" data-tab="overview">
                <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                Overview Panel
            </li>
            <li class="menu-item" data-tab="projects">
                <i data-lucide="folder-git-2" style="width:18px;height:18px;"></i>
                Manage Projects
            </li>
            <li class="menu-item" data-tab="skills">
                <i data-lucide="code-2" style="width:18px;height:18px;"></i>
                Manage Skills
            </li>
            <li class="menu-item" data-tab="inquiries">
                <i data-lucide="message-square" style="width:18px;height:18px;"></i>
                Client Messages
            </li>
            <li class="menu-item" data-tab="pages">
                <i data-lucide="file-text" style="width:18px;height:18px;"></i>
                Manage Pages
            </li>
            <li class="menu-item" data-tab="settings">
                <i data-lucide="sliders" style="width:18px;height:18px;"></i>
                System Settings
            </li>
            <li class="menu-item" data-tab="system">
                <i data-lucide="cpu" style="width:18px;height:18px;"></i>
                Node Status
            </li>
            <li class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: auto;">
                <i data-lucide="log-out" style="width:18px;height:18px;color:var(--neon-red);"></i>
                <span style="color:var(--neon-red);">Log Out</span>
            </li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>

        <div class="sidebar-footer">
            <div class="profile-avatar">
                <img src="../images/avatar.png" alt="Admin avatar image">
            </div>
            <div class="profile-info">
                <h4>Aetheria Host</h4>
                <p>Root Access Level</p>
            </div>
        </div>
    </aside>