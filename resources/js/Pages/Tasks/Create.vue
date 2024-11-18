<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    description: null,
    status: "pending",
});
</script>

<template>
    <Head>
        <title>New Task</title>
    </Head>
    <div class="grid h-full place-items-center">
        <div
            class="w-full divide-y rounded-lg bg-neutral-50 shadow-lg sm:max-w-md"
        >
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Create a New Task</h2>
                <h3 class="opacity-50">
                    Fill out the details to add a new task to your list.
                </h3>
            </div>
            <form
                @submit.prevent="form.post('/tasks')"
                class="space-y-4 p-4 sm:space-y-8 sm:p-8"
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
                            'w-full rounded-lg border p-4',
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
                            'w-full resize-none rounded-lg border p-4',
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
                            'w-full rounded-lg border p-4',
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
                        class="rounded-lg bg-cyan-500 p-4 hover:bg-cyan-600"
                        :disabled="form.processing"
                    >
                        <span class="font-medium text-neutral-50">CREATE</span>
                    </button>
                    <Link
                        href="/"
                        class="rounded-lg bg-neutral-300 p-4 text-center hover:bg-neutral-400"
                    >
                        <span class="font-medium">CANCEL</span>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
