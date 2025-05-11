<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthCardLayout.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <AuthLayout :title="title" :description="description">
        <slot />
    </AuthLayout>
</template>

<style scoped>
.background-container::before {
    content: "";
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 100%;
    width: 100%;
    max-width: 1512px;
    background: url("@assets/bg.png") no-repeat left bottom fixed;
    background-size: 1200px;
    opacity: 0.2;
    pointer-events: none;
}

@media (max-width: 768px) {
    .background-container::before {
        background-position: left bottom;
        background-size: 600px;
    }
}
</style>
