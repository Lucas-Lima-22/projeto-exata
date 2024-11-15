<script setup>
import { computed, onMounted, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    tasks: Object,
});

const pending = computed(() =>
    props.tasks.filter((task) => task.status === "pending"),
);
const inProgress = computed(() =>
    props.tasks.filter((task) => task.status === "in-progress"),
);
const completed = computed(() =>
    props.tasks.filter((task) => task.status === "completed"),
);

const handleStatus = (status) => {
    router.put(`/tasks/${selectedTask.value.id}`, {
        status: status,
    });
    selectedTask.value = null;
};
const more = ref(false);
const selectedTask = ref(null);
</script>
<template>
    <div class="h-full">
        <div class="max-w-screen-lg mx-auto space-y-4">
            <div class="flex justify-between items-center">
                <Link
                    href="/tasks/create"
                    class="bg-blue-500 inline-flex gap-2 py-2 px-4 rounded"
                >
                    <span class="material-symbols-rounded"> add </span>
                    <span>Add Task</span>
                </Link>
                <div class="flex gap-4">
                    <select name="" id="">
                        <option value="1">STATUS</option>
                    </select>
                    <select name="" id="">
                        <option value="1">Order By</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <Link
                    v-for="task in tasks"
                    :href="`/tasks/${task.id}`"
                    :key="task.id"
                    :class="[
                        'bg-neutral-50 p-4 space-y-4 rounded-lg border flex flex-col',
                        task.status === 'pending'
                            ? 'border-yellow-500'
                            : task.status === 'in-progress'
                            ? 'border-blue-500'
                            : 'border-green-500',
                    ]"
                >
                    <h2 class="text-2xl">{{ task.title }}</h2>
                    <p class="opacity-50 line-clamp-3 flex-1">
                        {{ task.description }}
                    </p>
                    <div class="flex justify-between">
                        <span>
                            {{ task.created_at }}
                        </span>
                        <span
                            :class="[
                                'px-2 rounded py-1 text-xs capitalize',
                                task.status === 'pending'
                                    ? 'bg-yellow-500'
                                    : task.status === 'in-progress'
                                    ? 'bg-blue-500 text-neutral-50'
                                    : 'bg-green-500 text-neutral-50',
                            ]"
                        >
                            {{ task.status }}
                        </span>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
