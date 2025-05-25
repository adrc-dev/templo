<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import EventCard from '@/components/adr/EventCard.vue';
import EventsImage from '@assets/eventos-banner.jpg';
import Button from '@/components/ui/button/Button.vue';

const { events } = defineProps<{
    events: {
        id: number
        title: string
        slug: string
        content: string
        event_date: string
        event_end_date: string | null
        event_time: string
        event_end_time: string | null
        event_location: string
        modality: string
        price: number
        featured_image: string
        is_active: boolean
        created_at: string
        updated_at: string
    }[]
}>()
const upcomingEvent = events[0]
const otherEvents = events.slice(1)
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="EventsImage" pageTitle="Eventos" class="bg-primary-color/50" />
        </div>
        <!-- evento fijo estático -->
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Eventos fijos</h2>
            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
                <img src="@assets/meditacion-online.jpg" alt="Evento fijo"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div>
                    <p class="text-sm text-secondary-color mb-2">Todos los jueves a las 20:00
                    </p>
                    <h2 class="text-3xl font-bold text-primary-color mb-4">Clases de meditación en línea</h2>
                    <p class="text-primary-color mb-4">Te invitamos a conectar contigo mismo y encontrar paz interior
                        desde
                        la comodidad de tu hogar. Cada jueves ofrecemos sesiones de meditación guiada en línea,
                        diseñadas para reducir el estrés, calmar la mente y cultivar la atención plena. No importa si
                        eres principiante o ya tienes experiencia: nuestras clases están abiertas para todos.</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3 text-center text-lg">
                        <div>
                            <span class="block font-semibold text-primary-color">📅 Cuándo</span>
                            <span class="text-primary-color">Todos los jueves</span>
                        </div>
                        <div>
                            <span class="block font-semibold text-primary-color">⏰ Hora</span>
                            <span class="text-primary-color">20:00 - 21:00</span>
                        </div>
                        <div>
                            <span class="block font-semibold text-primary-color">🌐 Modalidad</span>
                            <span class="text-primary-color">Online por Zoom</span>
                        </div>
                    </div>
                    <div class="mt-6 flex align-center justify-center">
                        <Button @click="$inertia.visit('#')" target="_blank">
                            Únete al grupo de WhatsApp
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- proximo evento -->
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Proximo Evento</h2>
            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
                <img :src="upcomingEvent.featured_image" alt="Proximo evento"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div>
                    <p class="text-sm text-secondary-color mb-2">{{ new
                        Date(upcomingEvent.event_date).toLocaleDateString() }}
                    </p>
                    <h2 class="text-3xl font-bold text-primary-color mb-4">{{ upcomingEvent.title }}</h2>
                    <p class="text-primary-color mb-4 line-clamp-8">{{ upcomingEvent.content }}</p>
                    <div class="mt-4 flex justify-center">
                        <Button @click="$inertia.visit(`/events/${upcomingEvent.slug}`)">
                            Más información
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- resto de eventos -->
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Otros Eventos</h2>
            <div class="w-full mx-auto grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-20">
                <EventCard v-for="event in otherEvents" :key="event.id" :image="event.featured_image"
                    :title="event.title" :description="event.content" :date="event.event_date"
                    :link="`/events/${event.slug}`">
                    <!-- Puedes sobrescribir slots si quieres, por ejemplo el botón
                    <template #button>
                        <a :href="`/eventos/${event.id}`"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Más información
                        </a>
                    </template>
-->
                </EventCard>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
