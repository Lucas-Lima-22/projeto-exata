<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <header class="bg-neutral-800 text-neutral-50 h-10">
        <nav>
            <Link href="/">Projeto Exata</Link>
        </nav>
    </header>
    <main class="bg-neutral-100 p-4">
        <slot />
    </main>
    <footer class="bg-neutral-800 h-10"></footer>
</template>

<style></style>
