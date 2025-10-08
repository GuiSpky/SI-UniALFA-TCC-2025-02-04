// src/api/bairros.js

const API_URL = "http://127.0.0.1:8000/api/cardapios";

/**
 * Busca todas as escolas com seus bairros
 */
export async function getCardapios() {
  const response = await fetch(API_URL);
  if (!response.ok) {
    throw new Error("Erro ao buscar cardapios");
  }

  const json = await response.json();
  return json.data; // retorna apenas o array de escolas
}

/**
 * Deleta uma escola pelo ID
 * @param {number} id
 */
export async function deletarCardapio(id) {
  const response = await fetch(`${API_URL}/${id}`, {
    method: "DELETE",
  });

  if (!response.ok) {
    throw new Error("Erro ao apagar o cardapio");
  }

  return true;
}

export async function CriarCardapio(params) {
  const response = await fetch(API_URL, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(params),
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error("Erro da API:", errorText);
    throw new Error("Erro ao criar cardápio");
  }

  const json = await response.json();
  return json;
}

