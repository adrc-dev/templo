<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import EventsImage from '@assets/eventos-banner.jpg';
import StaticEvent from '@/components/adr/Events/StaticEvent.vue';
import UpcomingEvent from '@/components/adr/Events/UpcomingEvent.vue';
import EventsGrid from '@/components/adr/Events/EventsGrid.vue';

const { events } = defineProps<{ events: any[] }>()
const upcomingEvent = events[0]
const otherEvents = events.slice(1)
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="EventsImage" pageTitle="Eventos" class="bg-primary-color/50" />
        </div>

        <StaticEvent />
        <UpcomingEvent :event="upcomingEvent" />
        <EventsGrid :events="otherEvents" />
    </AppLayout>
</template>
