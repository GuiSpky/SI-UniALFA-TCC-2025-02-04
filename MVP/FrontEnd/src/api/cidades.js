// src/api/cidades.js

const API_URL = "http://127.0.0.1:8000/api/cidades";

export async function getCidades() {
  const response = await fetch(API_URL);
  if (!response.ok) throw new Error("Erro ao buscar cidades");
  const data = await response.json();
  return data.data;
}

export async function deletarCidadeAPI(id) {
  const response = await fetch(`${API_URL}/${id}`, { method: "DELETE" });
  if (!response.ok) throw new Error("Erro ao apagar a cidade");
  return true;
}
