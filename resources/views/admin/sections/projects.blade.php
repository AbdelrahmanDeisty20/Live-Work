<!-- PROJECTS PANEL SECTION -->
<div class="dashboard-section" id="projects">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Project Editor Console</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Manage active portfolio works, tags, and production deployment links.</p>
            </div>
            <button class="btn-submit-cyber" id="open-project-modal" style="width:auto; padding:0.6rem 1.2rem; font-size:0.85rem;">
                <i data-lucide="plus" style="width:16px;height:16px;"></i> Add New Project
            </button>
        </div>

        <div class="table-wrapper" style="max-height:none; margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Project Title</th>
                        <th>Description</th>
                        <th>Production Link</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($works)
                        @forelse($works as $work)
                            <tr>
                                <td>
                                    <div style="width:60px; height:40px; border-radius:4px; overflow:hidden; border:1px solid var(--border-color); background:rgba(255,255,255,0.05); display:flex; align-items:center; justify-content:center;">
                                        @if($work->image)
                                            <img src="{{ secure_asset('storage/' . $work->image) }}" alt="{{ $work->title }}" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <i data-lucide="image" style="width:16px; height:16px; color:var(--text-muted);"></i>
                                        @endif
                                    </div>
                                </td>
                                <td style="font-weight:700; color:var(--neon-cyan);">
                                    {{ $work->title }}
                                    <div style="display:flex; flex-wrap:wrap; gap:0.25rem; margin-top:0.25rem;">
                                        @foreach($work->tecknicals as $tech)
                                            <span style="font-size:0.65rem; padding:0.1rem 0.3rem; background:rgba(168, 85, 247, 0.1); border:1px solid rgba(168, 85, 247, 0.2); border-radius:3px; color:var(--neon-purple); font-family:var(--font-mono);">{{ $tech->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td style="max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--text-secondary);">
                                    {{ $work->description }}
                                </td>
                                <td>
                                    @if($work->link)
                                        <a href="{{ $work->link }}" target="_blank" style="color:var(--neon-purple); text-decoration:none; font-family:var(--font-mono); font-size:0.8rem;">{{ parse_url($work->link, PHP_URL_HOST) }}</a>
                                    @else
                                        <span style="color:var(--text-muted);">No Link</span>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex; gap:0.5rem;">
                                        <button class="action-btn-edit edit-project-btn" 
                                                data-id="{{ $work->id }}"
                                                data-title="{{ $work->title }}" 
                                                data-description="{{ $work->description }}"
                                                data-link="{{ $work->link }}"
                                                data-tags="{{ $work->tecknicals->pluck('name')->implode(', ') }}"
                                                title="Edit node" style="background:none; border:none; color:var(--neon-cyan); cursor:pointer;"><i data-lucide="edit-3" style="width:16px;height:16px;"></i></button>

                                        <button class="action-btn-delete delete-project-btn" 
                                                data-id="{{ $work->id }}" 
                                                data-title="{{ $work->title }}"
                                                title="Decommission node" style="background:none; border:none; color:var(--neon-red); cursor:pointer;"><i data-lucide="trash-2" style="width:16px;height:16px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center; color:var(--text-secondary); padding:2rem;">No project nodes configured. Click "Add New Project" to initialize.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5" style="text-align:center; color:var(--text-secondary); padding:2rem;">No project nodes configured.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Project Management Modal -->
<div class="cyber-modal" id="project-modal">
    <div class="login-card" style="max-width:550px; width:100%;">
        <div class="terminal-header">
            <div class="window-dots">
                <div class="dot dot-red close-modal"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
            </div>
            <span class="terminal-title" id="project-modal-title">SYS:: INITIALIZE NEW PROJECT NODE</span>
            <span class="close-modal" style="cursor:pointer;"><i data-lucide="x" style="width:14px;height:14px;color:var(--neon-cyan);"></i></span>
        </div>
        <div class="login-card-body" style="padding:2rem;">
            <form id="project-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_method" id="project-form-method" value="POST">
                <input type="hidden" name="id" id="project-work-id" value="">

                <div style="display:flex; flex-direction:column; gap:1.2rem;">
                    <div class="form-group-cyber">
                        <label for="project-title">Project Title</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="project-title" name="title" class="input-cyber" placeholder="e.g. Nexus Dashboard" required>
                        </div>
                    </div>

                    <div class="form-group-cyber">
                        <label for="project-description">Project Description</label>
                        <div class="input-cyber-wrapper">
                            <textarea id="project-description" name="description" class="input-cyber" rows="3" placeholder="Enter system node specifications..." style="resize:none; height:auto;" required></textarea>
                        </div>
                    </div>

                    <div class="form-group-cyber">
                        <label for="project-link">Production / Deployment Link</label>
                        <div class="input-cyber-wrapper">
                            <input type="url" id="project-link" name="link" class="input-cyber" placeholder="https://nexus.example.com" required>
                        </div>
                    </div>

                    <div class="form-group-cyber">
                        <label for="project-tags">Technical Tags (comma separated)</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="project-tags" name="tags" class="input-cyber" placeholder="e.g. PHP, Laravel, Tailwind, React" required>
                        </div>
                    </div>

                    <div class="form-group-cyber">
                        <label for="project-image">Node Thumbnail Asset</label>
                        <div class="input-cyber-wrapper" style="border:1px dashed var(--border-color); padding:1rem; border-radius:8px; display:flex; flex-direction:column; align-items:center; gap:0.5rem; background:rgba(0,0,0,0.2); position:relative;">
                            <i data-lucide="upload-cloud" style="width:24px; height:24px; color:var(--text-secondary);"></i>
                            <span style="font-size:0.75rem; color:var(--text-secondary); font-family:var(--font-mono);">DRAG & DROP OR CLICK TO UPLOAD</span>
                            <input type="file" id="project-image" name="image" style="position:absolute; inset:0; opacity:0; cursor:pointer;" accept="image/*">
                        </div>
                    </div>

                    <div style="display:flex; gap:1rem; margin-top:0.5rem;">
                        <button type="button" class="btn-submit-cyber close-modal" style="background:rgba(255,255,255,0.05); border:1px solid var(--border-color); color:var(--text-primary); box-shadow:none;">Abort Operation</button>
                        <button type="submit" class="btn-submit-cyber" id="project-submit-btn">Commit Node</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('extra-scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const projectModal = document.getElementById('project-modal');
        const openProjectBtn = document.getElementById('open-project-modal');
        const closeButtons = projectModal ? projectModal.querySelectorAll(".close-modal") : [];

        function openModal(modal) {
            if (modal) modal.classList.add("active");
        }

        function closeModal(modal) {
            if (modal) modal.classList.remove("active");
        }

        if (openProjectBtn) {
            openProjectBtn.addEventListener('click', () => {
                const form = document.getElementById('project-form');
                if (form) {
                    form.reset();
                    document.getElementById('project-form-method').value = 'POST';
                    document.getElementById('project-work-id').value = '';
                    document.getElementById('project-modal-title').innerText = 'SYS:: INITIALIZE NEW PROJECT NODE';
                    document.getElementById('project-submit-btn').innerText = 'Commit Node';
                    document.getElementById('project-image').required = true;
                    if ($.fn.validate) { $('#project-form').validate().resetForm(); }
                }
                openModal(projectModal);
            });
        }

        document.querySelectorAll(".edit-project-btn").forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const title = btn.getAttribute('data-title');
                const description = btn.getAttribute('data-description');
                const link = btn.getAttribute('data-link');
                const tags = btn.getAttribute('data-tags');

                const form = document.getElementById('project-form');
                if (form) {
                    form.reset();
                    document.getElementById('project-form-method').value = 'PUT';
                    document.getElementById('project-work-id').value = id;
                    document.getElementById('project-title').value = title;
                    document.getElementById('project-description').value = description;
                    document.getElementById('project-link').value = link || '';
                    document.getElementById('project-tags').value = tags || '';
                    document.getElementById('project-modal-title').innerText = `SYS:: EDIT PROJECT NODE: ${title.toUpperCase()}`;
                    document.getElementById('project-submit-btn').innerText = 'Update Node';
                    document.getElementById('project-image').required = false;
                    if ($.fn.validate) { $('#project-form').validate().resetForm(); }
                }
                openModal(projectModal);
            });
        });

        closeButtons.forEach(btn => {
            btn.addEventListener('click', () => closeModal(projectModal));
        });

        if (projectModal) {
            projectModal.addEventListener('click', (e) => {
                if (e.target === projectModal) closeModal(projectModal);
            });
        }
    });

    $(document).ready(function () {
        // Custom rule: validate image file extension
        if ($.validator && !$.validator.methods.validImage) {
            $.validator.addMethod('validImage', function (value, element) {
                if (element.files && element.files[0]) {
                    var fileName = element.files[0].name;
                    return /\.(jpe?g|png|gif|webp|svg)$/i.test(fileName);
                }
                return true;
            }, 'Please select a valid image file (JPEG, PNG, JPG, GIF, WEBP)');
        }

        $('#project-form').validate({
            rules: {
                title: { required: true, minlength: 3 },
                description: { required: true, minlength: 3 },
                image: { validImage: true },
                link: { required: true },
                tags: { required: true }
            },
            messages: {
                title: {
                    required: 'Please enter the project title',
                    minlength: 'Title must be at least 3 characters'
                },
                description: {
                    required: 'Please enter the project description',
                    minlength: 'Description must be at least 3 characters'
                },
                link: { required: 'Please enter the project URL' },
                tags: { required: 'Please enter the project tags' }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.css({
                    color: '#ef4444',
                    fontSize: '0.75rem',
                    marginTop: '5px',
                    display: 'block',
                    fontFamily: 'var(--font-mono)'
                });
                element.closest('.form-group-cyber').append(error);
            },
            highlight: function (element) {
                $(element).css('border-color', '#ef4444');
            },
            unhighlight: function (element) {
                $(element).css('border-color', '');
            },
            submitHandler: function (form) {
                var $btn = $(form).find('[type="submit"]');
                var oldText = $btn.text();
                $btn.prop('disabled', true).text('UPLOADING...');

                var workId = $('#project-work-id').val();
                var isEdit = workId && workId !== '';
                var ajaxUrl = isEdit
                    ? "{{ url('admin/works') }}/" + workId
                    : "{{ route('admin.works.store') }}";

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
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
                            $btn.prop('disabled', false).text(oldText);
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
                        }
                    },
                    error: function (xhr) {
                        $btn.prop('disabled', false).text(oldText);
                        var errorMsg = 'An error occurred while processing the project node.';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors)
                                .map(function (e) { return e.join(', '); }).join(' ');
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
                    }
                });
            }
        });

        // Delete Project via AJAX
        $(document).on('click', '.delete-project-btn', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const title = $(this).attr('data-title');
            
            Swal.fire({
                title: 'DECOMMISSION PROJECT?',
                text: `Are you sure you want to delete the project "${title}"?`,
                icon: 'warning',
                showCancelButton: true,
                background: '#0a0b1e',
                color: '#e2e8f0',
                confirmButtonText: 'Yes, Delete',
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
                        url: `{{ url('admin/works') }}/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'PROJECT DECOMMISSIONED',
                                text: 'SYS:: Project deleted successfully.',
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
