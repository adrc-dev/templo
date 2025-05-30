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

function deleteEvent(id: number) {
    router.delete(`/events/${id}`, {
        onSuccess: () => {
            activeEvents.value = activeEvents.value.filter(event => event.id !== id);
            pastEvents.value = activeEvents.value.filter(event => event.id !== id);
            inactiveEvents.value = inactiveEvents.value.filter(event => event.id !== id);
        }
    });
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
                @delete="deleteEvent" />
            <EventsTable :events="pastEvents" :title="$t('events.adminEvents.past_events_title')"
                @delete="deleteEvent" />
            <EventsTable :events="inactiveEvents" :title="$t('events.adminEvents.inactive_events_title')"
                @delete="deleteEvent" />

            <GoLink class="mt-12" :href="route('events.index')" :text="$t('events.adminEvents.back_link')" />
        </section>
    </AppLayout>
</template>
