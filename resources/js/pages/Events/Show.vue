<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';

const { event } = defineProps<{
    event: {
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
        currency: string
        featured_image: string
        is_active: boolean
        created_at: string
        updated_at: string
    }[]
}>()
</script>

<template>
    <AppLayout>
        <div class="hidden md:block ">
            <HeaderBanner :imageUrl="event.featured_image" :pageTitle="event.title" class="bg-primary-color/50" />
        </div>
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <img :src="event.featured_image" alt="Evento fijo"
                class="w-full max-h-[600px] object-cover rounded-xl shadow-lg mt-6 md:mt-20" />
            <div>
                <!-- titulo -->
                <h2 class="text-4xl font-bold text-center text-primary-color my-10">{{ event.title }}</h2>
                <!-- descripción -->
                <p class="text-primary-color mb-10 max-w-3xl mx-auto">{{ event.content }}</p>
                <!-- información extra -->
                <div class="mt-4 mb-20 grid gap-4 sm:grid-cols-4 text-center text-lg">
                    <div>
                        <span class="block font-semibold text-primary-color">📅 Cuándo</span>
                        <span class="text-primary-color">
                            {{ new Date(event.event_date).toLocaleDateString('es-ES', {
                                day: 'numeric', month: 'long',
                                year: 'numeric'
                            }) }}
                        </span>
                        <span v-if="event.event_end_date && event.event_date !== event.event_end_date">
                            - {{ new Date(event.event_end_date).toLocaleDateString('es-ES', {
                                day: 'numeric', month:
                                    'long', year: 'numeric'
                            }) }}
                        </span>
                    </div>
                    <div>
                        <span class="block font-semibold text-primary-color">⏰ Hora</span>
                        <span class="text-primary-color">
                            {{ event.event_time }} - {{ event.event_end_time }}
                        </span>
                    </div>
                    <div>
                        <span class="block font-semibold text-primary-color">🌐 Modalidad</span>
                        <span class="text-primary-color">
                            {{ event.modality }}
                        </span>
                    </div>
                    <div>
                        <span class="block font-semibold text-primary-color">💲 Precio</span>
                        <span v-if="event.price <= 0">Gratuito</span>
                        <span v-else class="text-primary-color">
                            {{ event.price }} {{ event.currency }}
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
