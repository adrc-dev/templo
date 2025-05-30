<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { locale } = useI18n();

defineProps<{
    event_date: string,
    event_end_date: string | null,
    event_time: string,
    event_end_time: string | null,
    modality: string,
    price: string,
    currency: string,
    location: string | null
}>();

function formatDate(dateStr: string) {
    const date = new Date(dateStr);
    return date.toLocaleDateString(locale.value, {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
}
</script>

<template>
    <div class="mt-4 mb-20 grid gap-4 sm:grid-cols-5 text-center text-lg">
        <div>
            <span class="block font-semibold text-primary-color">📅 {{ $t('events.eventShow.when') }}</span>
            <span class="text-primary-color">
                {{ formatDate(event_date) }}
            </span>
            <span v-if="event_end_date && event_date !== event_end_date">
                - {{ formatDate(event_end_date) }}
            </span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">⏰ {{ $t('events.eventShow.time') }}</span>
            <span class="text-primary-color">
                {{ event_time }}<span v-if="event_end_time"> - {{ event_end_time }} </span>
            </span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">🌐 {{ $t('events.eventShow.modality') }}</span>
            <span class="text-primary-color">{{ modality }}</span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">💲 {{ $t('events.eventShow.price') }}</span>
            <span v-if="Number(price) <= 0">{{ $t('events.eventShow.free') }}</span>
            <span v-else class="text-primary-color">{{ price }} {{ currency }}</span>
        </div>
        <div>
            <span class="block font-semibold text-primary-color">📍 {{ $t('events.eventShow.location') }}</span>
            <span class="text-primary-color">{{ location }}</span>
        </div>
    </div>
</template>
