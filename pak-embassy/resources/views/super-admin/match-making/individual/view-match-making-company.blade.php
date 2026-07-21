@extends('layouts.master')

@section('content')
    @include('super-admin.match-making.individual.view-match-making-detail')
@endsection
@section('js-file')
<script>
    document.querySelectorAll('.select-match').forEach(match => {
        match.addEventListener('click', function() {
            const badge = this.querySelector('.badge');
            const input = this.querySelector('input[name="selected_emails[]"]');

            if (badge.classList.contains('d-none')) {
                badge.classList.remove('d-none'); 
                input.value = this.dataset.email;
            } else {
                badge.classList.add('d-none');
                input.value = '';
            }
        });
    });
</script>
@endsection
