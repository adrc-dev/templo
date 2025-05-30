<script setup lang="ts">
import EventCard from '@/components/EventCard.vue'

defineProps<{
    events: any[]
}>()
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto">
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ $t('events.otherEvents.title') }}</h2>
        <div class="w-full mx-auto grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-20">
            <EventCard v-for="event in events" :key="event.id" :image="event.featured_image" :title="event.title"
                :description="event.content" :date="event.event_date" :link="`/events/${event.slug}`" />
        </div>
    </section>
</template>
