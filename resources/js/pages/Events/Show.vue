<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import EventDescription from '@/components/adr/Events/EventDescription.vue';
import EventInfoGrid from '@/components/adr/Events/EventInfoGrid.vue';
import EventActions from '@/components/adr/Events/EventActions.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import GoLink from '@/components/adr/GoLink.vue';
import { router } from '@inertiajs/vue3';

const { event, isSubscribed, userRole, suscribeCount } = defineProps<{
    event: any,
    isSubscribed: boolean,
    userRole: string | null,
    suscribeCount: number,
}>()

function refreshData() {
    router.reload({ only: ['event', 'isSubscribed'] })
}
</script>

<template>
    <FlashMassage />
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="`/storage/${event.featured_image}`" :pageTitle="event.title"
                class="bg-primary-color/50" />
        </div>
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <EventDescription :image="event.featured_image" :title="event.title" :content="event.content" />
            <EventInfoGrid :event_date="event.event_date" :event_end_date="event.event_end_date"
                :event_time="event.event_time" :event_end_time="event.event_end_time" :modality="event.modality"
                :price="event.price" :currency="event.currency" />
            <EventActions :event="event" :isSubscribed="isSubscribed" :userRole="userRole"
                :suscribeCount="suscribeCount" @refresh="refreshData" />
            <GoLink href="/events">
                ← Volver a eventos
            </GoLink>
        </section>
    </AppLayout>
</template>
