<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    description: null,
    status: "pending",
});
</script>

<template>
    <div class="h-full grid place-items-center">
        <h1 class="text-2xl">Create a new task</h1>
        <form
            @submit.prevent="form.post('/tasks')"
            class="w-full max-w-screen-sm bg-neutral-50 rounded border p-8 space-y-8"
        >
            <div class="space-y-2">
                <label for="title" class="text-sm font-medium">TITLE</label>
                <input
                    type="text"
                    id="title"
                    class="p-4 border w-full"
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
                    cols="30"
                    rows="10"
                    class="p-4 w-full border"
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
                    class="p-4 border"
                    v-model="form.status"
                    required
                >
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="flex justify-end gap-4">
                <Link
                    href="/"
                    class="bg-neutral-500 text-neutral-50 px-4 py-2 rounded font-medium"
                >
                    CANCEL
                </Link>
                <button
                    type="submit"
                    class="bg-blue-500 text-neutral-50 px-4 py-2 rounded font-medium"
                >
                    CREATE
                </button>
            </div>
        </form>
    </div>
</template>
