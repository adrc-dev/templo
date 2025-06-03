<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

// Props: URL de imagen y título de la página
const props = defineProps({
    imageUrl: String,
    pageTitle: String
})

const fallback = '/fallback-event.png'; // Imagen de respaldo si la principal falla
const backgroundImage = ref(fallback); // Imagen a mostrar como fondo

// Vigila los cambios en imageUrl y carga la imagen (con fallback)
watch(() => props.imageUrl, (url) => {
    if (!url) return;

    const img = new Image();
    img.src = url;
    img.onload = () => {
        backgroundImage.value = url;
    };
    img.onerror = () => {
        backgroundImage.value = fallback;
    };
}, { immediate: true });
</script>

<template>
    <!-- Título de la página para el navegador -->

    <Head :title="pageTitle" />

    <!-- Imagen de fondo con degradado en escritorio -->
    <div v-bind="$attrs" class="w-full mx-auto min-h-[400px] bg-cover bg-center relative"
        :style="{ backgroundImage: `url(${backgroundImage})` }">
        <!-- Degradado oscuro en pantallas grandes -->
        <div class="hidden md:block absolute inset-0 bg-gradient-to-l from-primary-color to-primary-color/10]"></div>

        <!-- Contenido en escritorio -->
        <div
            class="relative hidden max-w-[1200px] min-h-[400px] mx-auto md:flex flex-col items-center justify-center px-4">
            <!-- Título corto arriba -->
            <div
                class="flex justify-start items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto mb-2 h-full">
                <div class="text-xl font-bold text-gray-300" style="text-shadow: 1px 1px 4px var(--secondary-color);">
                    {{ pageTitle }}
                </div>
            </div>

            <!-- Título principal -->
            <div class="flex justify-end items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto h-full">
                <h1 class="text-5xl/16 lg:text-7xl/20 font-bold text-white">
                    {{ $t('headingBanner.title') }}
                </h1>
            </div>

            <!-- Subtítulo -->
            <div class="flex justify-end items-center flex-wrap w-full max-w-[350px] lg:max-w-[500px] ml-auto h-full">
                <h2 class="text-2xl font-bold text-secondary-color mt-4">
                    {{ $t('headingBanner.subtitle') }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Versión móvil -->
    <div class="md:hidden max-w-[1200px] min-h-[400px] mx-auto flex flex-col items-center justify-center px-4">
        <!-- Título corto -->
        <div class="flex justify-center items-center mb-2">
            <div class="text-2xl font-bold text-tertiary-color">{{ pageTitle }}</div>
        </div>

        <!-- Título principal -->
        <div class="flex justify-center items-center flex-wrap w-full">
            <h1 class="text-6xl/18 font-bold text-primary-color text-center">
                {{ $t('headingBanner.title') }}
            </h1>
        </div>

        <!-- Subtítulo -->
        <div class="flex justify-center items-center flex-wrap w-full h-full">
            <h2 class="text-2xl font-bold text-secondary-color text-center mt-4">
                {{ $t('headingBanner.subtitle') }}
            </h2>
        </div>
    </div>
</template>

<style scoped></style>
