<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import ContactForm from '@/components/Home/ContactForm.vue';
import ContactImage from '@assets/contacto-banner.png';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="ContactImage" pageTitle="Contacto" />
        <section class="bg-white py-12 px-4 max-w-4xl mx-auto">
            <!-- Mapa -->
            <div class="mb-10">
                <img src="/images/mapa-contacto.png" alt="Mapa con Barcelona y São Paulo"
                    class="w-full rounded-2xl shadow-md" />
            </div>

            <!-- Texto de presentación -->
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-primary-color mb-4">Contacto</h2>
                <p class="text-primary-color mb-2">
                    ¿Tienes alguna pregunta, deseas participar en nuestras actividades o simplemente quieres conocernos
                    mejor?
                    Estaremos encantados de escucharte.
                </p>
                <p class="text-primary-color mb-2">
                    Desde septiembre de 2007, nuestro templo tiene su sede principal en <strong>São Caetano do Sul, São
                        Paulo, Brasil</strong>,
                    en la Calle Engenheiro Rebouças 1040, 09540-000. También realizamos retiros esporádicos en
                    <strong>Barcelona, España</strong>, aunque aún no contamos con una sede fija allí.
                </p>
                <p class="text-primary-color">
                    Puedes escribirnos a <a href="mailto:monjasherab@gmail.com"
                        class="text-red-800 font-semibold hover:underline">monjasherab@gmail.com</a>
                    o enviarnos un WhatsApp al <a href="https://wa.me/5511989964269" target="_blank"
                        class="text-red-800 font-semibold hover:underline">+55 11 98996-4269</a>.
                </p>
            </div>
        </section>
        <ContactForm />
    </AppLayout>

</template>

<style scoped></style>
