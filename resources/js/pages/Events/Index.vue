<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import EventsImage from '@assets/eventos-banner.jpg';
import StaticEvent from '@/components/Events/StaticEvent.vue';
import UpcomingEvent from '@/components/Events/UpcomingEvent.vue';
import EventsGrid from '@/components/Events/EventsGrid.vue';
import FlashMessage from '@/components/FlashMessage.vue';

const { events } = defineProps<{ events: any[] }>()
const upcomingEvent = events[0]
const otherEvents = events.slice(1)
</script>

<template>
    <FlashMessage />
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="EventsImage" :pageTitle="$t('events.title')" class="bg-primary-color/50" />
        </div>

        <StaticEvent />
        <UpcomingEvent :event="upcomingEvent" />
        <EventsGrid :events="otherEvents" />
    </AppLayout>
</template>
