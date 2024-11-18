<script setup>
defineProps({
    tag: String,
});
</script>

<template>
    <div
        :class="[
            'w-20 rounded px-2 py-1 text-center text-xs capitalize text-neutral-50',
            {
                'bg-yellow-500': tag === 'pending',
                'bg-blue-500': tag === 'in-progress',
                'bg-green-500': tag === 'completed',
            },
        ]"
    >
        {{ tag.replace("-", " ") }}
    </div>
</template>
