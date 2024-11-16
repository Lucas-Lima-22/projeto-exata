<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    profile: "guest",
    email: null,
    password: null,
});
</script>

<template>
    <div class="h-screen bg-neutral-100 grid place-items-center">
        <form
            @submit.prevent="form.post('/register')"
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
                    <label for="password" class="text-sm font-medium">
                        PASSWORD
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
                    placeholder="Enter your password"
                    required
                />
                <small class="opacity-50">
                    The password must be at least 6 characters.
                </small>
            </div>

            <div class="space-y-4">
                <button
                    type="submit"
                    class="bg-blue-500 text-neutral-50 font-medium w-full py-4 rounded"
                >
                    REGISTER
                </button>
                <p class="text-center">
                    Already have an account?
                    <Link href="/login" class="text-blue-500">Login</Link>
                </p>
            </div>
        </form>
    </div>
</template>
