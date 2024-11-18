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
    <Head>
        <title>Settings</title>
    </Head>
    <div class="grid h-screen place-items-center bg-neutral-100">
        <div
            class="w-full divide-y rounded-lg bg-neutral-50 shadow-lg sm:max-w-md"
        >
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Manage Account</h2>
                <h3 class="opacity-50">
                    Update your details or delete your profile.
                </h3>
            </div>
            <form
                @submit.prevent="
                    form.transform((data) => ({
                        ...data,
                        password: data.password?.length
                            ? data.password
                            : undefined,
                    })).put(`/users/${user.id}`)
                "
                class="space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="profile" class="text-sm font-medium">
                            PROFILE
                        </label>
                        <small class="text-xs text-red-500">
                            {{ form.errors.profile }}
                        </small>
                    </div>
                    <select
                        id="profile"
                        :class="[
                            'w-full rounded-lg border p-4',
                            { 'border-red-500': form.errors.profile },
                        ]"
                        v-model="form.profile"
                        @change="form.clearErrors('profile')"
                        required
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
                        <label
                            for="current_password"
                            class="text-sm font-medium"
                        >
                            PASSWORD
                        </label>
                        <small class="text-xs text-red-500">
                            {{ form.errors.current_password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        id="current_password"
                        :class="[
                            'w-full rounded-lg border p-4',
                            { 'border-red-500': form.errors.current_password },
                        ]"
                        placeholder="Enter your current password"
                        v-model="form.current_password"
                        @change="form.clearErrors('current_password')"
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
                        :class="[
                            'w-full rounded-lg border p-4',
                            { 'border-red-500': form.errors.password },
                        ]"
                        placeholder="Create a new password"
                        v-model="form.password"
                        @change="form.clearErrors('password')"
                    />
                    <small class="opacity-50">
                        Leave blank if you don't want to change.
                    </small>
                </div>

                <div class="flex flex-col gap-4">
                    <button
                        type="submit"
                        class="rounded-lg bg-cyan-500 p-4 hover:bg-cyan-600"
                        :disabled="form.processing"
                    >
                        <span class="font-medium text-neutral-50">
                            UPDATE
                        </span>
                    </button>
                    <Link
                        href="/"
                        class="rounded-lg bg-neutral-300 p-4 text-center hover:bg-neutral-400"
                    >
                        <span class="font-medium">CANCEL</span>
                    </Link>
                </div>

                <div
                    class="rounded-lg border border-red-500 bg-red-100 p-4 text-red-500"
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
    </div>
</template>
