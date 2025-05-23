<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import FlashMassage from '@/components/FlashMassage.vue';

const { event, isSubscribed, userRole } = defineProps<{
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
    },
    isSubscribed: boolean,
    userRole: string | null,
}>()

function subscribe() {
    router.post(`/events/${event.slug}/register`, {
        onFinish: () => router.reload({ only: ['event', 'isSubscribed'] })
    });
}

function unsubscribe() {
    router.delete(`/events/${event.slug}/unsubscribe`, {
        onFinish: () => router.reload({ only: ['event', 'isSubscribed'] })
    });
}
</script>

<template>
    <FlashMassage />

    <AppLayout>
        <div class="hidden md:block ">
            <HeaderBanner :imageUrl="event.featured_image" :pageTitle="event.title" class="bg-primary-color/50" />
        </div>
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <!-- boton admin -->
            <div v-if="userRole === 'admin' || userRole === 'operator'" class="mb-6 text-center">
                <Link :href="`/events/${event.id}/attendees`"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-20">
                Ver inscritos
                </Link>
            </div>

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

                <!-- Botones de inscribirse y desinscribirse -->
                <div>
                    <Button v-if="!isSubscribed" @click="subscribe"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mx-auto block">
                        Inscribirme
                    </Button>
                    <Button v-else class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mx-auto block"
                        @click="unsubscribe">
                        Desinscribirme

                    </Button>
                </div>
                <Link href="/events"
                    class="text-primary-color font-semibold hover:underline flex items-center gap-2 my-6">
                ← Volver a eventos
                </Link>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
