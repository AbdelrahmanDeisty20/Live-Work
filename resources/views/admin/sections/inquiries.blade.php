<!-- INQUIRIES PANEL SECTION -->
<div class="dashboard-section" id="inquiries">
    <div class="panel-card">
        <div class="panel-header">
            <div>
                <h3>Transmission Envelope Decryption Inbox</h3>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin-top:0.25rem;">View and decrypt incoming client communication streams.</p>
            </div>
        </div>

        <div class="table-wrapper" style="max-height:none; margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Sender Name</th>
                        <th>Sender Email</th>
                        <th>Subject Line</th>
                        <th>Message Content</th>
                        <th>Date Logged</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($contacts)
                        @forelse($contacts as $contact)
                            <tr>
                                <td style="font-weight:700; color:var(--neon-cyan);">{{ $contact->name }}</td>
                                <td style="font-family:var(--font-mono); font-size:0.8rem; color:var(--text-secondary);">{{ $contact->email }}</td>
                                <td style="color:var(--text-primary); font-weight:600;">{{ $contact->subject }}</td>
                                <td style="max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--text-secondary);" title="{{ $contact->message }}">{{ $contact->message }}</td>
                                <td style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted);">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                <td style="text-align:right;">
                                    <button class="action-btn-delete delete-inquiry-btn" 
                                            data-id="{{ $contact->id }}" 
                                            data-sender="{{ $contact->name }}"
                                            title="Decommission envelope" style="background:none; border:none; color:var(--neon-red); cursor:pointer;"><i data-lucide="trash-2" style="width:16px;height:16px;"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; color:var(--text-secondary); padding:3rem;">No secure transmission envelopes found.</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--text-secondary); padding:3rem;">No secure transmission envelopes found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('extra-scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-inquiry-btn', function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const sender = $(this).attr('data-sender');
            
            Swal.fire({
                title: 'DECOMMISSION ENVELOPE?',
                text: `Are you sure you want to delete the transmission envelope from "${sender}"?`,
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
                        url: `{{ url('admin/inquiries') }}/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'ENVELOPE DECOMMISSIONED',
                                text: 'SYS:: Message deleted successfully.',
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
