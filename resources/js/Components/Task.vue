<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    task: Object,
});
</script>

<template>
    <Link
        :href="`/tasks/${task.id}`"
        class="bg-neutral-50 p-4 space-y-4 rounded-lg border flex flex-col hover:shadow-lg"
    >
        <h2 class="text-2xl">{{ task.title }}</h2>

        <p class="opacity-50 line-clamp-3 flex-1">
            {{ task.description }}
        </p>

        <div class="flex justify-between items-end">
            <div class="space-x-2 opacity-50">
                <i class="fa-regular fa-calendar fa-sm" />
                <span class="text-sm">
                    {{ task.created_at }}
                </span>
            </div>

            <div
                :class="[
                    'rounded px-2 py-1 text-xs text-neutral-50 capitalize',
                    task.status === 'pending'
                        ? 'bg-yellow-500'
                        : task.status === 'in-progress'
                        ? 'bg-blue-500'
                        : 'bg-green-500',
                ]"
            >
                {{ task.status.replace("-", " ") }}
            </div>
        </div>
    </Link>
</template>
