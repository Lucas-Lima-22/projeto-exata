<script setup>
import { useForm, Link, usePage } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});
</script>

<template>
    <Head>
        <title>Login</title>
    </Head>
    <div class="grid h-screen place-items-center bg-neutral-100">
        <div
            class="size-full divide-y bg-neutral-50 sm:h-fit sm:max-w-md sm:rounded-lg sm:shadow-lg"
        >
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Welcome Back!</h2>
                <h3 class="opacity-50">
                    Please log in to access your account.
                </h3>
            </div>
            <form
                @submit.prevent="form.post('/login')"
                class="space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="email" class="text-sm font-medium">
                            EMAIL
                        </label>
                        <small class="text-xs text-red-500">
                            {{ form.errors.email }}
                        </small>
                    </div>
                    <input
                        type="text"
                        id="email"
                        :class="[
                            'w-full rounded-lg border p-4',
                            { 'border-red-500': form.errors.email },
                        ]"
                        placeholder="Enter your email"
                        v-model="form.email"
                        @change="form.clearErrors('email')"
                        required
                    />
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="password" class="text-xs font-medium">
                            PASSWORD
                        </label>
                        <small class="text-sm text-red-500">
                            {{ form.errors.password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        id="password"
                        :class="[
                            'w-full rounded-lg border p-4',
                            { 'border-red-500': form.errors.password },
                        ]"
                        placeholder="Enter your password"
                        v-model="form.password"
                        @change="form.clearErrors('password')"
                        required
                    />
                </div>

                <div class="flex flex-col gap-4">
                    <button
                        type="submit"
                        class="rounded-lg bg-cyan-500 p-4 hover:bg-cyan-600"
                        :disabled="form.processing"
                    >
                        <span class="font-medium text-neutral-50">LOGIN</span>
                    </button>
                    <p class="text-center">
                        Don't have an account?
                        <Link
                            href="/register"
                            class="text-cyan-500 hover:text-cyan-600"
                        >
                            Register
                        </Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>
