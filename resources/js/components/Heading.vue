<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <h2 class="text-4xl font-bold text-center text-primary-color mt-20">{{ title }}</h2>
        <p v-if="description" class="text-muted-foreground text-center mb-20">
            {{ description }}
        </p>
    </div>
</template>
