<!-- SKILLS PANEL SECTION -->
<div class="dashboard-section" id="skills">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Skill Editor Console</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Configure core technical proficiency stacks and categories.</p>
            </div>
            <button class="btn-submit-cyber" id="open-skill-modal" style="width:auto; padding:0.6rem 1.2rem; font-size:0.85rem;">
                <i data-lucide="plus" style="width:16px;height:16px;"></i> Add New Skill Category
            </button>
        </div>

        <div class="table-wrapper" style="max-height:none; margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Skill Category</th>
                        <th>Stack Elements Count</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($skills)
                        @forelse($skills as $skill)
                            <tr>
                                <td style="font-weight:700; color:var(--neon-cyan);">{{ $skill->title }}</td>
                                <td>
                                    <span style="font-size:0.75rem; padding:0.1rem 0.4rem; background:rgba(168, 85, 247, 0.1); border:1px solid rgba(168, 85, 247, 0.2); border-radius:3px; color:var(--neon-purple); font-family:var(--font-mono);">
                                        {{ count($skill->contents) }} elements
                                    </span>
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex; gap:0.5rem;">
                                        <button class="btn-submit-cyber manage-contents-btn" 
                                                data-id="{{ $skill->id }}"
                                                data-title="{{ $skill->title }}"
                                                style="width:auto; padding:0.4rem 0.8rem; font-size:0.75rem; background:rgba(0,242,254,0.05); border:1px solid var(--neon-cyan); color:var(--neon-cyan); box-shadow:none;">
                                            <i data-lucide="settings-2" style="width:12px;height:12px;"></i> Manage Items
                                        </button>

                                        <button class="action-btn-edit edit-skill-btn" 
                                                data-id="{{ $skill->id }}"
                                                data-title="{{ $skill->title }}" 
                                                title="Edit Category Name" style="background:none; border:none; color:var(--neon-cyan); cursor:pointer;"><i data-lucide="edit-3" style="width:16px;height:16px;"></i></button>

                                        <button class="action-btn-delete delete-skill-btn" 
                                                data-id="{{ $skill->id }}" 
                                                data-title="{{ $skill->title }}"
                                                title="Decommission node" style="background:none; border:none; color:var(--neon-red); cursor:pointer;"><i data-lucide="trash-2" style="width:16px;height:16px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center; color:var(--text-secondary); padding:2rem;">No skill categories configured. Click "Add New Skill Category" to initialize.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="3" style="text-align:center; color:var(--text-secondary); padding:2rem;">No skill categories configured.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Skill Category Management Modal -->
<div class="cyber-modal" id="skill-modal">
    <div class="login-card" style="max-width:440px; width:100%;">
        <div class="terminal-header">
            <div class="window-dots">
                <div class="dot dot-red close-modal"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
            </div>
            <span class="terminal-title" id="skill-modal-title">SYS:: REGISTER NEW SKILL NODE</span>
            <span class="close-modal" style="cursor:pointer;"><i data-lucide="x" style="width:14px;height:14px;color:var(--neon-cyan);"></i></span>
        </div>
        <div class="login-card-body" style="padding:2rem;">
            <form id="skill-form" method="POST" action="{{ url('admin/skills') }}">
                @csrf
                <input type="hidden" name="_method" id="skill-form-method" value="POST">
                <input type="hidden" name="id" id="skill-id">

                <div style="display:flex; flex-direction:column; gap:1.2rem;">
                    <div class="form-group-cyber">
                        <label for="skill-title">Skill Category Title</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="skill-title" name="title" class="input-cyber" placeholder="e.g. Backend Infrastructure" required>
                        </div>
                    </div>

                    <div style="display:flex; gap:1rem; margin-top:0.5rem;">
                        <button type="button" class="btn-submit-cyber close-modal" style="background:rgba(255,255,255,0.05); border:1px solid var(--border-color); color:var(--text-primary); box-shadow:none;">Abort Operation</button>
                        <button type="submit" class="btn-submit-cyber" id="skill-submit-btn">Commit Node</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Skill Contents Management Modal -->
<div class="cyber-modal" id="manage-contents-modal">
    <div class="login-card" style="max-width:750px; width:100%;">
        <div class="terminal-header">
            <div class="window-dots">
                <div class="dot dot-red close-modal"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
            </div>
            <span class="terminal-title" id="manage-contents-modal-title">SYS:: MANAGE SKILL PROFICIENCIES</span>
            <span class="close-modal" style="cursor:pointer;"><i data-lucide="x" style="width:14px;height:14px;color:var(--neon-cyan);"></i></span>
        </div>
        <div class="login-card-body" style="padding:2rem;">
            <input type="hidden" id="manage-skill-id" value="">
            
            <div class="grid-modal-responsive">
                <!-- Left: List of current items -->
                <div style="border-right:1px solid var(--border-color); padding-right:1.5rem;">
                    <h4 style="font-family:var(--font-mono); color:var(--neon-cyan); margin-bottom:1rem; font-size:0.9rem; border-bottom:1px solid var(--border-color); padding-bottom:0.5rem; letter-spacing:1px;">ACTIVE STACK NODES</h4>
                    <div id="contents-list-container" style="max-height:320px; overflow-y:auto; display:flex; flex-direction:column; gap:0.5rem; padding-right:0.5rem;">
                        <!-- Dynamic items will be rendered here -->
                    </div>
                </div>

                <!-- Right: Add/Edit Form -->
                <div>
                    <h4 id="content-form-heading" style="font-family:var(--font-mono); color:var(--neon-purple); margin-bottom:1rem; font-size:0.9rem; border-bottom:1px solid var(--border-color); padding-bottom:0.5rem; letter-spacing:1px;">INITIALIZE NEW ITEM</h4>
                    <form id="content-form">
                        @csrf
                        <input type="hidden" id="content-id" value="">
                        
                        <div style="display:flex; flex-direction:column; gap:1rem;">
                            <div class="form-group-cyber">
                                <label for="content-title">Proficiency Name</label>
                                <div class="input-cyber-wrapper">
                                    <input type="text" id="content-title" name="title" class="input-cyber" placeholder="e.g. PHP 8 / Laravel 11" required>
                                </div>
                            </div>

                            <div class="form-group-cyber">
                                <label for="content-percentage">Progress Percentage (0-100)</label>
                                <div class="input-cyber-wrapper">
                                    <input type="number" id="content-percentage" name="percentage" class="input-cyber" min="0" max="100" placeholder="e.g. 95" required>
                                </div>
                            </div>
                            <div style="display:flex; gap:0.5rem; margin-top:0.5rem;">
                                <button type="button" id="reset-content-form-btn" class="btn-submit-cyber" style="background:rgba(255,255,255,0.05); border:1px solid var(--border-color); color:var(--text-primary); box-shadow:none; display:none;">Cancel</button>
                                <button type="submit" id="content-submit-btn" class="btn-submit-cyber">Commit Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extra-scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const skillModal = document.getElementById("skill-modal");
        const openSkillBtn = document.getElementById("open-skill-modal");
        const skillCloseButtons = skillModal ? skillModal.querySelectorAll(".close-modal") : [];

        const manageModal = document.getElementById("manage-contents-modal");
        const manageCloseButtons = manageModal ? manageModal.querySelectorAll(".close-modal") : [];

        function openModal(modal) {
            if (modal) modal.classList.add("active");
        }

        function closeModal(modal) {
            if (modal) modal.classList.remove("active");
        }

        if (openSkillBtn) {
            openSkillBtn.addEventListener("click", () => {
                const form = document.getElementById("skill-form");
                if (form) {
                    form.reset();
                    form.action = "{{ url('admin/skills') }}";
                    document.getElementById("skill-form-method").value = "POST";
                    document.getElementById("skill-id").value = "";
                    document.getElementById("skill-modal-title").innerText = "SYS:: REGISTER NEW SKILL NODE";
                    document.getElementById("skill-submit-btn").innerText = "Commit Node";
                }
                openModal(skillModal);
            });
        }

        document.querySelectorAll(".edit-skill-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                const title = btn.getAttribute("data-title");

                const form = document.getElementById("skill-form");
                if (form) {
                    form.action = "{{ url('admin/skills') }}/" + id;
                    document.getElementById("skill-form-method").value = "PUT";
                    document.getElementById("skill-id").value = id;
                    document.getElementById("skill-title").value = title;
                    document.getElementById("skill-modal-title").innerText = `SYS:: EDIT SKILL NODE: ${title.toUpperCase()}`;
                    document.getElementById("skill-submit-btn").innerText = "Update Node";
                }
                openModal(skillModal);
            });
        });

        skillCloseButtons.forEach(btn => {
            btn.addEventListener("click", () => closeModal(skillModal));
        });

        if (skillModal) {
            skillModal.addEventListener("click", (e) => {
                if (e.target === skillModal) closeModal(skillModal);
            });
        }

        manageCloseButtons.forEach(btn => {
            btn.addEventListener("click", () => closeModal(manageModal));
        });

        if (manageModal) {
            manageModal.addEventListener("click", (e) => {
                if (e.target === manageModal) closeModal(manageModal);
            });
        }

        // Manage Contents Button Click
        document.querySelectorAll(".manage-contents-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const skillId = btn.getAttribute("data-id");
                const skillTitle = btn.getAttribute("data-title");
                
                document.getElementById("manage-skill-id").value = skillId;
                document.getElementById("manage-contents-modal-title").innerText = `SYS:: MANAGE PROFICIENCIES FOR: ${skillTitle.toUpperCase()}`;
                
                resetContentForm();
                loadSkillContents(skillId);
                openModal(manageModal);
            });
        });
    });

    // Load Skill Contents via AJAX
    function loadSkillContents(skillId) {
        const container = $('#contents-list-container');
        container.html('<div style="text-align:center; color:var(--text-secondary); padding:2rem; font-family:var(--font-mono);">SYNCING STREAM...</div>');
        
        $.ajax({
            url: `{{ url('admin/skills') }}/${skillId}/contents`,
            type: 'GET',
            success: function (response) {
                container.empty();
                if (response.status === 'success' && response.data && response.data.length > 0) {
                    response.data.forEach(item => {
                        // Safe attributes to prevent syntax errors with quotes
                        const safeTitle = $('<div>').text(item.title).html();
                        
                        container.append(`
                            <div class="content-item-row" style="display:flex; justify-content:space-between; align-items:center; padding:0.6rem 0.8rem; background:rgba(255,255,255,0.02); border:1px solid var(--border-color); border-radius:6px; margin-bottom:0.4rem; transition:border-color 0.2s ease;">
                                <div style="flex-grow:1; min-width:0; padding-right:1rem;">
                                    <div style="font-weight:bold; color:var(--text-primary); font-size:0.85rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${safeTitle}</div>
                                    <div style="font-size:0.75rem; color:var(--text-secondary); font-family:var(--font-mono); margin-top:0.2rem;">Proficiency: ${item.percentage}%</div>
                                </div>
                                <div style="display:flex; gap:0.25rem;">
                                    <button class="action-btn-edit edit-subskill-btn" 
                                            data-id="${item.id}"
                                            data-title="${safeTitle}"
                                            data-percentage="${item.percentage}"
                                            style="background:none; border:none; color:var(--neon-cyan); cursor:pointer; padding:4px;"><i data-lucide="edit-3" style="width:14px;height:14px;"></i></button>
                                    <button class="action-btn-delete delete-subskill-btn" 
                                            data-id="${item.id}"
                                            style="background:none; border:none; color:var(--neon-red); cursor:pointer; padding:4px;"><i data-lucide="trash-2" style="width:14px;height:14px;"></i></button>
                                </div>
                            </div>
                        `);
                    });
                    if (window.lucide) { lucide.createIcons(); }
                } else {
                    container.html('<div style="text-align:center; color:var(--text-secondary); padding:2rem; font-family:var(--font-mono);">No active nodes found. Initialise one on the right.</div>');
                }
            },
            error: function () {
                container.html('<div style="text-align:center; color:var(--neon-red); padding:2rem; font-family:var(--font-mono);">SYNC ERROR: STREAM CORRUPTED</div>');
            }
        });
    }

    // Event Delegation for Subskill Actions
    $(document).on('click', '.edit-subskill-btn', function() {
        const id = $(this).attr('data-id');
        const title = $(this).attr('data-title');
        const percentage = $(this).attr('data-percentage');
        editContent(id, title, percentage);
    });

    $(document).on('click', '.delete-subskill-btn', function() {
        const id = $(this).attr('data-id');
        deleteContent(id);
    });

    // Reset Content Form
    function resetContentForm() {
        $('#content-id').val('');
        $('#content-title').val('');
        $('#content-percentage').val('');
        $('#content-form-heading').text('INITIALIZE NEW ITEM').css('color', 'var(--neon-purple)');
        $('#content-submit-btn').text('Commit Item');
        $('#reset-content-form-btn').hide();
    }

    // Edit Subskill Item
    function editContent(id, title, percentage) {
        $('#content-id').val(id);
        $('#content-title').val(title);
        $('#content-percentage').val(percentage);
        $('#content-form-heading').text('EDIT STACK ITEM').css('color', 'var(--neon-cyan)');
        $('#content-submit-btn').text('Update Item');
        $('#reset-content-form-btn').show();
    }

    // Delete Subskill Item via AJAX
    function deleteContent(id) {
        Swal.fire({
            title: 'DELETE ITEM?',
            text: 'Are you sure you want to delete this proficiency item?',
            icon: 'warning',
            showCancelButton: true,
            background: '#0a0b1e',
            color: '#e2e8f0',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Abort',
            customClass: {
                popup: 'cyber-swal-popup',
                title: 'cyber-swal-title',
                htmlContainer: 'cyber-swal-content',
                confirmButton: 'cyber-swal-confirm',
                cancelButton: 'cyber-swal-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const skillId = $('#manage-skill-id').val();
                $.ajax({
                    url: `{{ url('admin/skills/contents') }}/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'ITEM DELETED',
                                text: 'SYS:: Item deleted successfully.',
                                icon: 'success',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            loadSkillContents(skillId);
                        } else {
                            Swal.fire({
                                title: 'OPERATION FAILED',
                                text: 'SYS:: ' + (response.message || 'Operation failed'),
                                icon: 'error',
                                background: '#0a0b1e',
                                color: '#e2e8f0'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'TRANSMISSION ERROR',
                            text: 'SYS:: Connection interrupted.',
                            icon: 'error',
                            background: '#0a0b1e',
                            color: '#e2e8f0'
                        });
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        // Reset subskill form button
        $('#reset-content-form-btn').on('click', function() {
            resetContentForm();
        });

        // Submit Subskill Form (Add/Edit) via AJAX
        $('#content-form').validate({
            rules: {
                title: { required: true },
                percentage: { required: true, min: 0, max: 100 }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.css({ color: "#ef4444", fontSize: "0.7rem", marginTop: "2px", display: "block", fontFamily: "var(--font-mono)" });
                element.closest(".form-group-cyber").append(error);
            },
            submitHandler: function(form) {
                const skillId = $('#manage-skill-id').val();
                const contentId = $('#content-id').val();
                const isEdit = contentId && contentId !== '';
                
                const ajaxUrl = isEdit 
                    ? `{{ url('admin/skills/contents') }}/${contentId}`
                    : `{{ route('admin.skills.contents.store') }}`;
                
                const data = {
                    title: $('#content-title').val(),
                    value: $('#content-percentage').val(),
                    percentage: $('#content-percentage').val(),
                    skill_id: skillId
                };

                if (isEdit) {
                    data._method = 'PUT';
                }

                const $btn = $('#content-submit-btn');
                const oldText = $btn.text();
                $btn.prop('disabled', true).text('COMMITTING...');

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $btn.prop('disabled', false).text(oldText);
                        if (response.status === 'success') {
                            Swal.fire({
                                title: isEdit ? 'ITEM UPDATED' : 'ITEM CREATED',
                                text: 'SYS:: ' + response.message,
                                icon: 'success',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                showConfirmButton: false,
                                timer: 1200
                            });
                            resetContentForm();
                            loadSkillContents(skillId);
                        } else {
                            Swal.fire({
                                title: 'OPERATION FAILED',
                                text: 'SYS:: ' + (response.message || 'Operation failed'),
                                icon: 'error',
                                background: '#0a0b1e',
                                color: '#e2e8f0'
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).text(oldText);
                        var errorMsg = 'An error occurred.';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).map(function(e) { return e.join(', '); }).join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'TRANSMISSION ERROR',
                            text: 'SYS:: ' + errorMsg,
                            icon: 'warning',
                            background: '#0a0b1e',
                            color: '#e2e8f0'
                        });
                    }
                });
            }
        });

        // Skill Category Form Validate and Submit (Standard or AJAX)
        $('#skill-form').validate({
            rules: {
                title: { required: true }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.css({ color: "#ef4444", fontSize: "0.75rem", marginTop: "5px", display: "block", fontFamily: "var(--font-mono)" });
                element.closest(".form-group-cyber").append(error);
            },
            submitHandler: function (form) {
                var $form = $(form);
                var $submitBtn = $('#skill-submit-btn');
                var oldText = $submitBtn.text();
                
                $submitBtn.prop('disabled', true).text('PROCESSING...');

                var url = $form.attr('action');
                var formData = $form.serialize();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'NODE COMMITTED',
                                text: 'SYS:: ' + response.message,
                                icon: 'success',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: {
                                    popup: 'cyber-swal-popup',
                                    title: 'cyber-swal-title',
                                    htmlContainer: 'cyber-swal-content'
                                }
                            });

                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                title: 'OPERATION FAILED',
                                text: 'SYS:: ' + (response.message || 'Unknown error occurred'),
                                icon: 'error',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                confirmButtonText: 'Retry',
                                customClass: {
                                    popup: 'cyber-swal-popup',
                                    title: 'cyber-swal-title',
                                    htmlContainer: 'cyber-swal-content',
                                    confirmButton: 'cyber-swal-confirm'
                                }
                            });
                            $submitBtn.prop('disabled', false).text(oldText);
                        }
                    },
                    error: function (xhr) {
                        var errorMsg = 'An error occurred while updating the skill node.';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            errorMsg = Object.values(errors).map(function(e) { return e.join(', '); }).join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'TRANSMISSION ERROR',
                            text: 'SYS:: ' + errorMsg,
                            icon: 'warning',
                            background: '#0a0b1e',
                            color: '#e2e8f0',
                            confirmButtonText: 'Acknowledge',
                            customClass: {
                                popup: 'cyber-swal-popup',
                                title: 'cyber-swal-title',
                                htmlContainer: 'cyber-swal-content',
                                confirmButton: 'cyber-swal-confirm'
                            }
                        });
                        $submitBtn.prop('disabled', false).text(oldText);
                    }
                });
            }
        });

        // Delete Skill Category via AJAX
        $(document).on('click', '.delete-skill-btn', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const title = $(this).attr('data-title');
            
            Swal.fire({
                title: 'DECOMMISSION NODE?',
                text: `Are you sure you want to delete skill category "${title}" and all its proficiencies?`,
                icon: 'warning',
                showCancelButton: true,
                background: '#0a0b1e',
                color: '#e2e8f0',
                confirmButtonText: 'Yes, Decommission',
                cancelButtonText: 'Abort',
                customClass: {
                    popup: 'cyber-swal-popup',
                    title: 'cyber-swal-title',
                    htmlContainer: 'cyber-swal-content',
                    confirmButton: 'cyber-swal-confirm',
                    cancelButton: 'cyber-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('admin/skills') }}/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'NODE DECOMMISSIONED',
                                text: 'SYS:: Category deleted successfully.',
                                icon: 'success',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'TRANSMISSION ERROR',
                                text: 'SYS:: Operation failed.',
                                icon: 'error',
                                background: '#0a0b1e',
                                color: '#e2e8f0'
                            });
                        }
                    });
                }
            });
        });

        // Trigger page refresh on closing subskills modal so that categories counts update in layout
        $('#manage-contents-modal').on('click', '.close-modal', function() {
            window.location.reload();
        });
    });
</script>
@endpush
