<script setup>
import { onMounted } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps({
    message: String,
});

onMounted(() => {
    toast.success(props.message, {
        autoClose: 3000,
        position: toast.POSITION.BOTTOM_RIGHT,
    });
});
</script>

<template></template>
