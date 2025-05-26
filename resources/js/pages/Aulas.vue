<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import DonationBanner from '@/components/adr/DonationBanner.vue';
import VideoSection from '@/components/adr/Aulas/VideoSection.vue';
import Button from '@/components/ui/button/Button.vue';
import AulasImage from '@assets/banner-aulas.png';
import HazteSocioImage from '@assets/hazte-socio-aulas.png';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;

defineProps<{
    freeVideos: any,
    premiumVideos: any,
}>();
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="AulasImage" pageTitle="Aulas" />
        </div>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <div v-if="user && (user.role === 'admin' || user.role === 'operator')" class="mt-12 flex justify-end">
                <Button @click="$inertia.visit('/videos')">Administrar videos</Button>
            </div>

            <VideoSection title="Aulas gratuitas" :videos="freeVideos" />
            <VideoSection title="Aulas solo para socios" :videos="premiumVideos" />
        </section>

        <div v-if="user && user.role !== 'socio'">
            <DonationBanner :imageUrl="HazteSocioImage" title="¡Hazte socio y accede a contenido exclusivo!"
                description="Conviértete en socio del Jardín del Despertar y disfruta de acceso ilimitado a nuestros clases premium"
                buttonText="Hazte socio" buttonUrl="/hazte-socio" />
        </div>
    </AppLayout>
</template>
