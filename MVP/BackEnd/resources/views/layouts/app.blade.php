<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>

<body class="light" x-data="{ isDark: false }">
    <!-- Botão Toggle para mobile -->
    <button class="toggle-btn d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>

    <!-- Sidebar -->
    <aside class="sidebar light" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo_gema.png') }}" alt="Logo" style="height: 40px; width: auto;">
            <span style="font-size: 1.2rem; font-weight: 600;">GEMA</span>
        </div>

        <div class="sidebar-content">
            <ul class="nav flex-column">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}"><i
                                class="bi bi-house-fill"></i>
                            Home</a></li>

                    @if (in_array(Auth::user()->cargo, [1]))
                        <li><a href="{{ route('usuarios.index') }}"
                                class="nav-link {{ Request::is('usuarios*') ? 'active' : '' }}"><i
                                    class="bi bi-people-fill"></i>
                                Usuários</a></li>
                        <li><a href="{{ route('cidades.index') }}"
                                class="nav-link {{ Request::is('cidades*') ? 'active' : '' }}"><i
                                    class="bi bi-buildings"></i>
                                Cidades</a></li>
                        <li><a href="{{ route('bairros.index') }}"
                                class="nav-link {{ Request::is('bairros*') ? 'active' : '' }}"><i
                                    class="bi bi-geo-alt-fill"></i>
                                Bairros</a></li>
                        <li><a href="{{ route('relatorios.index') }}"
                                class="nav-link {{ Request::is('relatorios*') ? 'active' : '' }}"><i
                                    class="bi bi-bar-chart-fill"></i>
                                Relatórios</a></li>
                    @endif

                    @if (in_array(Auth::user()->cargo, [1, 2]))
                        <li><a href="{{ route('consumos.index') }}"
                                class="nav-link {{ Request::is('consumos*') ? 'active' : '' }}"><i
                                    class="bi bi-lightning-charge-fill"></i> Consumos</a></li>
                        <li><a href="{{ route('pedidos.index') }}"
                                class="nav-link {{ Request::is('pedidos*') ? 'active' : '' }}"><i
                                    class="bi bi-clipboard-check"></i>
                                Pedidos</a></li>
                    @endif

                    @if (in_array(Auth::user()->cargo, [1, 2, 4]))
                        <li><a href="{{ route('escolas.index') }}"
                                class="nav-link {{ Request::is('escolas*') ? 'active' : '' }}"><i
                                    class="bi bi-mortarboard-fill"></i> Escolas</a></li>
                        <li><a href="{{ route('produtos.index') }}"
                                class="nav-link {{ Request::is('produtos*') ? 'active' : '' }}"><i
                                    class="bi bi-box-seam"></i>
                                Produtos</a></li>
                    @endif

                    @if (in_array(Auth::user()->cargo, [1, 2, 3, 4]))
                        <li><a href="{{ route('cardapios.index') }}"
                                class="nav-link {{ Request::is('cardapios*') ? 'active' : '' }}"><i
                                    class="bi bi-list-ul"></i> Cardápios</a></li>
                    @endif

                    @if (in_array(Auth::user()->cargo, [1, 2, 3, 4]))
                        <li><a href="{{ route('estoques.index') }}"
                                class="nav-link {{ Request::is('estoques*') ? 'active' : '' }}"><i
                                    class="bi bi-archive"></i> Estoque</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="sidebar-footer dropdown">
            <div class="d-flex align-items-center gap-2 dropdown-toggle" data-bs-toggle="dropdown"
                style="cursor: pointer;">
                @php
                    $icons = [
                        1 => 'bi-award-fill', // Gerente
                        2 => 'bi-fire', // Cozinheiro-chefe
                        3 => 'bi-egg-fried', // Cozinheiro
                        4 => 'bi-clipboard-pulse', // Nutricionista
                    ];

                    $iconClass = $icons[Auth::user()->cargo] ?? 'bi-person-circle';
                @endphp

                <i class="bi {{ $iconClass }}" style="font-size: 1.8rem;"></i>

                <span>{{ Auth::user()->name ?? 'Usuário' }}</span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Sair</button>
                    </form>
                </li>
            </ul>

            <button id="themeToggle" class="btn btn-sm btn-outline-secondary rounded-pill ms-2">
                <i class="bi bi-sun-fill"></i>
            </button>
        </div>

    </aside>

    <!-- Conteúdo principal -->
    <main class="main-content fade-in-up">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const themeToggle = document.getElementById("themeToggle");
        const body = document.body;

        // Toggle sidebar (mobile)
        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("show");
        });

        // Função para aplicar o tema
        function applyTheme(isDark) {
            if (isDark) {
                sidebar.classList.add("dark");
                sidebar.classList.remove("light");
                body.classList.add("dark");
                body.classList.remove("light");
                themeToggle.innerHTML = '<i class="bi bi-moon-fill"></i>';
                localStorage.setItem('theme', 'dark');
            } else {
                sidebar.classList.add("light");
                sidebar.classList.remove("dark");
                body.classList.add("light");
                body.classList.remove("dark");
                themeToggle.innerHTML = '<i class="bi bi-sun-fill"></i>';
                localStorage.setItem('theme', 'light');
            }
        }

        // Inicializar com o tema salvo ou padrão (claro)
        const savedTheme = localStorage.getItem('theme') || 'light';
        const initialIsDark = savedTheme === 'dark';
        applyTheme(initialIsDark);

        // Alternar modo claro/escuro
        themeToggle.addEventListener("click", () => {
            const isDark = body.classList.contains("light"); // Se for light, o próximo será dark
            applyTheme(isDark);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('sucesso'))
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: '{{ session('sucesso') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0d6efd'
            });
        </script>
    @endif

    @if (session('toast'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: false,
                title: "{{ addslashes(session('toast')) }}",
                didOpen: (toast) => {
                    const icon = document.createElement("div");
                    icon.innerHTML = "{{ session('toast_icon') }}";
                    icon.style.fontSize = "26px";
                    icon.style.marginRight = "10px";
                    toast.querySelector(".swal2-title").before(icon);
                }
            });
        </script>
    @endif

</body>

</html>
