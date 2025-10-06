<script>
  import { onMount } from 'svelte';

  let totalCidades = 0;
  let totalEscolas = 0;
  let totalBairros = 0;
  let loading = true;
  let error = null;

  onMount(async () => {
    try {
      const [cidadesRes, escolasRes, bairrosRes] = await Promise.all([
        fetch('http://localhost:8000/api/cidades/count'),
        fetch('http://localhost:8000/api/escolas/count'),
        fetch('http://localhost:8000/api/bairros/count')
      ]);

      if (!cidadesRes.ok || !escolasRes.ok || !bairrosRes.ok) {
        throw new Error('Erro ao carregar contagens');
      }

      const cidadesData = await cidadesRes.json();
      const escolasData = await escolasRes.json(); 
      const bairrosData = await bairrosRes.json();

      totalCidades = cidadesData.total;
      totalEscolas = escolasData.total;
      totalBairros = bairrosData.total;
    } catch (err) {
      error = err.message;
    } finally {
      loading = false;
    }
  });
</script>

<style>
  .dashboard {
    display: flex;
    flex-direction: column;
    width: 600px;
    gap: 1rem;
    margin-top: 1rem;
  }

  .card {
    background: #f5f5f5;
    border-radius: 12px;
    width: 100%;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s;
  }

  .card:hover {
    transform: translateY(-4px);
  }

  .card h2 {
    margin: 0;
    font-size: 2rem;
    color: #333;
  }

  .card p {
    margin-top: 0.5rem;
    color: #666;
  }
</style>

<h1>📊 Dashboard</h1>

{#if loading}
  <p>Carregando...</p>
{:else if error}
  <p style="color:red;">Erro: {error}</p>
{:else}
  <div class="dashboard">
    <div class="card">
      <h2>{totalCidades}</h2>
      <p>Cidades cadastradas</p>
    </div>

    <div class="card">
      <h2>{totalEscolas}</h2>
      <p>Escolas cadastradas</p>
    </div>
    <div class="card">
      <h2>{totalBairros}</h2>
      <p>Bairros cadastrados</p>
    </div>
  </div>
{/if}
