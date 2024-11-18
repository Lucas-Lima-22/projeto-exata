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
    <Head>
        <title>{{ task.title }}</title>
    </Head>
    <div class="grid h-full place-items-center">
        <div
            class="w-full max-w-md space-y-8 rounded-lg border bg-neutral-50 p-8 shadow-lg"
        >
            <div class="flex items-start justify-between gap-4">
                <h2 class="text-2xl">{{ task.title }}</h2>

                <div class="relative">
                    <button @click="more = !more">
                        <i class="fa-solid fa-ellipsis fa-lg" />
                    </button>
                    <div
                        v-if="more"
                        class="absolute right-0 z-[1] divide-y rounded-lg border bg-neutral-100 shadow-lg"
                    >
                        <Link
                            :href="`/tasks/${task.id}/edit`"
                            class="flex items-center gap-4 p-4 px-6 opacity-50 hover:opacity-100"
                        >
                            <i class="fa-solid fa-pen-to-square" />
                            <span class="font-medium">EDIT</span>
                        </Link>

                        <Link
                            as="BUTTON"
                            method="DELETE"
                            :href="`/tasks/${task.id}`"
                            class="flex items-center gap-4 p-4 px-6 opacity-50 hover:opacity-100"
                        >
                            <i class="fa-solid fa-trash" />
                            <span class="font-medium">DELETE</span>
                        </Link>
                    </div>
                </div>
            </div>

            <p class="opacity-50">{{ task.description }}</p>

            <div class="flex items-end justify-between">
                <div class="space-x-2 opacity-50">
                    <i class="fa-regular fa-calendar fa-sm" />
                    <span class="text-sm">
                        {{ task.created_at }}
                    </span>
                </div>
                <div class="flex gap-4">
                    <button
                        @click="() => handleStatus('pending')"
                        :class="[
                            'w-20 rounded px-2 py-1 text-xs',
                            task.status === 'pending'
                                ? 'pointer-events-none bg-yellow-500 text-neutral-50'
                                : 'bg-neutral-200 opacity-50 hover:opacity-100',
                        ]"
                        :disabled="task.status === 'pending'"
                    >
                        Pending
                    </button>
                    <button
                        @click="() => handleStatus('in-progress')"
                        :class="[
                            'w-20 rounded px-2 py-1 text-xs',
                            task.status === 'in-progress'
                                ? 'pointer-events-none bg-blue-500 text-neutral-50'
                                : 'bg-neutral-200 opacity-50 hover:opacity-100',
                        ]"
                        :disabled="task.status === 'in-progress'"
                    >
                        In Progress
                    </button>
                    <button
                        @click="() => handleStatus('completed')"
                        :class="[
                            'w-20 rounded px-2 py-1 text-xs',
                            task.status === 'completed'
                                ? 'pointer-events-none bg-green-500 text-neutral-50'
                                : 'bg-neutral-200 opacity-50 hover:opacity-100',
                        ]"
                        :disabled="task.status === 'completed'"
                    >
                        Completed
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
