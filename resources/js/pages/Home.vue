<script setup lang="ts">
// noticias
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

//tienda
import { ref } from 'vue'

import incienso from '@assets/incienso.jpg'
import cuenco from '@assets/cuenco.jpg'
import esterilla from '@assets/esterilla.jpg'
import lampara from '@assets/lampara.jpg'

const products = ref([
    { id: 1, name: 'Incienso de Sándalo', price: 8.99, image: incienso },
    { id: 2, name: 'Cuenco tibetano pequeño', price: 29.99, image: cuenco },
    { id: 3, name: 'Esterilla de meditación', price: 19.5, image: esterilla },
    { id: 4, name: 'Lámpara de sal', price: 15.0, image: lampara },
])
</script>

<template>
    <!-- contenedor principal -->
    <div class="background-container bg-white relative overflow-hidden w-full mx-auto min-h-screen flex flex-col">

        <header class="z-20">
            <!-- barra superior -->
            <div class="py-1 bg-yellow-600 w-full">
                <div class="flex items-center justify-between max-w-[1512px] w-[90%] mx-auto px-4">
                    <div><a href="#" class="text-white hover:text-gray-300">Entrar en contacto</a></div>
                    <div><a href="#" class="text-white hover:text-gray-300">¡Hazte socio!</a></div>
                </div>
            </div>
            <div class="w-full bg-primary h-[100px] flex items-center">
                <div class="max-w-[1512px] w-[90%] flex justify-between items-center mx-auto px-4 py-2 text-white">
                    <!-- logo -->
                    <div class="flex items-center">
                        <a href="#"><img src="@assets/logo.png" alt="Logo jardín del despertar"
                                class="w-20 rounded-full h-full mr-2"></a>
                    </div>

                    <!-- navegador -->
                    <nav class="flex items-center">
                        <ul class="flex space-x-4">
                            <li><a href="#" class="text-white hover:text-gray-300">Quienes somos</a></li>
                            <li><a href="#" class="text-white hover:text-gray-300">Eventos</a></li>
                            <li><a href="#" class="text-white hover:text-gray-300">Aulas</a></li>
                            <li><a href="#" class="text-white hover:text-gray-300">Nuestra tienda</a></li>
                            <li><a href="#" class="text-white hover:text-gray-300">Novedades</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main class="z-1">
            <!-- banner -->
            <div class="w-full max-w-[1512px] mx-auto relative">
                <!-- video -->
                <div class="flex justify-center items-center">
                    <video class="w-full max-w-[1512px] max-h-[700px] object-cover object-top" autoplay muted loop>
                        <source src="@assets/home_banner.mp4" type="video/mp4" />
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                </div>

                <!-- texto en el video -->
                <div
                    class="absolute top-40 right-10 hidden md:flex flex-col items-center text-center text-[#320000]  drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]">
                    <h1 class="text-4xl lg:text-6xl font-bold">Jardín del Despertar</h1>
                    <p class="text-3xl font-bold mt-2">Un lugar de paz</p>
                </div>

                <!-- texto fuera del video (mobile) -->
                <div class="block md:hidden mt-6 w-[80%] text-left text-[#320000] mx-auto">
                    <h1 class="text-4xl font-bold">Jardín del Despertar</h1>
                    <p class="text-lg font-normal mt-4">Un lugar de paz</p>
                </div>
            </div>

            <!-- eventos -->
            <div class="w-[90%] max-w-[1512px] mx-auto">
                <h2 class="text-4xl font-bold text-center text-[#320000] my-20">Eventos</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">

                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">

                        <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">
                            Meditación para principiantes
                        </h3>

                        <p class="text-[#320000] text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>

                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">
                        <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">Meditación para principiantes
                        </h3>
                        <p class="text-[#320000] text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>
                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">
                        <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">Meditación para principiantes
                        </h3>
                        <p class="text-[#320000] text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>
                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>

                </div>

            </div>

            <!-- TODO! CAMBIAR DE COLOR LOS SVG DEL SLIDER -->

            <!-- noticias -->
            <div class="w-[90%] max-w-[1512px] mx-auto">
                <h2 class="text-4xl font-bold text-center text-[#320000] my-20">Últimas noticias</h2>

                <!-- Carrusel de noticias -->
                <Swiper :modules="[Navigation, Pagination, Autoplay]" :spaceBetween="20" :slidesPerView="1" navigation
                    :pagination="{ clickable: true }" :loop="true"
                    :autoplay="{ delay: 5000, disableOnInteraction: false }" class="w-full h-auto text-[#320000]">
                    <SwiperSlide>
                        <div class=" bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                            <img src="@assets/accion_social.jpeg" alt="Noticia 1"
                                class="w-full h-[800px] object-cover rounded-t-lg">
                            <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">Noticia 1</h3>
                            <p class="text-[#320000] text-lg p-4">
                                Breve descripción de la noticia 1. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.
                            </p>
                            <button class="flex justify-center items-center w-full">
                                <a href="#"
                                    class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                    Leer más
                                </a>
                            </button>
                        </div>
                    </SwiperSlide>
                    <SwiperSlide>
                        <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                            <img src="@assets/accion_social1.jpeg" alt="Noticia 2"
                                class="w-full h-[800px] object-cover rounded-t-lg">
                            <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">Noticia 2</h3>
                            <p class="text-[#320000] text-lg p-4">
                                Breve descripción de la noticia 2. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.
                            </p>
                            <button class="flex justify-center items-center w-full">
                                <a href="#"
                                    class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                    Leer más
                                </a>
                            </button>
                        </div>
                    </SwiperSlide>
                    <SwiperSlide>
                        <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                            <img src="@assets/accion_social2.jpeg" alt="Noticia 3"
                                class="w-full h-[800px] object-cover rounded-t-lg">
                            <h3 class="text-2xl font-semibold text-[#320000] text-center mt-6">Noticia 3</h3>
                            <p class="text-[#320000] text-lg p-4">
                                Breve descripción de la noticia 3. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.
                            </p>
                            <button class="flex justify-center items-center w-full">
                                <a href="#"
                                    class="bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300">
                                    Leer más
                                </a>
                            </button>
                        </div>
                    </SwiperSlide>
                </Swiper>
            </div>

            <!-- tienda -->
            <div class="w-[90%] max-w-[1512px] mx-auto text-[#1F2937]">
                <h2 class="text-4xl font-extrabold text-center my-16 tracking-tight">Nuestra tienda</h2>
                <router-link to="/tienda"
                    class="text-4xl text-[#320000] hover:text-[#5c0f0f] hover:underline my-8 block text-right font-medium cursor-pointer">
                    Ver todos los productos →
                </router-link>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <div v-for="product in products" :key="product.id"
                        class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center">
                        <img :src="product.image" :alt="product.name"
                            class="w-full h-48 object-cover rounded-xl mb-4" />
                        <h3 class="text-xl font-semibold text-gray-800 mb-1 text-center">{{ product.name }}</h3>
                        <p class="text-lg font-medium text-yellow-600 mb-4">{{ product.price }} €</p>
                        <button @click="addToCart(product)"
                            class="mt-auto bg-[#320000] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5c0f0f] transition duration-300 cursor-pointer">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </main>

    </div>
</template>

<style scoped>
.bg-primary {
    background: #320000 !important;
}

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
</style>
