<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
             @yield('content')
            </main>
        </div>
    </body>
</html>
