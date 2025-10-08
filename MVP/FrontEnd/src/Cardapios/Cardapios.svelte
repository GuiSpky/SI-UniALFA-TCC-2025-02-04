<script>
    import { onMount } from "svelte";
    import { getCardapios, deletarCardapio } from "../api/Cardapios";

    let id = "width";
    let cardapios = [];
    let loading = true;
    let error = null;

    onMount(async () => {
        await carregarCardapios();
    });

    async function carregarCardapios() {
        try {
            loading = true;
            cardapios = await getCardapios();
        } catch (err) {
            error = err.message;
        } finally {
            loading = false;
        }
    }

    async function apagarCardapio(id) {
        const confirmar = confirm("Tem certeza que deseja apagar este Cardapio?");
        if (!confirmar) return;

        try {
            await deletarCardapio(id);
            cardapios = cardapios.filter((c) => c.id !== id);
        } catch (err) {
            alert(err.message);
        }
    }
</script>

<main>
    <h1>Cardapios:</h1>
    <div>
        <a href="#/cardapio/criar" class="btn btn-primary bl bl-plus">Adicionar</a>
    </div>
    {#if loading}
        <p>Carregando dados...</p>
    {:else if error}
        <p style="color: red;">{error}</p>
    {:else}
        <div class="container">
            <table class="table">
                <thead>
                    <td id="id">Id</td>
                    <td {id}>Nome</td>
                    <td {id}>Item</td>
                    <td {id}>Data</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    {#each cardapios as cardapio}
                        <tr>
                            <td>{cardapio.id}</td>
                            <td class="text-start">{cardapio.nome}</td>
                            <td>{cardapio.item}</td>
                            <td>{cardapio.data}</td>
                            <button
                                class="btn btn-danger btn-sm"
                                on:click={() => apagarCardapio(cardapio.id)}
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
