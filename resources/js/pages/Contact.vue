<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import ContactForm from '@/components/Home/ContactForm.vue';
import ContactImage from '@assets/contacto-banner.png';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="ContactImage" pageTitle="Contacto" />
        <div class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Contacto</h2>
            <p class="text-lg text-center text-primary-color mb-10">
                Tenemos una sede en São Caetano do Sul, Brasil, y otra en Barcelona, España
            </p>
        </div>

        <ContactForm />
    </AppLayout>

</template>

<style scoped></style>
