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
    <div class="h-screen bg-neutral-100 grid place-items-center">
        <div
            class="size-full sm:h-fit sm:max-w-md bg-neutral-50 sm:rounded-lg sm:shadow-lg divide-y"
        >
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Welcome Back!</h2>
                <h3 class="opacity-50">
                    Please log in to access your account.
                </h3>
            </div>
            <form
                @submit.prevent="form.post('/login')"
                class="p-4 space-y-4 sm:p-8 sm:space-y-8"
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
                            'p-4 border w-full rounded-lg',
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
                            'p-4 border w-full rounded-lg',
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
                        class="bg-cyan-500 hover:bg-cyan-600 rounded-lg p-4"
                        :disabled="form.processing"
                    >
                        <span class="text-neutral-50 font-medium">LOGIN</span>
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
