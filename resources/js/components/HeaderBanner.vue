<script setup lang="ts">
defineProps({
    imageUrl: String,
    pageTitle: String
})
</script>

<template>
    <div class="w-full mx-auto min-h-[400px] bg-cover bg-center" :style="{ backgroundImage: `url(${imageUrl})` }">
        <div class="hidden max-w-[1200px] min-h-[400px] mx-auto md:flex flex-col items-center justify-center px-4">
            <!-- Page title -->
            <div
                class="flex justify-start items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto mb-2 h-full">
                <div class="text-xl font-bold text-tertiary-color">{{ pageTitle }}</div>
            </div>
            <!-- Title -->
            <div class="flex justify-end items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto h-full">
                <h1 class="text-5xl/16 lg:text-7xl/20 font-bold text-white">Templo Jardín del Despertar</h1>
            </div>
            <!-- Subtitle -->
            <div class="flex justify-end items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto h-full">
                <h2 class="text-2xl font-bold text-secondary-color mt-4">
                    Un espacio para la meditación y el crecimiento personal
                </h2>
            </div>
        </div>
    </div>
    <!-- mobile -->
    <div class="md:hidden max-w-[1200px] min-h-[400px] mx-auto flex flex-col items-center justify-center px-4">
        <!-- Page title -->
        <div class="flex justify-center items-center mb-2">
            <div class="text-2xl font-bold text-tertiary-color">{{ pageTitle }}</div>
        </div>
        <!-- Title -->
        <div class="flex justify-center items-center flex-wrap w-full">
            <h1 class="text-6xl/18 font-bold text-primary-color text-center">Templo Jardín del Despertar</h1>
        </div>
        <!-- Subtitle -->
        <div class="flex justify-center items-center flex-wrap w-full h-full">
            <h2 class="text-2xl font-bold text-secondary-color text-center mt-4">
                Un espacio para la meditación y el crecimiento personal
            </h2>
        </div>
    </div>
</template>

<style scoped></style>
