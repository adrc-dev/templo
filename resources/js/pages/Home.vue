<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import VideoHeader from '@/components/adr/Home/VideoHeader.vue';
import EventCard from '@/components/adr/EventCard.vue';
import LastNews from '@/components/adr/Home/LastNews.vue'
import StoreCards from '@/components/adr/Home/StoreCards.vue';
import ContactForm from '@/components/adr/Home/ContactForm.vue';
import DonationBanner from '@/components/adr/DonationBanner.vue';

import DonationImage from '@assets/banderas.jpg'

const { events } = defineProps<{
    events: {
        id: number
        title: string
        slug: string
        content: string
        event_date: string
        featured_image: string
    }[]
}>()
</script>

<template>
    <AppLayout>
        <VideoHeader />

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Eventos</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                <EventCard v-for="event in events" :key="event.id" :image="event.featured_image" :title="event.title"
                    :description="event.content" :date="event.event_date" :link="`/events/${event.slug}`" />
            </div>
        </section>

        <DonationBanner class="mt-32" :imageUrl="DonationImage" />

        <LastNews />

        <StoreCards />

        <ContactForm />

    </AppLayout>
</template>

<style scoped></style>
