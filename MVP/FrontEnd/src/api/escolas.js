// src/api/escolas.js

const API_URL = "http://127.0.0.1:8000/api/escolas";

/**
 * Busca todas as escolas com seus bairros
 */
export async function getEscolas() {
  const response = await fetch(API_URL);
  if (!response.ok) {
    throw new Error("Erro ao buscar escolas");
  }

  const json = await response.json();
  return json.data; // retorna apenas o array de escolas
}

/**
 * Deleta uma escola pelo ID
 * @param {number} id
 */
export async function deletarEscola(id) {
  const response = await fetch(`${API_URL}/${id}`, {
    method: "DELETE",
  });

  if (!response.ok) {
    throw new Error("Erro ao apagar a escola");
  }

  return true;
}
