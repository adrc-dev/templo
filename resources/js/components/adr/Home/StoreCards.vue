<script setup lang="ts">
import { ref } from 'vue'
import GoLink from '../GoLink.vue'

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
    <section class="w-full px-4 max-w-[1200px] mx-auto text-primary-color mb-16">
        <h2 class="text-4xl font-bold text-center my-16 tracking-tight">Nuestra tienda</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div v-for="product in products" :key="product.id"
                class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center">
                <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover rounded-xl mb-4" />
                <h3 class="text-xl font-semibold text-primary-color mb-1 text-center">{{ product.name }}</h3>
                <p class="text-lg font-medium text-secondary-color mb-4">{{ product.price }} €</p>
                <!--<button @click="addToCart(product)"
                    class="mt-auto bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300 cursor-pointer">
                    Agregar al carrito
                </button>-->
                <button
                    class="mt-auto bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300 cursor-pointer">
                    Agregar al carrito
                </button>
            </div>
        </div>
        <GoLink href="/shop" class="text-right block ml-auto">
            Ver todos los productos →
        </GoLink>
    </section>
</template>

<style scoped></style>
