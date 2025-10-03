<script>
    import { onMount } from "svelte";
    import { getBairros, deletarBairro } from "./api/Bairros.js";

    let id = "width";
    let bairros = [];
    let loading = true;
    let error = null;

    onMount(async () => {
        await carregarBairros();
    });

    async function carregarBairros() {
        try {
            loading = true;
            bairros = await getBairros();
        } catch (err) {
            error = err.message;
        } finally {
            loading = false;
        }
    }

    async function apagarBairro(id) {
        const confirmar = confirm("Tem certeza que deseja apagar este bairro?");
        if (!confirmar) return;

        try {
            await deletarBairro(id);
            bairros = bairros.filter((c) => c.id !== id);
        } catch (err) {
            alert(err.message);
        }
    }
</script>

<main>
    <h1>Bairros:</h1>
    <!-- Exibição -->
    {#if loading}
        <p>Carregando dados...</p>
    {:else if error}
        <p style="color: red;">{error}</p>
    {:else}
        <div class="container">
            <table class="table">
                <thead>
                    <td id="id">Id</td>
                    <td {id}>Bairro</td>
                    <td {id}>Cidade</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    {#each bairros as bairro}
                        <tr>
                            <td>{bairro.id}</td>
                            <td class="text-start">{bairro.nome}</td>
                            <td>{bairro.cidade}</td>
                            <button
                                class="btn btn-danger btn-sm"
                                on:click={() => apagarBairro(bairro.id)}
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

    #id{
        width: 20px;
    }
    #width {
        width: 300px;
    }
</style>
