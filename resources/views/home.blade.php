@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Redirecting...
                </div>

                <div class="card-body">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Mengarahkan ke client area...</p>
                        <p class="text-muted">Jika tidak otomatis teralihkan, <a href="{{ route('client') }}">klik di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto redirect to client after 2 seconds
    setTimeout(function() {
        window.location.href = "{{ route('client') }}";
    }, 2000);
</script>
@endsection
