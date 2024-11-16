<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    task: Object,
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    status: props.task.status,
});
</script>

<template>
    <div class="h-full grid place-items-center">
        <div class="w-full max-w-md bg-neutral-50 rounded border divide-y">
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Edit Task</h2>
                <h3 class="opacity-50">
                    Update the details to modify your task.
                </h3>
            </div>
            <form
                @submit.prevent="form.put(`/tasks/${task.id}`)"
                class="p-4 space-y-4 sm:p-8 sm:space-y-8"
            >
                <div class="space-y-2">
                    <label for="title" class="text-sm font-medium">TITLE</label>
                    <input
                        type="text"
                        id="title"
                        class="p-4 border w-full"
                        placeholder="Enter a title"
                        v-model="form.title"
                        required
                    />
                </div>
                <div class="space-y-2">
                    <label for="description" class="text-sm font-medium">
                        DESCRIPTION
                    </label>
                    <textarea
                        id="description"
                        class="p-4 w-full border resize-none"
                        rows="5"
                        minlength="1"
                        maxlength="200"
                        placeholder="Enter a description"
                        v-model="form.description"
                        required
                    />
                </div>
                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium block">
                        STATUS
                    </label>
                    <select
                        name="status"
                        id="status"
                        class="w-full p-4 border"
                        v-model="form.status"
                        required
                    >
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="flex flex-col gap-4">
                    <button
                        type="submit"
                        class="text-neutral-50 rounded flex overflow-hidden group"
                    >
                        <div
                            class="flex-1 p-4 bg-blue-500 group-hover:bg-blue-600"
                        >
                            <span class="font-medium">UPDATE</span>
                        </div>
                        <div class="p-4 bg-blue-600 group-hover:bg-blue-700">
                            <i class="fa-solid fa-check" />
                        </div>
                    </button>
                    <Link
                        :href="`/tasks/${task.id}`"
                        class="rounded flex overflow-hidden group"
                    >
                        <div
                            class="flex-1 p-4 bg-neutral-200 group-hover:bg-neutral-300 text-center"
                        >
                            <span class="font-medium">CANCEL</span>
                        </div>
                        <div
                            class="p-4 bg-neutral-300 group-hover:bg-neutral-400"
                        >
                            <i class="fa-solid fa-xmark" />
                        </div>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
