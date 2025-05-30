<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import EventDescription from '@/components/Events/EventDescription.vue';
import EventInfoGrid from '@/components/Events/EventInfoGrid.vue';
import EventActions from '@/components/Events/EventActions.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import GoLink from '@/components/GoLink.vue';
import { router } from '@inertiajs/vue3';

const { event, isSubscribed, suscribeCount } = defineProps<{
    event: any,
    isSubscribed: boolean,
    suscribeCount: number,
}>()

function refreshData() {
    router.reload({ only: ['event', 'isSubscribed'] })
}
</script>

<template>
    <FlashMassage />
    <AppLayout>
        <div class="bg-amber-50">
            <div class="hidden md:block">
                <HeaderBanner :imageUrl="`/storage/${event.featured_image}`" :pageTitle="event.title"
                    class="bg-primary-color/50" />
            </div>
            <section class="w-full px-4 max-w-[1200px] mx-auto">
                <EventDescription :image="event.featured_image" :title="event.title" :content="event.content" />
                <EventInfoGrid :event_date="event.event_date" :event_end_date="event.event_end_date"
                    :event_time="event.event_time" :event_end_time="event.event_end_time" :modality="event.modality"
                    :price="event.price" :currency="event.currency" :location="event.event_location" />
                <EventActions :event="event" :isSubscribed="isSubscribed" :suscribeCount="suscribeCount"
                    @refresh="refreshData" />
                <GoLink href="/events" class="mb-0 pb-12">
                    ← {{ $t('events.eventShow.backToEvents') }}
                </GoLink>
            </section>
        </div>
    </AppLayout>
</template>
