<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <h2 class="text-6xl font-bold text-center text-primary-color white-shadow">{{ title }}</h2>
        <p v-if="description" class="text-secondary-color text-center mt-4 mb-6">
            {{ description }}
        </p>
    </div>
</template>
