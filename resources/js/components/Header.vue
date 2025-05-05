<script lang="ts" setup>
import { ref } from 'vue'

const isMenuOpen = ref(false)

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value
}
</script>

<template>
    <header class="z-20">
        <!-- barra superior -->
        <div class="py-1 bg-secondary-color w-full">
            <div class="flex items-center text-primary-color justify-between w-full mx-auto px-8">
                <div><a href="/contact" class="hover:text-tertiary-color">Entrar en contacto</a></div>
                <div><a href="#" class="hover:text-tertiary-color">¡Hazte socio!</a></div>
            </div>
        </div>

        <!-- barra principal -->
        <div class="w-full bg-primary-color h-[100px] flex items-center">
            <div class="w-full flex justify-between items-center mx-auto px-8 py-2 text-white">
                <!-- logo -->
                <div class="flex items-center">
                    <a href="/"><img src="@assets/logo-claro-solo.png" alt="Logo" class="w-45 h-full" /></a>
                </div>

                <!-- botón hamburguesa -->
                <button class="md:hidden focus:outline-none" @click="toggleMenu">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- menú escritorio -->
                <nav class="hidden md:flex items-center">
                    <ul class="flex space-x-4">
                        <li><a href="/about-us" class="text-white hover:text-gray-300">Quienes somos</a></li>
                        <li><a href="/events" class="text-white hover:text-gray-300">Eventos</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Aulas</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Nuestra tienda</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Novedades</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- menú móvil con transición -->
        <transition name="fade">
            <nav v-show="isMenuOpen"
                class="md:hidden bg-primary-color text-white px-4 pb-4 transition-all duration-300 ease-in-out">
                <ul class="flex flex-col space-y-2">
                    <li><a href="/about-us" class="hover:text-gray-300" @click="toggleMenu">Quienes somos</a></li>
                    <li><a href="/events" class="hover:text-gray-300" @click="toggleMenu">Eventos</a></li>
                    <li><a href="" class="hover:text-gray-300" @click="toggleMenu">Aulas</a></li>
                    <li><a href="#" class="hover:text-gray-300" @click="toggleMenu">Nuestra tienda</a></li>
                    <li><a href="#" class="hover:text-gray-300" @click="toggleMenu">Novedades</a></li>
                </ul>
            </nav>
        </transition>
    </header>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
