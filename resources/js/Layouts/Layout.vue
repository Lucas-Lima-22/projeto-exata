<script setup>
import { ref, watch, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const user = computed(() => usePage().props.auth.user);
const component = computed(() => usePage().component);
const menu = ref(false);

watch(component, () => {
    if (menu.value) menu.value = false;
});
</script>

<template>
    <header class="bg-neutral-900 text-neutral-50">
        <nav class="flex justify-between items-center">
            <Link href="/">Projeto Exata</Link>
            <div class="relative bg-neutral-800 p-4">
                <button @click="menu = !menu">
                    <i class="fa-solid fa-circle-user fa-2xl" />
                </button>
                <div v-if="menu" class="absolute right-0 top-14">
                    <Link :href="`/users/${user.id}/edit`" class="flex group">
                        <div
                            class="p-4 bg-neutral-900 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-pen-to-square fa-lg" />
                        </div>
                        <div
                            class="p-4 whitespace-nowrap bg-neutral-800 group-hover:bg-neutral-900 font-medium flex-1"
                        >
                            EDIT PROFILE
                        </div>
                    </Link>
                    <Link
                        as="BUTTON"
                        method="DELETE"
                        href="/logout"
                        class="flex w-full text-start group"
                    >
                        <div
                            class="p-4 bg-neutral-900 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-right-from-bracket fa-lg" />
                        </div>
                        <div
                            class="p-4 whitespace-nowrap bg-neutral-800 group-hover:bg-neutral-900 font-medium flex-1"
                        >
                            LOGOUT
                        </div>
                    </Link>
                </div>
            </div>
        </nav>
    </header>
    <main class="bg-neutral-100 p-4">
        <slot />
    </main>
    <footer class="bg-neutral-800 h-10"></footer>
</template>

<style></style>
