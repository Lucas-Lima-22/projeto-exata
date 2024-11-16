<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
});

const form = useForm({
    profile: props.user.profile,
    email: props.user.email,
    current_password: null,
    password: undefined,
});
</script>

<template>
    <div class="h-screen bg-neutral-100 grid place-items-center">
        <form
            @submit.prevent="
                form.transform((data) => ({
                    ...data,
                    password: data.password?.length ? data.password : undefined,
                })).put(`/users/${user.id}`)
            "
            class="w-full max-w-md bg-neutral-50 rounded-lg shadow-lg border p-8 space-y-8"
        >
            <div class="space-y-2">
                <div class="flex justify-between">
                    <label for="profile" class="text-sm font-medium">
                        PROFILE
                    </label>
                    <small class="text-red-500">
                        {{ form.errors.profile }}
                    </small>
                </div>
                <select
                    id="profile"
                    class="w-full p-4 border rounded"
                    v-model="form.profile"
                >
                    <option value="guest">Guest</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between">
                    <label for="email" class="text-sm font-medium">
                        EMAIL
                    </label>
                    <small class="text-red-500">
                        {{ form.errors.email }}
                    </small>
                </div>
                <input
                    type="email"
                    id="email"
                    class="p-4 border w-full"
                    v-model="form.email"
                    placeholder="Enter your email"
                    required
                />
            </div>

            <div class="space-y-2">
                <div class="flex justify-between">
                    <label for="current_password" class="text-sm font-medium">
                        PASSWORD
                    </label>
                    <small class="text-red-500">
                        {{ form.errors.current_password }}
                    </small>
                </div>
                <input
                    type="password"
                    id="current_password"
                    class="p-4 border w-full"
                    v-model="form.current_password"
                    placeholder="Enter your current password"
                    required
                />
            </div>

            <div class="space-y-2">
                <div class="flex justify-between">
                    <label for="password" class="text-sm font-medium">
                        NEW PASSWORD
                    </label>
                    <small class="text-red-500">
                        {{ form.errors.password }}
                    </small>
                </div>
                <input
                    type="password"
                    id="password"
                    class="p-4 border w-full"
                    v-model="form.password"
                    placeholder="Create a new password"
                />
                <small class="opacity-50">
                    Leave blank if you don't want to change the password.
                </small>
            </div>

            <div class="space-y-4 text-neutral-50 font-medium">
                <button type="submit" class="bg-blue-500 w-full py-4 rounded">
                    UPDATE
                </button>
                <Link
                    href="/"
                    class="block rounded text-center bg-neutral-500 py-4"
                >
                    CANCEL
                </Link>
            </div>
            <div
                class="rounded-box border border-red-500 bg-red-100 p-4 text-red-500"
            >
                <p>If you wish to permanently remove your account:</p>
                <Link
                    as="BUTTON"
                    method="DELETE"
                    :href="`/users/${user.id}`"
                    class="font-medium"
                >
                    Delete Account
                </Link>
            </div>
        </form>
    </div>
</template>
