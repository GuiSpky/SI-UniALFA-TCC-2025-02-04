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
                <span class="me-3">Bem-vindo, <strong>Admin</strong></span>
                <a href="#" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </a>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    <aside class="sidebar-modern" id="sidebar">
        <ul class="nav flex-column p-3">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('usuarios*') ? 'active' : '' }}" href="/usuarios">
                    <i class="bi bi-people"></i> Usuários
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('cidades*') ? 'active' : '' }}" href="/cidades">
                    <i class="bi bi-geo-alt"></i> Cidades
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('bairros*') ? 'active' : '' }}" href="/bairros">
                    <i class="bi bi-map"></i> Bairros
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('escolas*') ? 'active' : '' }}" href="/escolas">
                    <i class="bi bi-person-workspace"></i> Escolas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('produtos*') ? 'active' : '' }}" href="/produtos">
                    <i class="bi bi-egg"></i> Produtos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('itemprodutos*') ? 'active' : '' }}" href="/itemprodutos">
                    <i class="bi bi-shop-window"></i> Estoque
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('cardapios*') ? 'active' : '' }}" href="/cardapios">
                    <i class="bi bi-menu-button-wide"></i> Cardápios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('configuracoes*') ? 'active' : '' }}" href="#">
                    <i class="bi bi-gear"></i> Configurações
                </a>
            </li>

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
