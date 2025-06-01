<script setup lang="ts">
import { computed } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps<{
    message?: string | string[];
}>();

const translatedMessage = computed(() => {
    if (!props.message) return '';

    // Si es un array de mensajes
    if (Array.isArray(props.message)) {
        return props.message.map(msg => t(msg)).join(', ');
    }

    // Si es un string simple
    return t(props.message);
});
</script>

<template>
    <div v-show="translatedMessage">
        <p class="text-sm text-red-500">
            {{ translatedMessage }}
        </p>
    </div>
</template>
