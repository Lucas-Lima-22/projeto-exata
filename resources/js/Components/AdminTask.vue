<script setup>
import { Link } from "@inertiajs/vue3";
import StatusTag from "@/Components/StatusTag.vue";

defineProps({
    task: Object,
});
</script>

<template>
    <div
        id="grid"
        class="w-fit min-w-full rounded-lg border bg-neutral-50 px-8 py-2"
    >
        <span class="text-xl opacity-50"> {{ task.id }} </span>

        <div class="min-w-96">
            <h2 class="truncate text-xl">{{ task.title }}</h2>
            <p class="truncate opacity-50">
                {{ task.description }}
            </p>
        </div>

        <div class="space-x-2 whitespace-nowrap opacity-50">
            <i class="fa-regular fa-calendar fa-sm" />
            <span class="text-sm">
                {{ task.created_at }}
            </span>
        </div>

        <StatusTag :tag="task.status" />

        <div class="flex gap-4">
            <Link
                :href="`/tasks/${task.id}`"
                class="opacity-50 hover:opacity-100"
            >
                <i class="fa-solid fa-arrow-up-right-from-square" />
            </Link>
            <Link
                :href="`/tasks/${task.id}/edit`"
                class="opacity-50 hover:opacity-100"
            >
                <i class="fa-solid fa-pen-to-square" />
            </Link>
            <Link
                as="BUTTON"
                method="DELETE"
                :href="`/tasks/${task.id}`"
                class="opacity-50 hover:opacity-100"
            >
                <i class="fa-solid fa-trash" />
            </Link>
        </div>
    </div>
</template>
<style scoped>
#grid {
    display: grid;
    grid-template-columns: min-content 1fr min-content min-content min-content;
    align-items: center;
    gap: 2rem;
}
</style>
