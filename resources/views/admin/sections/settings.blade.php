<!-- SETTINGS PANEL SECTION -->
<div class="dashboard-section" id="settings">
    <div class="panel-card" style="max-width: 800px;">
        <div class="panel-header">
            <div>
                <h3>General Meta Settings</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">Control technical contact details, availability streams, and address markers.</p>
            </div>
        </div>

        <form id="settings-form" method="POST" action="{{ url('admin/settings') }}" style="margin-top:1.5rem;">
            @csrf
            @method('PUT')

            <div style="display:flex; flex-direction:column; gap:1.5rem;">
                <div class="grid-responsive-2">
                    <div class="form-group-cyber">
                        <label for="settings-email">Communication Email</label>
                        <div class="input-cyber-wrapper">
                            <input type="email" id="settings-email" name="email" class="input-cyber" value="{{ $settingData->email }}" required>
                        </div>
                    </div>
                    <div class="form-group-cyber">
                        <label for="settings-phone">Node Hotline (Phone)</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="settings-phone" name="phone" class="input-cyber" value="{{ $settingData->phone }}" required>
                        </div>
                    </div>
                </div>

                <div class="grid-responsive-2">
                    <div class="form-group-cyber">
                        <label for="settings-address">Base Command Center Address</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="settings-address" name="address" class="input-cyber" value="{{ $settingData->address }}" required>
                        </div>
                    </div>
                    <div class="form-group-cyber">
                        <label for="settings-availability">Availability Window</label>
                        <div class="input-cyber-wrapper">
                            <input type="text" id="settings-availability" name="avaliable_time" class="input-cyber" value="{{ $settingData->avaliable_time }}" required>
                        </div>
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; margin-top:0.5rem;">
                    <button type="submit" class="btn-submit-cyber" style="width:auto; padding:0.75rem 2rem;">Save System Properties</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('extra-scripts')
<script>
    $(document).ready(function() {
        $('#settings-form').validate({
            rules: {
                email: { required: true, email: true },
                phone: { required: true },
                address: { required: true },
                avaliable_time: { required: true }
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.css({ color: "#ef4444", fontSize: "0.75rem", marginTop: "5px", display: "block", fontFamily: "var(--font-mono)" });
                element.closest(".form-group-cyber").append(error);
            },
            submitHandler: function(form) {
                const $form = $(form);
                const $btn = $form.find('button[type="submit"]');
                const oldText = $btn.text();
                $btn.prop('disabled', true).text('SAVING...');

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        $btn.prop('disabled', false).text(oldText);
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'SETTINGS SAVED',
                                text: 'SYS:: ' + response.message,
                                icon: 'success',
                                background: '#0a0b1e',
                                color: '#e2e8f0',
                                showConfirmButton: false,
                                timer: 1500
                            });
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
                        var errorMsg = 'An error occurred while updating settings.';
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
    });
</script>
@endpush
