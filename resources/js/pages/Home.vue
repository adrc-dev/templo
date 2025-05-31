<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import VideoHeader from '@/components/Home/VideoHeader.vue';
import EventCard from '@/components/EventCard.vue';
import StoreCards from '@/components/Home/StoreCards.vue';
import ContactForm from '@/components/ContactForm.vue';
import DonationBanner from '@/components/DonationBanner.vue';
import { Head } from '@inertiajs/vue3';
import DonationImage from '@assets/banderas.jpg'
import HazteSocioImage from '@assets/hazt-socio-home.png';
import RegisterInvitation from '@/components/Home/RegisterInvitation.vue';
import FlashMessage from '@/components/FlashMessage.vue';

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

    <Head title="Home" />
    <FlashMessage />
    <AppLayout>
        <VideoHeader />

        <!-- TODO traduccion api -->
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ $t('home.events') }}</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4 mb-20">
                <EventCard v-for="event in events" :key="event.id" :image="event.featured_image" :title="event.title"
                    :description="event.content" :date="event.event_date" :link="`/events/${event.slug}`" />
            </div>
        </section>

        <DonationBanner :imageUrl="DonationImage" :title="$t('home.donationBanner.title')"
            :description="$t('home.donationBanner.description')" :buttonText="$t('home.donationBanner.buttonText')" />

        <StoreCards />

        <DonationBanner :imageUrl="HazteSocioImage" :title="$t('home.membershipBanner.title')"
            :description="$t('home.membershipBanner.description')" :buttonText="$t('home.membershipBanner.buttonText')"
            buttonUrl="/hazte-socio" />

        <RegisterInvitation />

        <ContactForm />

    </AppLayout>
</template>

<style scoped></style>
