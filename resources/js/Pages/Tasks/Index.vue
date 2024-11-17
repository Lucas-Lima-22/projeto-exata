<script setup>
import { computed } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
import Task from "@/Components/Task.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    tasks: Object,
    query: Array,
});

const form = useForm({
    status: props.query.status ?? "all",
    order: props.query.order ?? "latest",
});

const pagination = computed(() => {
    return {
        links: props.tasks.links,
        current_page: props.tasks.current_page,
        last_page: props.tasks.last_page,
    };
});
</script>
<template>
    <Head>
        <title>Home</title>
    </Head>
    <div class="h-full">
        <div class="max-w-screen-lg mx-auto space-y-4">
            <div
                class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center"
            >
                <Link
                    href="/tasks/create"
                    class="bg-cyan-500 hover:bg-cyan-600 rounded-lg p-4 text-center sm:w-40"
                >
                    <span class="text-neutral-50 font-medium">ADD TASK</span>
                </Link>
                <form
                    @submit.prevent
                    @change="
                        form.transform((data) => ({
                            status:
                                data.status === '' || data.status === 'all'
                                    ? undefined
                                    : data.status,
                            order: data.order === '' ? undefined : data.order,
                        })).get('/')
                    "
                    class="flex gap-4"
                >
                    <select
                        class="flex-1 sm:w-40 p-4 border rounded-lg"
                        v-model="form.status"
                        :disabled="tasks.data.length === 0"
                    >
                        <option value="" disabled>Status</option>
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select
                        class="flex-1 sm:w-40 p-4 border rounded-lg"
                        v-model="form.order"
                        :disabled="tasks.data.length === 0"
                    >
                        <option value="" disabled>Order By</option>
                        <option value="title">Title</option>
                        <option value="oldest">Oldest</option>
                        <option value="latest">Newest</option>
                    </select>
                </form>
            </div>

            <div
                v-if="tasks.data.length"
                class="grid grid-cols-1 sm:grid-cols-2 gap-4"
            >
                <Task v-for="task in tasks.data" :key="task.id" :task="task" />

                <Pagination
                    v-if="tasks.last_page > 1"
                    :pagination="pagination"
                />
            </div>

            <div v-else>
                <p class="text-center text-lg opacity-50">
                    You haven't created any tasks yet.
                </p>
            </div>
        </div>
    </div>
</template>
