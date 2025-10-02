<div class="sidebar">
    <h2>Menu</h2>
    <a href="#/">Início</a>
    <a href="#/cidades">Cidades</a>
    <a href="#/escolas">Escolas</a>
</div>

<!-- src/components/Sidebar.svelte -->
<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 200px;
        height: 100vh;
        background-color: #2d2d2d;
        color: white;
        padding: 1rem;
        display: flex;
        flex-direction: column;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        margin: 0.5rem 0;
    }

    .sidebar a:hover {
        text-decoration: underline;
    }
</style>
