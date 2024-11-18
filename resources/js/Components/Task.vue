<script setup>
import { Link } from "@inertiajs/vue3";
import StatusTag from "@/Components/StatusTag.vue";

defineProps({
    task: Object,
});
</script>

<template>
    <Link
        :href="`/tasks/${task.id}`"
        class="flex flex-col space-y-4 rounded-lg border bg-neutral-50 p-4 hover:shadow-lg"
    >
        <h2 class="text-2xl">{{ task.title }}</h2>

        <p class="line-clamp-3 flex-1 opacity-50">
            {{ task.description }}
        </p>

        <div class="flex items-end justify-between">
            <div class="space-x-2 opacity-50">
                <i class="fa-regular fa-calendar fa-sm" />
                <span class="text-sm">
                    {{ task.created_at }}
                </span>
            </div>

            <StatusTag :tag="task.status" />
        </div>
    </Link>
</template>
