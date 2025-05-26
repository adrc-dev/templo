<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'

defineProps<{
    event: any
}>()
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto">
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">Proximo Evento</h2>
        <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
            <img :src="event.featured_image" alt="Proximo evento"
                class="w-full h-90 object-cover rounded-xl shadow-lg" />
            <div>
                <p class="text-sm text-secondary-color mb-2">{{ new Date(event.event_date).toLocaleDateString() }}</p>
                <h2 class="text-3xl font-bold text-primary-color mb-4">{{ event.title }}</h2>
                <p class="text-primary-color mb-4 line-clamp-8">{{ event.content }}</p>
                <div class="mt-4 flex justify-center">
                    <Button @click="$inertia.visit(`/events/${event.slug}`)">Más información</Button>
                </div>
            </div>
        </div>
    </section>
</template>
