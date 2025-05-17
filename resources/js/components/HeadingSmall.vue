<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <header>
        <h3 class="mb-0.5 text-xl font-medium text-primary-color white-shadow">{{ title }}</h3>
        <p v-if="description" class="text-sm text-secondary-color">
            {{ description }}
        </p>
    </header>
</template>
