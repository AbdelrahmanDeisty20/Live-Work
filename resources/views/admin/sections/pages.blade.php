<!-- PAGES PANEL SECTION -->
<div class="dashboard-section" id="pages">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Page Editor Console</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Configure page title details, key text nodes, and image assets.</p>
            </div>
            <button class="btn-submit-cyber" id="open-page-modal" style="width:auto; padding:0.6rem 1.2rem; font-size:0.85rem;">
                <i data-lucide="plus" style="width:16px;height:16px;"></i> Add New Page Element
            </button>
        </div>

        <div class="table-wrapper" style="max-height:none; margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($pages)
                        @forelse($pages as $page)
                            <tr>
                                <td style="font-weight:700; color:var(--neon-cyan); font-family:var(--font-mono);">{{ $page->key }}</td>
                                <td>
                                    <span style="font-size:0.75rem; padding:0.1rem 0.4rem; background:rgba(0, 242, 254, 0.1); border:1px solid rgba(0, 242, 254, 0.2); border-radius:3px; color:var(--neon-cyan); font-family:var(--font-mono);">{{ strtoupper($page->type) }}</span>
                                </td>
                                <td style="max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--text-secondary);">
                                    @if($page->type === 'image')
                                        @if($page->value)
                                            <div style="width:60px; height:40px; border-radius:4px; overflow:hidden; border:1px solid var(--border-color); background:rgba(255,255,255,0.05); display:flex; align-items:center; justify-content:center;">
                                                <img src="{{ asset('storage/' . $page->value) }}" alt="{{ $page->key }}" style="width:100%; height:100%; object-fit:cover;">
                                            </div>
                                        @else
                                            <span style="color:var(--text-muted);">No Image</span>
                                        @endif
                                    @else
                                        {{ $page->value }}
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex; gap:0.5rem;">
                                        <button class="action-btn-edit edit-page-btn" 
                                                data-id="{{ $page->id }}"
                                                data-key="{{ $page->key }}"
                                                data-type="{{ $page->type }}"
                                                data-value="{{ $page->type === 'image' ? '' : $page->value }}"
                                                title="Edit node" style="background:none; border:none; color:var(--neon-cyan); cursor:pointer;"><i data-lucide="edit-3" style="width:16px;height:16px;"></i></button>

                                        <button class="action-btn-delete delete-page-btn" 
                                                data-id="{{ $page->id }}" 
                                                data-key="{{ $page->key }}"
                                                title="Decommission node" style="background:none; border:none; color:var(--neon-red); cursor:pointer;"><i data-lucide="trash-2" style="width:16px;height:16px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--text-secondary); padding:2rem;">No page nodes configured. Click "Add New Page Element" to initialize.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="4" style="text-align:center; color:var(--text-secondary); padding:2rem;">No page nodes configured.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page Management Modal -->
<div class="cyber-modal" id="page-modal">
    <div class="login-card" style="max-width:500px; width:100%;">
        <div class="terminal-header">
            <div class="window-dots">
                <div class="dot dot-red close-modal"></div>
                <div class="dot dot-yellow"></div>
                <div class="dot dot-green"></div>
            </div>
            <span class="terminal-title" id="page-modal-title">SYS:: REGISTER NEW PAGE NODE</span>
            <span class="close-modal" style="cursor:pointer;"><i data-lucide="x" style="width:14px;height:14px;color:var(--neon-cyan);"></i></span>
        </div>
        <div class="login-card-body" style="padding:2rem;">
            <form id="page-form" method="POST" enctype="multipart/form-data" action="{{ url('admin/pages') }}">
                @csrf
                <input type="hidden" name="_method" id="page-form-method" value="POST">
                <input type="hidden" name="id" id="page-id">

                <div style="display:flex; flex-direction:column; gap:1.2rem;">
                    <div class="form-group-cyber">
                        <label for="page-key">Page Element Key</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="page-key" name="key" class="input-cyber" placeholder="e.g. big_title" required>
                        </div>
                    </div>

                    <div class="form-group-cyber">
                        <label for="page-type">Element Type</label>
                        <div class="input-cyber-wrapper">
                            <select id="page-type" name="type" class="input-cyber" style="background: var(--bg-card); color: var(--text-primary); border: none; outline: none; width: 100%;" required>
                                <option value="text">Text (Single Line)</option>
                                <option value="textarea">Textarea (Multiple Lines)</option>
                                <option value="image">Image File</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-cyber" id="page-value-text-wrapper">
                        <label for="page-value-text">Element Value</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="page-value-text" class="input-cyber" placeholder="Enter text value...">
                        </div>
                    </div>

                    <div class="form-group-cyber" id="page-value-textarea-wrapper" style="display:none;">
                        <label for="page-value-textarea">Element Value (Textarea)</label>
                        <div class="input-cyber-wrapper">
                            <textarea id="page-value-textarea" class="input-cyber" rows="4" placeholder="Enter multi-line text value..." style="resize:none; height:auto;"></textarea>
                        </div>
                    </div>

                    <div class="form-group-cyber" id="page-value-image-wrapper" style="display:none;">
                        <label for="page-value-image">Element Image Asset</label>
                        <div class="input-cyber-wrapper" style="border:1px dashed var(--border-color); padding:1rem; border-radius:8px; display:flex; flex-direction:column; align-items:center; gap:0.5rem; background:rgba(0,0,0,0.2); position:relative;">
                            <i data-lucide="upload-cloud" style="width:24px; height:24px; color:var(--text-secondary);"></i>
                            <span style="font-size:0.75rem; color:var(--text-secondary); font-family:var(--font-mono);">CLICK TO UPLOAD</span>
                            <input type="file" id="page-value-image" class="file-input-cyber" style="position:absolute; inset:0; opacity:0; cursor:pointer;" accept="image/*">
                        </div>
                    </div>

                    <div style="display:flex; gap:1rem; margin-top:0.5rem;">
                        <button type="button" class="btn-submit-cyber close-modal" style="background:rgba(255,255,255,0.05); border:1px solid var(--border-color); color:var(--text-primary); box-shadow:none;">Abort Operation</button>
                        <button type="submit" class="btn-submit-cyber" id="page-submit-btn">Commit Node</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('extra-scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const pageModal = document.getElementById("page-modal");
        const openPageBtn = document.getElementById("open-page-modal");
        const closeButtons = pageModal ? pageModal.querySelectorAll(".close-modal") : [];

        function openModal(modal) {
            if (modal) modal.classList.add("active");
        }

        function closeModal(modal) {
            if (modal) modal.classList.remove("active");
        }

        if (openPageBtn) {
            openPageBtn.addEventListener("click", () => {
                const form = document.getElementById("page-form");
                if (form) {
                    form.reset();
                    form.action = "{{ url('admin/pages') }}";
                    document.getElementById("page-form-method").value = "POST";
                    document.getElementById("page-modal-title").innerText = "SYS:: REGISTER NEW PAGE NODE";
                    document.getElementById("page-submit-btn").innerText = "Commit Node";
                    document.getElementById("page-key").readOnly = false;
                    document.getElementById("page-type").disabled = false;
                    updatePageValueInputs();
                }
                openModal(pageModal);
            });
        }

        document.querySelectorAll(".edit-page-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                const key = btn.getAttribute("data-key");
                const type = btn.getAttribute("data-type");
                const value = btn.getAttribute("data-value");

                const form = document.getElementById("page-form");
                if (form) {
                    form.action = "{{ url('admin/pages') }}";
                    document.getElementById("page-form-method").value = "PUT";
                    document.getElementById("page-id").value = id;
                    document.getElementById("page-key").value = key;
                    document.getElementById("page-key").readOnly = true;
                    document.getElementById("page-type").value = type;
                    document.getElementById("page-type").disabled = true;
                    
                    let hiddenType = document.getElementById("page-hidden-type");
                    if (!hiddenType) {
                        hiddenType = document.createElement("input");
                        hiddenType.type = "hidden";
                        hiddenType.name = "type";
                        hiddenType.id = "page-hidden-type";
                        form.appendChild(hiddenType);
                    }
                    hiddenType.value = type;

                    document.getElementById("page-value-text").value = "";
                    document.getElementById("page-value-textarea").value = "";
                    
                    if (type === 'text') {
                        document.getElementById("page-value-text").value = value;
                    } else if (type === 'textarea') {
                        document.getElementById("page-value-textarea").value = value;
                    }

                    document.getElementById("page-modal-title").innerText = `SYS:: EDIT PAGE NODE: ${key.toUpperCase()}`;
                    document.getElementById("page-submit-btn").innerText = "Update Node";
                    
                    updatePageValueInputs();
                }
                openModal(pageModal);
            });
        });

        closeButtons.forEach(btn => {
            btn.addEventListener("click", () => closeModal(pageModal));
        });

        if (pageModal) {
            pageModal.addEventListener("click", (e) => {
                if (e.target === pageModal) closeModal(pageModal);
            });
        }

        const pageTypeSelect = document.getElementById("page-type");
        const textWrapper = document.getElementById("page-value-text-wrapper");
        const textareaWrapper = document.getElementById("page-value-textarea-wrapper");
        const imageWrapper = document.getElementById("page-value-image-wrapper");

        const textInput = document.getElementById("page-value-text");
        const textareaInput = document.getElementById("page-value-textarea");
        const imageInput = document.getElementById("page-value-image");

        function updatePageValueInputs() {
            if (!pageTypeSelect) return;
            const selected = pageTypeSelect.value;
            if (selected === "text") {
                textWrapper.style.display = "block";
                textareaWrapper.style.display = "none";
                imageWrapper.style.display = "none";
                
                textInput.setAttribute("name", "value");
                textareaInput.removeAttribute("name");
                imageInput.removeAttribute("name");
                
                textInput.required = true;
                textareaInput.required = false;
                imageInput.required = false;
            } else if (selected === "textarea") {
                textWrapper.style.display = "none";
                textareaWrapper.style.display = "block";
                imageWrapper.style.display = "none";
                
                textInput.removeAttribute("name");
                textareaInput.setAttribute("name", "value");
                imageInput.removeAttribute("name");
                
                textInput.required = false;
                textareaInput.required = true;
                imageInput.required = false;
            } else if (selected === "image") {
                textWrapper.style.display = "none";
                textareaWrapper.style.display = "none";
                imageWrapper.style.display = "block";
                
                textInput.removeAttribute("name");
                textareaInput.removeAttribute("name");
                imageInput.setAttribute("name", "value");
                
                textInput.required = false;
                textareaInput.required = false;
                const isEdit = document.getElementById("page-form-method").value === "PUT";
                imageInput.required = !isEdit;
            }
        }

        if (pageTypeSelect) {
            pageTypeSelect.addEventListener("change", updatePageValueInputs);
            updatePageValueInputs();
        }
    });

    $(document).ready(function () {
        $('#page-form').validate({
            rules: {
                key: { required: true },
                type: { required: true }
            },
            messages: {
                key: { required: "Please enter the page element key" },
                type: { required: "Please select the element type" }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.css({
                    color: "#ef4444",
                    fontSize: "0.75rem",
                    marginTop: "5px",
                    display: "block",
                    fontFamily: "var(--font-mono)"
                });
                element.closest(".form-group-cyber").append(error);
            },
            submitHandler: function (form) {
                var $form = $(form);
                var $submitBtn = $('#page-submit-btn');
                var oldText = $submitBtn.text();
                
                $submitBtn.prop('disabled', true).text('PROCESSING...');

                var url = $form.attr('action');
                var formData = new FormData(form);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
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
                        var errorMsg = 'An error occurred while updating the page node.';
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

        // Delete Page Element via AJAX
        $(document).on('click', '.delete-page-btn', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const key = $(this).attr('data-key');
            
            Swal.fire({
                title: 'DECOMMISSION ELEMENT?',
                text: `Are you sure you want to delete page element "${key}"?`,
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
                        url: `{{ url('admin/pages') }}/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'ELEMENT DECOMMISSIONED',
                                text: 'SYS:: Page element deleted successfully.',
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
