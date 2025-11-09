<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 fade-in-up">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-gem text-primary" style="font-size: 3rem;"></i>
                        <h1 class="h4 fw-bold mt-3">Acesso ao Sistema</h1>
                        <p class="text-muted mb-0">Entre com suas credenciais para continuar</p>
                    </div>

                    <!-- Mensagem de sessão -->
                    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-1"></i>Email
                            </label>
                            <input id="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                                type="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="Digite seu email" autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="invalid-feedback small" />
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock me-1"></i>Senha
                            </label>
                            <input id="password" class="form-control rounded-3 @error('password') is-invalid @enderror"
                                type="password" name="password" required placeholder="Digite sua senha"
                                autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="invalid-feedback small" />
                        </div>

                        <!-- Lembrar -->
                        <div class="form-check mb-3">
                            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label small text-muted" for="remember_me">
                                Lembrar-me
                            </label>
                        </div>

                        <!-- Ações -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none text-primary"
                                   href="{{ route('password.request') }}">
                                    Esqueceu sua senha?
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary shadow-sm px-4 rounded-3">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-4 small">
                &copy; {{ date('Y') }} Gestão Escolar de Merenda e Alimentos
            </p>
        </div>
    </div>
</x-guest-layout>
