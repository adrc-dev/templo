<script setup lang="ts">
defineProps<{
    image: string,
    title: string,
    content: string
}>()
</script>

<template>
    <img :src="image" alt="Foto del evento"
        class="w-full max-h-[600px] object-cover rounded-xl shadow-lg mt-6 md:mt-20" />
    <h2 class="text-4xl font-bold text-center text-primary-color my-10">{{ title }}</h2>
    <p class="text-primary-color mb-10 max-w-3xl mx-auto">{{ content }}</p>
</template>
