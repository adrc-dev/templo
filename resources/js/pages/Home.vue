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
            <div class="py-1 bg-secondary-color w-full">
                <div class="flex items-center text-primary-color justify-between max-w-[1200px] w-full mx-auto px-4">
                    <div><a href="#" class="hover:text-tertiary-color">Entrar en contacto</a></div>
                    <div><a href="#" class="hover:text-tertiary-color">¡Hazte socio!</a></div>
                </div>
            </div>
            <div class="w-full bg-primary-color h-[100px] flex items-center">
                <div class="max-w-[1200px] w-full flex justify-between items-center mx-auto px-4 py-2 text-white">
                    <!-- logo -->
                    <div class="flex items-center">
                        <a href="#"><img src="@assets/logo-claro-solo.png" alt="Logo jardín del despertar"
                                class="w-45 h-full"></a>
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
            <section class="w-full mx-auto relative">
                <!-- video -->
                <div class="flex justify-center items-center w-full">
                    <video class="w-full max-h-[700px] object-cover object-top" autoplay muted loop>
                        <source src="@assets/home_banner.mp4" type="video/mp4" />
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                </div>

                <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                    <div class="w-full max-w-[1200px] relative">
                        <div
                            class="absolute bottom-10 right-4 hidden lg:flex flex-col items-end text-primary-color drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]">
                            <img src="@assets/logo-oscuro-rec.png" alt="Logo jardín del despertar" class="w-100 h-full">
                        </div>
                    </div>
                </div>

                <!-- texto fuera del video (mobile) -->
                <div class="block lg:hidden mt-6 w-[80%] text-center text-primary-color mx-auto">
                    <img src="@assets/logo-oscuro-rec.png" alt="Logo jardín del despertar" class="w-130 h-full mx-auto">
                </div>
            </section>

            <!-- eventos -->
            <section class="w-full px-4 max-w-[1200px] mx-auto">
                <h2 class="text-4xl font-bold text-center text-primary-color my-20">Eventos</h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">

                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">

                        <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">
                            Meditación para principiantes
                        </h3>

                        <p class="text-primary-color text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>

                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">
                        <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">Meditación para
                            principiantes
                        </h3>
                        <p class="text-primary-color text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>
                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>

                    <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
                        <img src="@assets/meditacion.jpeg" alt="Evento de meditación"
                            class="w-full h-68 object-cover rounded-t-lg">
                        <h3 class="text-2xl font-semibold text-primary-color text-center mt-6">Meditación para
                            principiantes
                        </h3>
                        <p class="text-primary-color text-lg p-4">
                            Descubre la calma interior y aprende a meditar desde cero
                            en un espacio seguro y acogedor. No necesitas experiencia previa, solo ganas de conectar
                            contigo mismo y encontrar un momento de paz.
                        </p>
                        <button class="flex justify-center items-center w-full">
                            <a href="#"
                                class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                                Más información
                            </a>
                        </button>
                    </div>
                </div>

            </section>

            <!-- TODO! CAMBIAR DE COLOR LOS SVG DEL SLIDER -->
            <!-- noticias -->
            <section class="w-full px-4 max-w-[1200px] mx-auto">
                <h2 class="text-4xl font-bold text-center text-primary-color my-20">Últimas noticias</h2>

                <!-- Carrusel de noticias -->
                <Swiper :modules="[Navigation, Pagination, Autoplay]" :spaceBetween="20" :slidesPerView="1" navigation
                    :pagination="{ clickable: true }" :loop="true"
                    :autoplay="{ delay: 5000, disableOnInteraction: false }" class="w-full h-auto text-primary-color">
                    <SwiperSlide>
                        <div class=" bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
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
                        <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
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
                        <div class="bg-amber-50 shadow-lg rounded-4xl overflow-hidden pb-6">
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

            <!-- tienda -->
            <section class="w-full px-4 max-w-[1200px] mx-auto text-primary-color mb-16">
                <h2 class="text-4xl font-bold text-center my-16 tracking-tight">Nuestra tienda</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div v-for="product in products" :key="product.id"
                        class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center">
                        <img :src="product.image" :alt="product.name"
                            class="w-full h-48 object-cover rounded-xl mb-4" />
                        <h3 class="text-xl font-semibold text-primary-color mb-1 text-center">{{ product.name }}</h3>
                        <p class="text-lg font-medium text-secondary-color mb-4">{{ product.price }} €</p>
                        <button @click="addToCart(product)"
                            class="mt-auto bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300 cursor-pointer">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
                <router-link to="/tienda"
                    class="text-xl text-primary-color hover:text-tertiary-color hover:underline my-8 block text-right font-medium cursor-pointer">
                    Ver todos los productos →
                </router-link>
            </section>

            <!-- contacto -->
            <section class="w-full gradient-bg text-white">
                <div class="relative z-10">
                    <div class="w-[full] max-w-[1200px] mx-auto text-white mb-16">
                        <h2 class="text-4xl font-bold text-center mt-16 tracking-tight">
                            ¿Tienes alguna duda?
                        </h2>
                        <p class="text-2xl text-center tracking-tight mt-2">
                            ¡Entra en contacto!
                        </p>
                    </div>


                    <div class="w-full max-w-[1200px] flex flex-row justify-center items-center mt-8 mx-auto">

                        <div class="p-4 w-full md:max-w-[80%] lg:max-w-[60%]">
                            <form>
                                <label for="name" class="block pl-3 text-base font-medium mb-2">Nombre:</label>
                                <input type="text" id="name" name="name" required
                                    class="border border-gray-300 rounded-lg p-2 w-full mb-4">

                                <div class="md:flex md:space-x-4">
                                    <div class="md:w-1/2">
                                        <label for="phone"
                                            class="block pl-3 text-base font-medium mb-2">Teléfono:</label>
                                        <input type="tel" id="phone" name="phone" required
                                            class="border border-gray-300 rounded-lg p-2 w-full mb-4">
                                    </div>
                                    <div class="md:w-1/2">
                                        <label for="email" class="block pl-3 text-base font-medium mb-2">Email:</label>
                                        <input type="email" id="email" name="email" required
                                            class="border border-gray-300 rounded-lg p-2 w-full mb-4">
                                    </div>
                                </div>

                                <label for="message" class="block pl-3 text-base font-medium mb-2">Mensaje:</label>
                                <textarea id="message" name="message" rows="4" required
                                    class="border border-gray-300 rounded-lg p-2 w-full mb-4"></textarea>

                                <div class="mb-4">
                                    <label for="privacy"
                                        class="flex pl-3 items-center text-base font-medium text-white cursor-pointer">
                                        <input type="checkbox" id="privacy" name="privacy" required
                                            class="sr-only peer">

                                        <div class="
                                            mr-2 h-5 w-5 rounded border border-gray-300
                                            peer-checked:bg-secondary-color peer-checked:border-secondary-color
                                            flex items-center justify-center
                                            transition-colors duration-200
                                            after:content-['✓'] after:text-primary-color after:text-sm after:font-bold
                                            after:opacity-0 after:transition-opacity
                                            peer-checked:after:opacity-100
                                            "></div>

                                        <span>
                                            Al enviar este formulario acepto la
                                            <a href="#" class="font-bold hover:underline">Política de privacidad</a>.
                                        </span>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="bg-transparent border border-white w-full text-white font-semibold mt-14 py-2 px-4 rounded-lg hover:bg-secondary-color hover:border-secondary-color hover:text-primary-color transition duration-300 cursor-pointer">
                                    Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>


        <footer class="z-1">

        </footer>
    </div>
</template>

<style scoped>
/* bg contacto */
.gradient-bg {
    position: relative;
    overflow: hidden;
}

.gradient-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("@assets/bg-contact-home.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: 1;
}

.gradient-bg::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(50, 0, 0, 0.7);
    z-index: 2;
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
