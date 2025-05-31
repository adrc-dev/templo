<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import DonationBanner from '@/components/DonationBanner.vue';
import VideoSection from '@/components/Aulas/VideoSection.vue';
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
            <HeaderBanner :imageUrl="AulasImage" :pageTitle="$t('videos.aulas')" />
        </div>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <div v-if="user && (user.role === 'admin' || user.role === 'operator')" class="mt-12 flex justify-end">
                <Button @click="$inertia.visit('/videos')">{{ $t('videos.manageVideos') }}</Button>
            </div>

            <VideoSection :title="$t('videos.freeAulas')" :videos="freeVideos" />
            <div v-if="user && user.role == 'socio' || user.role == 'admin' || user.role == 'operator'">
                <VideoSection :title="$t('videos.premiumAulas')" :videos="premiumVideos" />
            </div>
        </section>

        <div v-if="user && user.role !== 'socio'">
            <DonationBanner :imageUrl="HazteSocioImage" :title="$t('home.membershipBanner.title')"
                :description="$t('home.membershipBanner.description')"
                :buttonText="$t('home.membershipBanner.buttonText')" buttonUrl="/hazte-socio" />
        </div>
    </AppLayout>
</template>
