<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';

import EventsImage from '@assets/eventos-banner.jpg';

defineProps({
    events: Array as () => {
        id: number,
        title: string,
        date: string,
        description: string,
        image: string
    }[]
})

const upcomingEvent = events[0]
const otherEvents = events.slice(1)
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="EventsImage" pageTitle="Eventos" class="bg-primary-color/50" />

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Proximo Evento</h2>
            <div class="max-w-6xl mx-auto py-12 px-4 grid md:grid-cols-2 gap-6 items-center">
                <img :src="upcomingEvent.image" alt="Evento principal"
                    class="w-full h-80 object-cover rounded-xl shadow-lg" />
                <div>
                    <p class="text-sm text-secondary-color mb-2">{{ new Date(upcomingEvent.date).toLocaleDateString() }}
                    </p>
                    <h2 class="text-3xl font-bold text-primary-color mb-4">{{ upcomingEvent.title }}</h2>
                    <p class="text-gray-700 mb-4">{{ upcomingEvent.description }}</p>
                    <a :href="`/eventos/${upcomingEvent.id}`"
                        class="inline-block bg-primary-color text-white px-6 py-2 rounded shadow hover:bg-opacity-90 transition">
                        Más información
                    </a>
                </div>
            </div>
        </section>

        <!-- Otros eventos -->
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Otros Eventos</h2>
            <div class="max-w-6xl mx-auto py-6 px-4 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="event in otherEvents" :key="event.id"
                    class="bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition">
                    <img :src="event.image" alt="event" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <p class="text-xs text-secondary-color mb-1">{{ new Date(event.date).toLocaleDateString() }}</p>
                        <h3 class="text-lg font-semibold text-primary-color mb-2">{{ event.title }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ event.description }}</p>
                        <a :href="`/eventos/${event.id}`"
                            class="text-sm text-primary-color font-medium hover:underline mt-2 inline-block">
                            Ver evento
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
