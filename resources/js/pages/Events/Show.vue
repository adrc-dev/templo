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
        featured_image: string
        is_active: boolean
        created_at: string
        updated_at: string
    }[]
}>()
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="event.featured_image" :pageTitle="event.title" class="bg-primary-color/50" />
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ event.title }}</h2>
            <img :src="event.featured_image" alt="Evento fijo"
                class="w-full h-auto object-cover rounded-xl shadow-lg" />
            <div>
                <div class="mt-4 grid gap-4 sm:grid-cols-3 text-center text-lg">
                    <div>
                        <span class="block font-semibold text-primary-color">📅 Cuándo</span>
                        <span class="text-primary-color">{{ event.event_date }}</span>
                    </div>
                    <div>
                        <span class="block font-semibold text-primary-color">⏰ Hora</span>
                        <span class="text-primary-color">{{ event.event_time }} - {{ event.event_end_time }}</span>
                    </div>
                    <div>
                        <span class="block font-semibold text-primary-color">🌐 Modalidad</span>
                        <span class="text-primary-color">{{ event.modality }}</span>
                    </div>
                </div>

                <p class="text-primary-color mb-4">{{ event.content }}</p>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
