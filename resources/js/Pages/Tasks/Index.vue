<script setup>
import { watch, computed } from "vue";
import { useForm, Link, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    tasks: Object,
    query: Array,
});

const pagination = computed(() => {
    return {
        links: props.tasks.links,
        current_page: props.tasks.current_page,
        last_page: props.tasks.last_page,
    };
});

const form = useForm({
    status: props.query.status ?? "",
    order: props.query.order ?? "",
});

watch(form, () => {
    router.get("/", {
        status: form.status === "" ? undefined : form.status,
        order: form.order === "" ? undefined : form.order,
    });
});
</script>
<template>
    <div class="h-full">
        <div class="max-w-screen-lg mx-auto space-y-4">
            <div class="flex justify-between items-center">
                <Link
                    href="/tasks/create"
                    class="w-40 text-neutral-50 inline-flex rounded overflow-hidden group"
                >
                    <div class="p-4 bg-blue-600 group-hover:bg-blue-700">
                        <i class="fa-solid fa-plus fa-lg" />
                    </div>

                    <div class="flex-1 p-4 bg-blue-500 group-hover:bg-blue-600">
                        <span class="font-medium">ADD TASK</span>
                    </div>
                </Link>
                <div class="flex gap-4">
                    <select
                        class="w-40 p-4"
                        v-model="form.status"
                        :disabled="tasks.data.length === 0"
                    >
                        <option value="" disabled>Status</option>
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In-Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select
                        class="w-40 p-4"
                        v-model="form.order"
                        :disabled="tasks.data.length === 0"
                    >
                        <option value="" disabled>Order By</option>
                        <option value="title">Title</option>
                        <option value="date">Date</option>
                    </select>
                </div>
            </div>
            <div v-if="tasks.data.length" class="grid grid-cols-2 gap-4">
                <Link
                    v-for="task in tasks.data"
                    :href="`/tasks/${task.id}`"
                    :key="task.id"
                    :class="[
                        'bg-neutral-50 p-4 space-y-4 rounded-lg border flex flex-col hover:shadow-lg',
                    ]"
                >
                    <h2 class="text-2xl">{{ task.title }}</h2>
                    <p class="opacity-50 line-clamp-3 flex-1">
                        {{ task.description }}
                    </p>
                    <div class="flex justify-between">
                        <div class="space-x-2 opacity-50">
                            <i class="fa-regular fa-calendar fa-sm"></i>

                            <span class="text-sm">
                                {{ task.created_at }}
                            </span>
                        </div>
                        <span
                            :class="[
                                'px-2 rounded py-1 text-xs capitalize text-neutral-50',
                                task.status === 'pending'
                                    ? 'bg-yellow-500'
                                    : task.status === 'in-progress'
                                    ? 'bg-blue-500'
                                    : 'bg-green-500',
                            ]"
                        >
                            {{ task.status }}
                        </span>
                    </div>
                </Link>

                <div
                    v-if="tasks.last_page > 1"
                    class="col-span-full text-center"
                >
                    <Pagination :pagination="pagination" />
                </div>
            </div>
            <div v-else>
                <p class="text-center text-lg opacity-50">
                    You haven't created any tasks yet.
                </p>
            </div>
        </div>
    </div>
</template>
