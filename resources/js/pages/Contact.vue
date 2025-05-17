<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import ContactForm from '@/components/adr/Home/ContactForm.vue';
import ContactImage from '@assets/contacto-banner.png';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="ContactImage" pageTitle="Contacto" />

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Contacto</h2>
            <div class="flex mb-10">
                <!-- Mapa -->
                <div class="">
                    <img src="@assets/mapa-contacto.png" alt="Mapa con Barcelona y São Paulo"
                        class="w-full rounded-2xl shadow-xl" />
                </div>

                <!-- Texto de presentación -->
                <div class="py-4 ml-4 w-1/3 text-lg flex flex-col justify-between">
                    <p class="text-primary-color">
                        ¿Tienes alguna pregunta, deseas participar en nuestras actividades o simplemente quieres
                        conocernos
                        mejor?
                        Estaremos encantados de escucharte.
                    </p>
                    <p class="text-primary-color">
                        Desde septiembre de 2007, nuestro templo tiene su sede principal en <strong>São Caetano do Sul,
                            São
                            Paulo, Brasil</strong>,
                        en la Calle Engenheiro Rebouças 1040, 09540-000. También realizamos retiros esporádicos en
                        <strong>Barcelona, España</strong>, aunque aún no contamos con una sede fija allí.
                    </p>
                    <p class="text-primary-color">
                        Puedes escribirnos a <a href="mailto:monjasherab@gmail.com"
                            class="text-tertiary-color font-semibold hover:underline">monjasherab@gmail.com</a>
                        o enviarnos un WhatsApp al <a href="https://wa.me/5511989964269" target="_blank"
                            class="text-tertiary-color font-semibold hover:underline">+55 11 98996-4269</a>.
                    </p>
                </div>
            </div>
        </section>

        <ContactForm />
    </AppLayout>

</template>

<style scoped></style>
