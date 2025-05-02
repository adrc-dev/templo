<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
</script>

<template>
    <!-- TODO! CAMBIAR DE COLOR LOS SVG DEL SLIDER -->
    <section class="w-full px-4 max-w-[1200px] mx-auto">
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">Últimas noticias</h2>

        <!-- Carrusel de noticias -->
        <Swiper :modules="[Navigation, Pagination, Autoplay]" :spaceBetween="20" :slidesPerView="1" navigation
            :pagination="{ clickable: true }" :loop="true" :autoplay="{ delay: 5000, disableOnInteraction: false }"
            class="w-full h-auto text-primary-color">
            <SwiperSlide>
                <div class=" bg-amber-50 rounded-4xl overflow-hidden pb-6">
                    <img src="@assets/accion_social.jpeg" alt="Noticia 1"
                        class="w-full h-[800px] object-cover rounded-t-lg">
                    <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">Noticia 1</h3>
                    <p class="text-primary-color text-lg p-4">
                        Breve descripción de la noticia 1. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit.
                    </p>
                    <button class="flex justify-center items-center w-full">
                        <a href="#"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Leer más
                        </a>
                    </button>
                </div>
            </SwiperSlide>
            <SwiperSlide>
                <div class="bg-amber-50 rounded-4xl overflow-hidden pb-6">
                    <img src="@assets/accion_social1.jpeg" alt="Noticia 2"
                        class="w-full h-[800px] object-cover rounded-t-lg">
                    <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">Noticia 2</h3>
                    <p class="text-primary-color text-lg p-4">
                        Breve descripción de la noticia 2. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit.
                    </p>
                    <button class="flex justify-center items-center w-full">
                        <a href="#"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Leer más
                        </a>
                    </button>
                </div>
            </SwiperSlide>
            <SwiperSlide>
                <div class="bg-amber-50 rounded-4xl overflow-hidden pb-6">
                    <img src="@assets/accion_social2.jpeg" alt="Noticia 3"
                        class="w-full h-[800px] object-cover rounded-t-lg">
                    <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">Noticia 3</h3>
                    <p class="text-primary-color text-lg p-4">
                        Breve descripción de la noticia 3. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit.
                    </p>
                    <button class="flex justify-center items-center w-full">
                        <a href="#"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Leer más
                        </a>
                    </button>
                </div>
            </SwiperSlide>
        </Swiper>
    </section>


</template>

<style scoped></style>
