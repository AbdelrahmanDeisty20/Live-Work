<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global CSRF Token Setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
</script>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="{{ asset('assets/dashboard/script.js') }}"></script>
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
    @stack('extra-scripts')
</body>
</html>
