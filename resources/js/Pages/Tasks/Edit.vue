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
    <Head>
        <title>Edit Task</title>
    </Head>
    <div class="h-full grid place-items-center">
        <div
            class="w-full sm:max-w-md bg-neutral-50 rounded-lg shadow-lg divide-y"
        >
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
                    <div class="flex justify-between">
                        <label for="title" class="text-sm font-medium">
                            TITLE
                        </label>
                        <small class="text-sm text-red-500">
                            {{ form.errors.title }}
                        </small>
                    </div>
                    <input
                        type="text"
                        id="title"
                        :class="[
                            'p-4 border w-full rounded-lg',
                            { 'border-red-500': form.errors.title },
                        ]"
                        placeholder="Enter a title"
                        v-model="form.title"
                        @change="form.clearErrors('title')"
                        required
                    />
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="description" class="text-sm font-medium">
                            DESCRIPTION
                        </label>
                        <small class="text-sm text-red-500">
                            {{ form.errors.description }}
                        </small>
                    </div>
                    <textarea
                        id="description"
                        :class="[
                            'p-4 border w-full rounded-lg resize-none',
                            { 'border-red-500': form.errors.description },
                        ]"
                        rows="5"
                        minlength="1"
                        maxlength="200"
                        placeholder="Enter a description"
                        v-model="form.description"
                        @change="form.clearErrors('description')"
                        required
                    />
                    <small class="opacity-50">
                        {{ form.description?.length ?? 0 }}/200
                    </small>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="status" class="text-sm font-medium">
                            STATUS
                        </label>
                        <small class="text-sm text-red-500">
                            {{ form.errors.status }}
                        </small>
                    </div>
                    <select
                        name="status"
                        id="status"
                        :class="[
                            'p-4 border w-full rounded-lg',
                            { 'border-red-500': form.errors.status },
                        ]"
                        v-model="form.status"
                        @change="form.clearErrors('status')"
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
                        class="bg-cyan-500 hover:bg-cyan-600 rounded-lg p-4"
                        :disabled="form.processing"
                    >
                        <span class="text-neutral-50 font-medium">UPDATE</span>
                    </button>
                    <Link
                        :href="`/tasks/${task.id}`"
                        class="bg-neutral-300 hover:bg-neutral-400 rounded-lg p-4 text-center"
                    >
                        <span class="font-medium">CANCEL</span>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
