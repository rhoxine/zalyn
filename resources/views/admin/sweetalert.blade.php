{{-- for sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            text: '{{ session('success') }}',
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            text: '{{ session('error') }}',
        });
    @endif
</script>