<script setup lang="ts">
// Se definen las props que recibe el componente
defineProps({
    title: String,
    image: String,
    alt: String,
    paragraphs: Array,
    reverse: Boolean
});
</script>

<template>
    <section class="flex flex-col md:flex-row w-full min-h-[400px] lg:h-[400px] mb-16 md:mb-0"
        :class="{ 'md:flex-row-reverse': reverse }"><!-- Caso tenga reverse, invierte el orden -->
        <!-- Imagen que ocupa toda la anchura en móviles, la mitad en pantallas medianas o mayores -->
        <img :src="image" :alt="alt" class="w-full md:w-1/2 object-cover h-auto" />

        <!-- Contenedor del texto -->
        <div class="flex flex-col justify-center md:w-1/2" :class="reverse ? 'md:pr-12' : 'md:pl-12'">
            <h3 class="text-primary-color text-center text-3xl mb-4 mt-4 lg:mt-0">{{ title }}</h3>

            <!-- Recorre y muestra cada párrafo del array -->
            <p v-for="(paragraph, index) in paragraphs" :key="index" class="text-primary-color text-lg mt-4"
                :class="{ 'mt-0': index === 0 }">
                {{ paragraph }}
            </p>
        </div>
    </section>
</template>

<style scoped></style>
