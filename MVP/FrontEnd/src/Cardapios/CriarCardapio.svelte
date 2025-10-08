<script>
  import { CriarCardapio } from "../api/Cardapios";
  // Dados do formulário
  let nome = "";
  let item = "";
  let data = "";

  let mensagem = "";
  let carregando = false;

  async function enviarFormulario(e) {
    e.preventDefault();
    mensagem = "";
    carregando = true;

    try {
      // Chamando a função centralizada da API
      const novoCardapio = await CriarCardapio({ nome, item, data });
      console.log("Cardápio criado:", novoCardapio);

      mensagem = "✅ Cardápio criado com sucesso!";
      nome = "";
      item = "";
      data = "";
    } catch (erro) {
      console.error("Erro ao criar cardápio:", erro);
      mensagem = "❌ Erro ao criar cardápio. Verifique o console.";
    } finally {
      carregando = false;
    }
  }
</script>

<!-- Bootstrap CSS -->
<svelte:head>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
</svelte:head>

<div class="container mt-5">
  <div class="row justify-content-left">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">🍽️ Novo Cardápio</h3>

          <form on:submit={enviarFormulario}>
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Cardápio</label>
              <input
                type="text"
                class="form-control"
                id="nome"
                bind:value={nome}
                placeholder="Ex: Almoço de Segunda"
                required
              />
            </div>

            <div class="mb-3">
              <label for="item" class="form-label">Item</label>
              <input
                type="text"
                class="form-control"
                id="item"
                bind:value={item}
                placeholder="Ex: Arroz, Feijão, Frango"
                required
              />
            </div>

            <div class="mb-3">
              <label for="data" class="form-label">Data</label>
              <input
                type="date"
                class="form-control"
                id="data"
                bind:value={data}
                required
              />
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success" disabled={carregando}>
                {carregando ? "Enviando..." : "Criar Cardápio"}
              </button>
            </div>
          </form>

          {#if mensagem}
            <div
              class="alert mt-4 {mensagem.startsWith('✅') ? 'alert-success' : 'alert-danger'}"
              role="alert"
            >
              {mensagem}
            </div>
          {/if}
        </div>
      </div>
    </div>
  </div>
</div>
