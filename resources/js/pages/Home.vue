<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import VideoHeader from '@/components/Home/VideoHeader.vue';
import EventCards from '@/components/Home/EventCards.vue';
import LastNews from '@/components/Home/LastNews.vue'
import StoreCards from '@/components/Home/StoreCards.vue';
import ContactForm from '@/components/Home/ContactForm.vue';
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
