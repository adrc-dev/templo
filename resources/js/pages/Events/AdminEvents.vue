<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import FlashMassage from '@/components/FlashMassage.vue';
import EventsTable from '@/components/Events/EventsTable.vue';
import GoLink from '@/components/GoLink.vue';

const props = defineProps<{
    activeEvents: any[],
    pastEvents: any[],
    inactiveEvents: any[]
}>();

const activeEvents = ref([...props.activeEvents]);
const pastEvents = ref([...props.pastEvents]);
const inactiveEvents = ref([...props.inactiveEvents]);

function deleteEvent(event: any) {
    router.delete(`/events/${event.slug}`, {
        preserveScroll: true,
        onSuccess: () => {
            activeEvents.value = activeEvents.value.filter(e => e.slug !== event.slug);
            pastEvents.value = pastEvents.value.filter(e => e.slug !== event.slug);
            inactiveEvents.value = inactiveEvents.value.filter(e => e.slug !== event.slug);
        }
    });
}

function handleToggle(updatedEvent: any) {
    activeEvents.value = activeEvents.value.filter(e => e.slug !== updatedEvent.slug);
    pastEvents.value = pastEvents.value.filter(e => e.slug !== updatedEvent.slug);
    inactiveEvents.value = inactiveEvents.value.filter(e => e.slug !== updatedEvent.slug);

    // Determina a qué lista pertenece ahora
    const today = new Date();
    const eventDate = new Date(updatedEvent.event_date);

    if (eventDate < today) {
        pastEvents.value.push(updatedEvent);
    } else if (updatedEvent.is_active) {
        activeEvents.value.push(updatedEvent);
    } else {
        inactiveEvents.value.push(updatedEvent);
    }
}
</script>

<template>

    <Head :title="$t('events.adminEvents.page_title')" />
    <FlashMassage />
    <AppLayout>
        <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
            <Heading :title="$t('events.adminEvents.heading_title')"
                :description="$t('events.adminEvents.heading_description')" />
            <div class="flex justify-end">
                <Button @click="$inertia.visit('/events/create')">
                    {{ $t('events.adminEvents.new_event_button') }}
                </Button>
            </div>

            <EventsTable :events="activeEvents" :title="$t('events.adminEvents.active_events_title')"
                @delete="deleteEvent" @toggle="handleToggle" />
            <EventsTable :events="pastEvents" :title="$t('events.adminEvents.past_events_title')" @delete="deleteEvent"
                @toggle="handleToggle" />
            <EventsTable :events="inactiveEvents" :title="$t('events.adminEvents.inactive_events_title')"
                @delete="deleteEvent" @toggle="handleToggle" />

            <GoLink class="mt-12" :href="route('events.index')" :text="$t('events.adminEvents.back_link')" />
        </section>
    </AppLayout>
</template>
