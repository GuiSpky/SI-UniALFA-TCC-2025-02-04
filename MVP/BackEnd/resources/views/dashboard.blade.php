@extends('layouts.app')

@section('title', 'Bem-vindo ao GEMA')

@section('content')
<div class="container-fluid py-5 text-center fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-8">
	<h1 class="display-4 fw-bold mb-4">
	                <i class="bi bi-gem me-3 text-info"></i>Bem-vindo ao <span class="text-primary">GEMA</span>
	            </h1>
                <h3>Gestão Escolar de Merenda e Alimentos</h3>
	            <p class="lead mb-5">
                Seu sistema de gestão eficiente para a prefeitura. Organize, planeje e execute com facilidade.
            </p>
            <div class="d-grid gap-3 col-md-8 mx-auto">
	                <a href="#" class="btn btn-primary btn-lg py-3 px-5 rounded-3 fw-bold shadow-sm">
                    <i class="bi bi-speedometer2 me-2"></i>Ir para o Dashboard
                </a>
	                <a href="#" class="btn btn-outline-secondary btn-lg py-3 px-5 rounded-3 fw-bold">
                    <i class="bi bi-info-circle me-2"></i>Saiba Mais
                </a>
            </div>
        </div>
    </div>
</div>

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Ops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif



@endsection

