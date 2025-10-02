<script>
	import Sidebar from "./components/Sidebar.svelte";

	import { onMount } from "svelte";

	// Lista que receberá os dados da API
	let escolas = [];
	let loading = true;
	let error = null;

	// Função chamada quando o componente "monta" na tela
	onMount(async () => {
		try {
			const response = await fetch("http://127.0.0.1:8000/api/escolas");
			if (!response.ok) {
				throw new Error("Erro ao buscar dados");
			}

			const json = await response.json();
			escolas = json.data; // Salva o JSON na variável reativa
		} catch (err) {
			error = err.message;
		} finally {
			loading = false;
		}
	});
</script>

<Sidebar />
<main>
    <h1>Escolas</h1>
	<!-- Exibição -->
	{#if loading}
		<p>Carregando dados...</p>
	{:else if error}
		<p style="color: red;">{error}</p>
	{:else}
		<ul>
			{#each escolas as escola}
				<li>
					<strong>{escola.nome}</strong>
				</li>
			{/each}
		</ul>
	{/if}
</main>

<style>
	main {
		text-align: left;
		padding: 1em;
		max-width: 240px;
		margin-left: 220px;
	}
</style>
