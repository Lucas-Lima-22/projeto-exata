<script setup>
import { computed } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
import AdminTask from "@/Components/AdminTask.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    tasks: Object,
    query: Object,
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
        <title>Admin</title>
    </Head>
    <div class="h-full">
        <div class="mx-auto max-w-screen-lg space-y-4">
            <div
                class="flex flex-col gap-4 sm:flex-row-reverse sm:items-center sm:justify-between"
            >
                <form
                    @submit.prevent
                    @change="
                        form.transform((data) => ({
                            status:
                                data.status === 'all' ? undefined : data.status,
                            order:
                                data.order === 'latest'
                                    ? undefined
                                    : data.order,
                        })).get('/admin')
                    "
                    class="flex gap-4"
                >
                    <select
                        class="flex-1 rounded border p-2 sm:w-40"
                        v-model="form.status"
                    >
                        <option value="" disabled>Status</option>
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select
                        class="flex-1 rounded border p-2 sm:w-40"
                        v-model="form.order"
                    >
                        <option value="" disabled>Order By</option>
                        <option value="title">Title</option>
                        <option value="oldest">Oldest</option>
                        <option value="latest">Newest</option>
                    </select>
                </form>

                <p class="text-center text-sm opacity-50">
                    {{ tasks.from }} - {{ tasks.to }} of
                    {{ tasks.total }} Tasks.
                </p>
            </div>

            <div v-if="tasks.data.length" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 overflow-x-auto">
                    <AdminTask
                        v-for="task in tasks.data"
                        :key="task.id"
                        :task="task"
                    />
                </div>
                <Pagination
                    v-if="tasks.last_page > 1"
                    :pagination="pagination"
                />
            </div>

            <div v-else>
                <p class="text-center text-lg opacity-50">
                    No tasks were found.
                </p>
            </div>
        </div>
    </div>
</template>
