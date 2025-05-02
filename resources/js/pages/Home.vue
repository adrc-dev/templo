<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import VideoHeader from '@/components/VideoHeader.vue';
import EventCards from '@/components/EventCards.vue';
import LastNews from '@/components/LastNews.vue'
import StoreCards from '@/components/StoreCards.vue';
import ContactForm from '@/components/ContactForm.vue';
</script>

<template>
    <AppLayout>
        <VideoHeader />

        <EventCards />

        <LastNews />

        <StoreCards />

        <ContactForm />

    </AppLayout>
</template>

<style scoped></style>
