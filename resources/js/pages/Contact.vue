<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import ContactForm from '@/components/ContactForm.vue';
import ContactImage from '@assets/contacto-banner.png';
import FlashMessage from '@/components/FlashMessage.vue';
</script>

<template>
    <FlashMessage />
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="ContactImage" :pageTitle="$t('contact.title')" />
        </div>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ $t('contact.title') }}</h2>
            <div class="flex flex-col md:flex-row mb-20">
                <!-- Mapa -->
                <div class="">
                    <img src="@assets/mapa-contacto1.jpeg" alt="Mapa con Barcelona y São Paulo"
                        class="w-full rounded-2xl shadow-xl" />
                </div>

                <!-- Texto de presentación -->
                <div class="py-4 md:ml-4 w-full md:w-1/3 text-lg flex flex-col justify-between">
                    <p class="text-primary-color">
                        {{ $t('contact.part1') }}
                    </p>
                    <p class="text-primary-color">
                        {{ $t('contact.part2_1') }} <strong>{{ $t('contact.city') }}</strong>, {{ $t('contact.part2_2')
                        }}
                        {{ $t('contact.address') }}. {{ $t('contact.part2_3') }}
                        <strong>{{ $t('contact.barcelona') }}</strong>, {{ $t('contact.part2_4') }}
                    </p>
                    <p class="text-primary-color">
                        {{ $t('contact.part3_1') }} <a href="mailto:monjasherab@gmail.com"
                            class="text-tertiary-color font-semibold hover:underline">{{ $t('contact.email') }}</a>
                        {{ $t('contact.part3_2') }} <a href="https://wa.me/5511989964269" target="_blank"
                            class="text-tertiary-color font-semibold hover:underline">{{ $t('contact.whatsapp') }}</a>.
                    </p>
                </div>
            </div>
        </section>

        <ContactForm />
    </AppLayout>

</template>

<style scoped></style>
