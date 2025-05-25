<script setup lang="ts">
import Button from '../ui/button/Button.vue'
defineProps<{
    imageUrl: string
    title: string
    description: string
    buttonText: string
    buttonUrl: string
}>()
</script>

<template>
    <div class="donation-container w-full bg-cover min-h-[500px] flex items-center justify-center relative"
        :style="{ backgroundImage: `url(${imageUrl})` }">
        <div class="w-full max-w-[1200px] flex flex-col justify-center items-center text-center relative z-10 mx-4">
            <h2 class="text-4xl font-bold text-white mb-4">{{ title }}</h2>
            <p class="text-lg text-white mb-8">{{ description }}</p>
            <Button :href="buttonUrl" variant="transparent">
                {{ buttonText }}
            </Button>
        </div>
    </div>
</template>

<style scoped>
.donation-container::after {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background: var(--primary-color);
    opacity: 0.8;
    pointer-events: none;
}
</style>
