<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import ShopImage from '@assets/bg-shop.png';
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner pageTitle="Nuestra tienda" class="bg-primary-color/50" :imageUrl="ShopImage" />
        </div>


        <section class="w-full px-4 max-w-[1200px] mx-auto text-primary-color mb-16">
            <h2 class="text-4xl font-bold text-center my-16 tracking-tight">Nuestra tienda</h2>
            <p class="text-center text-lg max-w-xl mx-auto leading-relaxed">
                🌱 Estamos cultivando algo especial...
                <br />
                Nuestra tienda está en construcción y muy pronto florecerá con productos pensados para acompañarte en tu
                camino.
                <br />
                Gracias por tu paciencia y apoyo 🙏
            </p>
        </section>
    </AppLayout>
</template>

<style scoped></style>
