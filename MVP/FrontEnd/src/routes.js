// src/routes.js
import Cidades from './Cidades.svelte'
import Bairros from './Bairros.svelte'
import Escolas from './Escolas.svelte'
import Inicio from './Inicio.svelte'
import Cardapios from './Cardapios/Cardapios.svelte'

export const routes = {
  '/cidades': Cidades,
  '/bairros': Bairros,
  '/escolas': Escolas,
  '/inicio': Inicio,
  '/cardapios': Cardapios,
}
