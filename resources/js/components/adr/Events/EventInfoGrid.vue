<script setup lang="ts">
defineProps<{
    event_date: string,
    event_end_date: string | null,
    event_time: string,
    event_end_time: string | null,
    modality: string,
    price: string,
    currency: string
}>()
</script>

<template>
    <div class="mt-4 mb-20 grid gap-4 sm:grid-cols-4 text-center text-lg">
        <div>
            <span class="block font-semibold text-primary-color">📅 Cuándo</span>
            <span class="text-primary-color">
                {{ new Date(event_date).toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' })
                }}
            </span>
            <span v-if="event_end_date && event_date !== event_end_date">
                - {{ new Date(event_end_date).toLocaleDateString('es-ES', {
                    day: 'numeric', month: 'long', year:
                        'numeric'
                }) }}
            </span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">⏰ Hora</span>
            <span class="text-primary-color">
                {{ event_time }} - {{ event_end_time }}
            </span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">🌐 Modalidad</span>
            <span class="text-primary-color">{{ modality }}</span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">💲 Precio</span>
            <span v-if="price <= 0">Gratuito</span>
            <span v-else class="text-primary-color">{{ price }} {{ currency }}</span>
        </div>
    </div>
</template>
