<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import VideoHeader from '@/components/adr/Home/VideoHeader.vue';
import EventCards from '@/components/adr/Home/EventCards.vue';
import LastNews from '@/components/adr/Home/LastNews.vue'
import StoreCards from '@/components/adr/Home/StoreCards.vue';
import ContactForm from '@/components/adr/Home/ContactForm.vue';
import DonationBanner from '@/components/adr/DonationBanner.vue';

import DonationImage from '@assets/banderas.jpg'
</script>

<template>
    <AppLayout>
        <VideoHeader />

        <EventCards />

        <DonationBanner class="mt-32" :imageUrl="DonationImage" />

        <LastNews />

        <StoreCards />

        <ContactForm />

    </AppLayout>
</template>

<style scoped></style>
