<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    task: Object,
});

const more = ref(false);

const handleStatus = (status) => {
    router.put(`/tasks/${props.task.id}`, {
        ...props.task,
        status: status,
    });
};
</script>

<template>
    <div class="h-full grid place-items-center">
        <div
            :class="[
                'bg-neutral-50 rounded-lg w-full max-w-screen-sm p-4 border space-y-4 shadow',
                task.status === 'pending'
                    ? 'border-yellow-500'
                    : task.status === 'in-progress'
                    ? 'border-blue-500'
                    : 'border-green-500',
            ]"
        >
            <div class="flex justify-between items-center gap-4">
                <h2 class="text-2xl">{{ task.title }}</h2>
                <div class="relative">
                    <button @click="more = !more">
                        <i class="material-symbols-rounded"> more_horiz </i>
                    </button>
                    <ul
                        v-if="more"
                        class="absolute right-0 bg-neutral-50 rounded shadow z-[1]"
                    >
                        <li>
                            <Link
                                :href="`/tasks/${task.id}/edit`"
                                class="flex items-center gap-4 py-2 px-4"
                            >
                                <i class="material-symbols-rounded">
                                    edit_square
                                </i>
                                <span>Edit</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                as="BUTTON"
                                method="DELETE"
                                :href="`/tasks/${task.id}`"
                                class="flex items-center gap-4 py-2 px-4"
                            >
                                <i class="material-symbols-rounded"> delete </i>
                                <span>Delete</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="opacity-50">{{ task.description }}</p>
            <div class="flex gap-4">
                <button
                    @click="() => handleStatus('pending')"
                    :class="[
                        'px-4 rounded py-2 capitalize',
                        task.status === 'pending'
                            ? 'bg-yellow-500 text-neutral-50'
                            : 'bg-neutral-200 opacity-50',
                    ]"
                >
                    Pending
                </button>
                <button
                    @click="() => handleStatus('in-progress')"
                    :class="[
                        'px-4 rounded py-2 capitalize',
                        task.status === 'in-progress'
                            ? 'bg-blue-500 text-neutral-50'
                            : 'bg-neutral-200 opacity-50',
                    ]"
                >
                    In Progress
                </button>

                <button
                    @click="() => handleStatus('completed')"
                    :class="[
                        'px-4 rounded py-2 capitalize',
                        task.status === 'completed'
                            ? 'bg-green-500 text-neutral-50'
                            : 'bg-neutral-200 opacity-50',
                    ]"
                >
                    Completed
                </button>
            </div>
        </div>
    </div>
</template>
