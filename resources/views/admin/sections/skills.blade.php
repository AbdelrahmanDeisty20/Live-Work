<!-- SKILLS PANEL SECTION -->
<div class="dashboard-section" id="skills">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Skill Editor Console</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Configure core technical proficiency stacks.</p>
            </div>
            <button class="btn-submit-cyber" id="open-skill-modal" style="width:auto; padding:0.6rem 1.2rem; font-size:0.85rem;">
                <i data-lucide="plus" style="width:16px;height:16px;"></i> Add New Skill
            </button>
        </div>

        <div class="table-wrapper" style="max-height:none; margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Skill Name</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($skills)
                        @forelse($skills as $skill)
                            <tr>
                                <td style="font-weight:700; color:var(--neon-cyan);">{{ $skill->name }}</td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex; gap:0.5rem;">
                                        <button class="action-btn-edit edit-skill-btn" 
                                                data-id="{{ $skill->id }}"
                                                data-name="{{ $skill->name }}" 
                                                title="Edit Skill Name" style="background:none; border:none; color:var(--neon-cyan); cursor:pointer;"><i data-lucide="edit-3" style="width:16px;height:16px;"></i></button>

                                        <button class="action-btn-delete delete-skill-btn" 
                                                data-id="{{ $skill->id }}" 
                                                data-name="{{ $skill->name }}"
                                                title="Decommission skill" style="background:none; border:none; color:var(--neon-red); cursor:pointer;"><i data-lucide="trash-2" style="width:16px;height:16px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align:center; color:var(--text-secondary); padding:2rem;">No skills configured. Click "Add New Skill" to initialize.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="2" style="text-align:center; color:var(--text-secondary); padding:2rem;">No skills configured.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Skill Management Modal -->
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
                        <label for="skill-name">Skill Name</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="skill-name" name="name" class="input-cyber" placeholder="e.g. PHP" required>
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

@push('extra-scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const skillModal = document.getElementById("skill-modal");
        const openSkillBtn = document.getElementById("open-skill-modal");
        const skillCloseButtons = skillModal ? skillModal.querySelectorAll(".close-modal") : [];

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
                const name = btn.getAttribute("data-name");

                const form = document.getElementById("skill-form");
                if (form) {
                    form.action = "{{ url('admin/skills') }}/" + id;
                    document.getElementById("skill-form-method").value = "PUT";
                    document.getElementById("skill-id").value = id;
                    document.getElementById("skill-name").value = name;
                    document.getElementById("skill-modal-title").innerText = `SYS:: EDIT SKILL NODE: ${name.toUpperCase()}`;
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
    });

    $(document).ready(function () {
        // Skill Form Validate and Submit via AJAX
        $('#skill-form').validate({
            rules: {
                name: { required: true }
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
                                timer: 1500
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
                                confirmButtonText: 'Retry'
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
                            confirmButtonText: 'Acknowledge'
                        });
                        $submitBtn.prop('disabled', false).text(oldText);
                    }
                });
            }
        });

        // Delete Skill via AJAX
        $(document).on('click', '.delete-skill-btn', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const name = $(this).attr('data-name');
            
            Swal.fire({
                title: 'DECOMMISSION NODE?',
                text: `Are you sure you want to delete skill "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                background: '#0a0b1e',
                color: '#e2e8f0',
                confirmButtonText: 'Yes, Decommission',
                cancelButtonText: 'Abort'
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
                                text: 'SYS:: Skill deleted successfully.',
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
    });
</script>
@endpush
