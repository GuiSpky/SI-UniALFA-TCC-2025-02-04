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
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar-modern {
            background-color: #405c77;
            /* Manter escuro como na imagem */
            color: white;
            padding: 0.8rem 1.5rem;
            z-index: 1030;
            position: sticky;
            top: 0;
        }

        .navbar-modern .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
        }

        .navbar-modern .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .navbar-modern .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-modern {
            position: fixed;
            top: 56px;
            left: 0;
            height: calc(100vh - 56px);
            width: var(--sidebar-width);
            background-color: #0e2c49;
            /* Ajustado para ser mais escuro, como na imagem */
            transition: width 0.3s ease;
            z-index: 1020;
        }

        .sidebar-modern.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-modern .nav-link {
            margin: 0 10px 5px 10px;
            /* Adicionar margem para destacar o item ativo */
            color: rgba(255, 255, 255, 0.85);
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            border-radius: 0.4rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-modern .nav-link:hover {
            background-color: #343a40;
            /* Hover mais claro */
        }

        .sidebar-modern .nav-link.active {
            background-color: #0d6efd;
            /* Manter o azul para o item ativo */
            color: white;
        }

        .main-content-modern {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .sidebar-modern.collapsed~.main-content-modern {
            margin-left: var(--sidebar-collapsed-width);
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .sidebar-modern {
                width: 0;
            }

            .sidebar-modern.collapsed {
                width: var(--sidebar-width);
            }

            .main-content-modern {
                margin-left: 0;
            }

            .sidebar-modern.collapsed~.main-content-modern {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-modern">
        <div class="container-fluid">
            <button class="btn btn-outline-light me-3" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="#">Painel Administrativo</a>
            <div class="d-flex align-items-center ms-auto">
                @auth
                    <span class="me-3 text-white">Bem-vindo, <strong>{{ Auth::user()->name }}</strong></span>
                @endauth

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-1"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
<aside class="sidebar-modern" id="sidebar">
    <ul class="nav flex-column p-3">

        @auth
            {{-- ====================================================================== --}}
            {{-- O CÓDIGO ABAIXO FOI ATUALIZADO COM AS REGRAS DE PERMISSÃO --}}
            {{-- ====================================================================== --}}

            {{-- Link do Dashboard: Visível para TODOS os usuários logados --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> <span>Dashboard</span>
                </a>
            </li>

            {{-- Links apenas para GERENTES (cargo 1) --}}
            @if (in_array(Auth::user()->cargo, [1]))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                        <i class="bi bi-people"></i> <span>Usuários</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cidades*') ? 'active' : '' }}" href="{{ route('cidades.index') }}">
                        <i class="bi bi-geo-alt"></i> <span>Cidades</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bairros*') ? 'active' : '' }}" href="{{ route('bairros.index') }}">
                        <i class="bi bi-map"></i> <span>Bairros</span>
                    </a>
                </li>
            @endif

            {{-- Links para GERENTES, COZINHEIROS-CHEFES e NUTRICIONISTAS (cargos 1, 2, 4) --}}
            @if (in_array(Auth::user()->cargo, [1, 2, 4]))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('escolas*') ? 'active' : '' }}" href="{{ route('escolas.index') }}">
                        <i class="bi bi-person-workspace"></i> <span>Escolas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produtos*') ? 'active' : '' }}" href="{{ route('produtos.index') }}">
                        <i class="bi bi-egg"></i> <span>Produtos</span>
                    </a>
                </li>
            @endif

            {{-- Link de Cardápios: Visível para TODOS OS CARGOS --}}
            {{-- A lógica aqui é que todos os seus cargos definidos têm acesso --}}
            @if (in_array(Auth::user()->cargo, [1, 2, 3, 4]))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cardapios*') ? 'active' : '' }}" href="{{ route('cardapios.index') }}">
                        <i class="bi bi-menu-button-wide"></i> <span>Cardápios</span>
                    </a>
                </li>
            @endif

            {{-- Links de Estoque e Configurações (exemplo, ajuste as permissões conforme necessário) --}}
            {{-- Por enquanto, vamos deixar visível para Gerentes e Cozinheiros-Chefes --}}
            @if (in_array(Auth::user()->cargo, [1, 2]))
                <li class="nav-item">
                    {{-- ATENÇÃO: A rota /itemprodutos não foi definida. Crie-a se necessário. --}}
                    <a class="nav-link {{ Request::is('itemprodutos*') ? 'active' : '' }}" href="#">
                        <i class="bi bi-shop-window"></i> <span>Estoque</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('configuracoes*') ? 'active' : '' }}" href="#">
                        <i class="bi bi-gear"></i> <span>Configurações</span>
                    </a>
                </li>
            @endif

        @endauth
    </ul>
</aside>


    <!-- Conteúdo principal -->
    <main class="main-content-modern fade-in-up">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            document.querySelector('.main-content-modern').classList.toggle('collapsed');
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
                confirmButtonText: 'Tentar novamente',
                confirmButtonColor: '#dc3545'
            });
        </script>
    @endif

</body>

</html>
