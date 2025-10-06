<script>
    import { onMount } from "svelte";
    import { getEscolasBairros, deletarEscola } from "./api/Escolas.js";

    let id = 'width'
    let escolas = [];
    let loading = true;
    let error = null;

    onMount(async () => {
        await carregarEscolas();
    });

    async function carregarEscolas() {
        try {
            loading = true;
            escolas = await getEscolasBairros();
        } catch (err) {
            error = err.message;
        } finally {
            loading = false;
        }
    }

    async function apagarEscola(id) {
        const confirmar = confirm("Deseja apagar esta escola?");
        if (!confirmar) return;

        try {
            await deletarEscola(id);
            escolas = escolas.filter((e) => e.id !== id);
        } catch (err) {
            alert(err.message);
        }
    }
</script>

<main>

    <h1>Escolas:</h1>
    <!-- Exibição -->
    {#if loading}
        <p>Carregando dados...</p>
    {:else if error}
        <p style="color: red;">{error}</p>
    {:else}
        <div class="container">
            <table class="table">
                <thead>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Bairro</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    {#each escolas as escola}
                        <tr>
                            <td style="width: 20px;">{escola.id}</td>
                            <td {id}>{escola.nome}</td>
                            <td {id}>{escola.bairro}</td>
                            <button
                                class="btn btn-danger btn-sm"
                                on:click={() => apagarEscola(escola.id)}
                                >Apagar</button
                            >
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    {/if}
</main>

<style>
    #width{
        width: 300px;
    }
</style>