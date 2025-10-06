<script>
  import { onMount } from "svelte";
  import { getCidades, deletarCidadeAPI } from "./api/Cidades.js";

  let cidades = [];
  let loading = true;
  let error = null;

  onMount(async () => {
    await carregarCidades();
  });

  async function carregarCidades() {
    try {
      loading = true;
      cidades = await getCidades();
    } catch (err) {
      error = err.message;
    } finally {
      loading = false;
    }
  }

  async function deletarCidade(id) {
    const confirmar = confirm("Tem certeza que deseja apagar esta cidade?");
    if (!confirmar) return;

    try {
      await deletarCidadeAPI(id);
      cidades = cidades.filter(c => c.id !== id);
    } catch (err) {
      alert(err.message);
    }
  }
</script>

<main>
<h1>Cidades:</h1>
	<!-- Exibição -->
	{#if loading}
		<p>Carregando dados...</p>
	{:else if error}
		<p style="color: red;">{error}</p>
	{:else}
    <div class="container">
        <table class="table">
            <thead>
                <td id="id">Cod Ibge</td>
                <td>Nome</td>
                <td>UF</td>
                <td>Opções</td>
            </thead>
            <tbody>
			    {#each cidades as cidade}

                    <tr>
                        <td>{cidade.codIbge}</td>
                        <td class="text-start">{cidade.nome}</td>
                        <td>{cidade.uf}</td>
                        <button class="btn btn-danger btn-sm" on:click={() => deletarCidade(cidade.id)}>Apagar</button>
                    </tr>
			    {/each}
            </tbody>
        </table>
    </div>
	{/if}
</main>

<style>

    #id{
        width: 40px;
    }

</style>
