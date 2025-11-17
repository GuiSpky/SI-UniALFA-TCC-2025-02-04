<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #1f2937;
            /* Cinza escuro para o fundo da página (Tailwind gray-800) */
            --bg-light: #f3f4f6;
            /* Cinza claro para o fundo da página (Tailwind gray-100) */
            --text-dark: #fff;
            /* Texto claro */
            --text-light: #1f2937;
            /* Texto escuro */

            --sidebar-width: 260px;
            --sidebar-bg-dark: #111827;
            --sidebar-bg-light: #f8f9fa;
            --sidebar-text-dark: #fff;
            --sidebar-text-light: #000;
        }

        /* Clarear textos secundários (ex: .text-muted) no modo escuro */
        body.dark .text-muted {
            color: #cbd5e1 !important;
            /* tom claro e suave */
        }

        body.dark .table td,
        body.dark .table th,
        body.dark .table a {
            color: #f1f5f9 !important;
            /* tom claro */
        }

        /* Links na tabela (modo escuro) */
        body.dark .table a:hover {
            color: #60a5fa !important;
            /* azul suave ao passar o mouse */
        }

        body {
            font-family: "Inter", sans-serif;
            min-height: 100vh;
            display: flex;
            transition: background-color 0.3s, color 0.3s;
        }

        .id {
            font-size: 0.9rem;
        }

        body.dark {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        body.light {
            background-color: var(--bg-light);
            color: var(--text-light);
        }

        /* Estilo para elementos que precisam de fundo/borda em modo escuro/claro */
        .card,
        .table {
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        body.dark .card {
            background-color: #1f2937;
            /* Fundo do card em modo escuro */
            color: var(--text-dark);
            border-color: #374151;
            /* Borda do card em modo escuro */
        }

        body.light .card {
            background-color: #ffffff;
            /* Fundo do card em modo claro */
            color: var(--text-light);
            border-color: #e5e7eb;
            /* Borda do card em modo claro */
        }

        body.dark .table {
            --bs-table-bg: #1f2937;
            --bs-table-color: var(--text-dark);
            --bs-table-border-color: #374151;
        }

        body.dark .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-bg-type: #2d3748;
            /* linha ímpar mais escura */
        }

        body.dark .table-striped>tbody>tr:nth-of-type(even) {
            background-color: #1f2937 !important;
            /* linha par mais clara */
        }

        body.dark .table-hover>tbody>tr:hover {
            background-color: #374151 !important;
            /* destaque forte no hover */
        }

        body.dark .table thead th {
            background-color: #111827 !important;
            /* cabeçalho mais contrastado */
            color: #f9fafb !important;
            /* texto branco */
            border-bottom: 2px solid #4b5563 !important;
        }

        body.dark .form-control,
        body.dark .form-select {
            background-color: #374151;
            color: var(--text-dark);
            border-color: #4b5563;
        }

        body.dark .form-control:focus,
        body.dark .form-select:focus {
            background-color: #374151;
            color: var(--text-dark);
            border-color: #6b7280;
            box-shadow: 0 0 0 0.25rem rgba(107, 114, 128, 0.25);
        }

        body.dark .btn-outline-secondary {
            color: var(--text-dark);
            border-color: #6b7280;
        }

        body.dark .btn-outline-secondary:hover {
            background-color: #6b7280;
            color: var(--text-dark);
        }

        body.dark .modal-content {
            background-color: #1f2937;
            color: var(--text-dark);
            border: 1px solid #374151;
        }

        body.dark .modal-header,
        body.dark .modal-footer {
            border-color: #374151;
        }

        body.dark .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* Coerência de estilo para links e botões */
        .sidebar.dark .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar.light .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
            /* Forçar branco para o link ativo */
        }

        body.dark .nav-link {
            color: rgba(255, 255, 255, 0.85);
        }

        body.light .nav-link {
            color: #333;
        }

        /* Estilo para o cabeçalho do sidebar */
        .sidebar.dark .sidebar-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.light .sidebar-header {
            border-bottom: 1px solid #dee2e6;
        }

        /* Estilo para o rodapé do sidebar */
        .sidebar.dark .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.light .sidebar-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: background-color 0.3s, color 0.3s, width 0.3s;
            padding: 1rem 0;
            position: fixed;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        .sidebar.dark {
            background-color: var(--sidebar-bg-dark);
            color: var(--sidebar-text-dark);
        }

        .sidebar.light {
            background-color: var(--sidebar-bg-light);
            color: var(--sidebar-text-light);
            border-right: 1px solid #dee2e6;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            border-radius: 8px;
            padding: 10px 16px;
            margin: 2px 10px;
            transition: background-color 0.2s, color 0.2s;
        }

        .sidebar.dark .nav-link {
            color: rgba(255, 255, 255, 0.85);
        }

        .sidebar.light .nav-link {
            color: #333;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        .sidebar .sidebar-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            padding: 0 16px 1rem 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar.light .sidebar-header {
            border-color: #dee2e6;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 1rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar.light .sidebar-footer {
            border-color: #dee2e6;
        }

        .sidebar-footer img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left 0.3s;
        }

        body.dark .table> :not(caption)>*>* {
            border-color: #4b5563 !important;
            /* borda mais forte */
        }

        /* Ocultar colunas específicas apenas no CELULAR */
        @media (max-width: 768px) {

            /* USUÁRIOS */
            .col-id,
            .col-email,
            .col-telefone,
            .col-cargo {
                display: none !important;
            }

            /* CIDADES */
            .col-cidade-id {
                display: none !important;
            }

            /* BAIRROS */
            .col-bairro-id {
                display: none !important;
            }

            /* CONSUMOS */
            .col-data-saida {
                display: none !important;
            }

            /* PEDIDOS */
            .col-pedido-data,
            .col-pedido-produtos,
            .col-acoes {
                display: none !important;
            }

            /* ESCOLAS */
            .col-escola-id,
            .col-escola-bairro,
            .col-escola-cidade {
                display: none !important;
            }

            /* PRODUTOS */
            .col-produto-id,
            .col-produto-grupo {
                display: none !important;
            }

            /* CARDÁPIOS */
            .col-cardapio-id,
            .col-cardapio-acoes {
                display: none !important;
            }

            /* ESTOQUE */
            .col-estoque-id,
            .col-estoque-data,
            .col-estoque-validade,
            .col-estoque-deposito,
            .col-estoque-pedido {
                display: none !important;
            }

            .sidebar {
                position: fixed;
                left: -260px;
                z-index: 1050;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-btn {
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1060;
                background-color: #0d6efd;
                color: #fff;
                border: none;
                border-radius: 8px;
                padding: 8px 10px;
            }

            .estoque-filter-container {
                background: #fff;
                padding: 10px 12px;
                border-radius: 10px;
                border: 1px solid #ddd;
                margin-bottom: 12px;
            }

            .estoque-filter-container label {
                font-size: 0.8rem;
                margin-bottom: 4px;
                display: block;
            }

            .estoque-filter-container select {
                width: 100%;
                font-size: 0.9rem;
                padding: 6px 10px;
            }

            /* Remove margem exagerada do container principal */
            .estoque-filter-wrapper {
                margin-bottom: 10px !important;
            }
        }


        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="light" x-data="{ isDark: false }">
    <!-- Botão Toggle para mobile -->
    <button class="toggle-btn d-md-none" id="sidebarToggle"><i class="bi bi-list"></i></button>

    <!-- Sidebar -->
    <aside class="sidebar light" id="sidebar">
        <div>
            <div class="sidebar-header">
                <img src="{{ asset('images/logo_gema.png') }}" alt="Logo" style="height: 40px; width: auto;">
                <span style="font-size: 1.2rem; font-weight: 600;">GEMA</span>
            </div>

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

    @if (session('erro'))
        <script>
            Swal.fire({
                title: 'Erro!',
                text: '{{ session('erro') }}',
                icon: 'error',
                confirmButtonText: 'Continuar',
                confirmButtonColor: '#dc3545'
            });
        </script>
    @endif
</body>

</html>
