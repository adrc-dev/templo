<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import FlashMassage from '@/components/FlashMassage.vue';
import EventsTable from '@/components/adr/Events/EventsTable.vue';
import GoLink from '@/components/adr/GoLink.vue';

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

    <Head title="Gestión de eventos" />
    <FlashMassage />

    <AppLayout>
        <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
            <Heading title="Gestión de eventos" description="Aquí puedes gestionar los eventos del templo." />
            <div class="flex justify-end">
                <Button @click="$inertia.visit('/events/create')">Nuevo evento</Button>
            </div>

            <EventsTable :events="activeEvents" title="Próximos eventos activos" @delete="deleteEvent" />
            <EventsTable :events="pastEvents" title="Eventos activos pasados" @delete="deleteEvent" />
            <EventsTable :events="inactiveEvents" title="Eventos inactivos" @delete="deleteEvent" />

            <GoLink class="mt-12" :href="route('events.index')" text="← Volver a Eventos" />
        </section>
    </AppLayout>
</template>
