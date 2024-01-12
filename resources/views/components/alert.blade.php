@if ($type && $message)
<div class="alert notification alert-{{ $type }} alert-dismissible" role="alert">
    <div>{{ $message }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@push('scripts')
    <script>
        $('document').ready(function () {
            setTimeout(() => {
                $('.alert').remove();
            }, 4000);
        })
    </script>
@endpush
