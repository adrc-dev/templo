<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';
import { useI18n } from 'vue-i18n';
const { t } = useI18n();

const show = ref(false);
const message = ref('');
const type = ref<'success' | 'error' | null>(null);

interface FlashMessage {
    success?: string;
    error?: string;
}

// Observa los flash messages de Inertia y actualiza el estado
watchEffect(() => {
    const flash = usePage().props.flash as FlashMessage;

    if (flash?.success) {
        message.value = flash.success;
        type.value = 'success';
        show.value = true;
        setTimeout(() => show.value = false, 3000); // Oculta tras 3 segundos
    } else if (flash?.error) {
        message.value = flash.error;
        type.value = 'error';
        show.value = true;
        setTimeout(() => show.value = false, 3000);
    }
});
</script>

<template>
    <transition name="fade">
        <!-- Notificación con estilos condicionales según el tipo -->
        <div v-if="show" :class="[
            'fixed z-[9999] top-1/5 left-1/2 transform -translate-x-1/2 translate-y-1/5 px-4 py-2 rounded shadow text-center border',
            type === 'success' ? 'bg-green-100 text-green-800 border-green-400' :
                type === 'error' ? 'bg-red-100 text-red-800 border-red-400' :
                    ''
        ]">
            {{ t(message) }}
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
