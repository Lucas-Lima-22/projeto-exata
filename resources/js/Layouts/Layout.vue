<script setup>
import { ref, watch, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import Toast from "@/Components/Toast.vue";

const user = computed(() => usePage().props.auth.user);
const component = computed(() => usePage().component);
const menu = ref(false);

watch(component, () => {
    if (menu.value) menu.value = false;
});
</script>

<template>
    <header class="bg-neutral-900 text-neutral-50">
        <nav class="flex items-center justify-between">
            <Link href="/" class="p-4 font-medium">Projeto Exata</Link>
            <div class="relative bg-neutral-800 p-4">
                <button @click="menu = !menu">
                    <i class="fa-solid fa-circle-user fa-2xl" />
                </button>
                <div v-if="menu" class="absolute right-0 top-14">
                    <Link href="/" class="group flex">
                        <div
                            class="bg-neutral-900 p-4 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-house fa-lg" />
                        </div>
                        <div
                            class="flex-1 bg-neutral-800 p-4 font-medium group-hover:bg-neutral-900"
                        >
                            HOME
                        </div>
                    </Link>
                    <Link
                        v-if="user.profile === 'admin'"
                        href="/admin"
                        class="group flex"
                    >
                        <div
                            class="bg-neutral-900 p-4 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-list fa-lg" />
                        </div>
                        <div
                            class="flex-1 bg-neutral-800 p-4 font-medium group-hover:bg-neutral-900"
                        >
                            ADMIN
                        </div>
                    </Link>
                    <Link :href="`/users/${user.id}/edit`" class="group flex">
                        <div
                            class="bg-neutral-900 p-4 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-gear fa-lg" />
                        </div>
                        <div
                            class="flex-1 bg-neutral-800 p-4 font-medium group-hover:bg-neutral-900"
                        >
                            SETTINGS
                        </div>
                    </Link>
                    <Link
                        as="BUTTON"
                        method="DELETE"
                        href="/logout"
                        class="group flex w-full text-start"
                    >
                        <div
                            class="bg-neutral-900 p-4 group-hover:bg-neutral-950"
                        >
                            <i class="fa-solid fa-right-from-bracket fa-lg" />
                        </div>
                        <div
                            class="flex-1 whitespace-nowrap bg-neutral-800 p-4 font-medium group-hover:bg-neutral-900"
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

    <footer class="bg-neutral-900 p-4">
        <p class="text-center text-neutral-50">
            © 2024. Developed by Lucas Lima. For demonstration purposes.
        </p>
    </footer>

    <Toast
        v-if="$page.props.flash.message"
        :message="$page.props.flash.message"
    />
</template>
