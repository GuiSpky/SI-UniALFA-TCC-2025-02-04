<script>
	import Sidebar from "./components/Sidebar.svelte";

	import Router from "svelte-spa-router";
	import { routes } from "./routes.js";
</script>


<main>
	<Sidebar />
<div class="container-fluid p-3" style="margin-left: 200px;">
	<Router {routes} />
</div>
</main>

<style>
	main {
		margin: 0;
		padding: 0;
		overflow-x: hidden;
		width: 100%;
	}
</style>
