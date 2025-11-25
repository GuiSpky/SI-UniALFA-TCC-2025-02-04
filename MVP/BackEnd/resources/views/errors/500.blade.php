@extends('layouts.app')

@section('title', 'Ops... Algo aconteceu')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#f8f9fa', // cinza claro
            });

            Toast.fire({
                icon: false, // remove ícone de erro
                title: 'Algo inesperado aconteceu, mas já estamos te redirecionando...',
            });

            // Redireciona suavemente após o toast
            setTimeout(() => {
                window.location.href = "{{ url('/') }}";
            }, 3500);
        });
    </script>

    <div class="container py-5 text-center">
        <h3 class="fw-semibold text-secondary">Tudo certo, isso acontece às vezes…</h3>
        <p class="text-muted">
            Aguarde um instante, estamos te levando de volta para a página inicial.
        </p>
    </div>
@endsection
