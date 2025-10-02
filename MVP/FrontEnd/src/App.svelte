<script>
	import Sidebar from "./components/Sidebar.svelte";

	import Router from "svelte-spa-router";
	import { routes } from "./routes.js";
</script>

<Sidebar />

<Router {routes} />
