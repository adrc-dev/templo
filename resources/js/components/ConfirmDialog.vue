<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { computed } from 'vue';

const props = defineProps<{
    show: boolean;
    title: string;
    message: string;
    confirmText?: string;
    confirmColor?: 'red' | 'green' | 'blue' | 'primary';
}>();

const emit = defineEmits(['confirm', 'cancel']);

const confirmButtonClass = computed(() => {
    switch (props.confirmColor) {
        case 'green':
            return 'bg-green-600 hover:bg-green-700';
        case 'blue':
            return 'bg-blue-600 hover:bg-blue-700';
        case 'red':
            return 'bg-red-600 hover:bg-red-700';
        default:
            return 'bg-primary-color hover:bg-primary-color/80';
    }
});
</script>

<template>
    <Transition name="fade">
        <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-primary-color/40"
            @click.self="emit('cancel')">

            <div class="bg-white max-w-sm w-full rounded-lg shadow-xl p-6 relative">
                <button @click="emit('cancel')"
                    class="absolute top-3 right-3 text-primary-color/50 hover:text-primary-color cursor-pointer text-2xl">
                    ✕
                </button>

                <h2 class="text-xl font-semibold text-primary-color text-center mb-4">
                    {{ title }}
                </h2>

                <p class="text-sm text-gray-600 text-center mb-6">{{ message }}</p>

                <div class="flex justify-center gap-4">
                    <Button @click="emit('cancel')" variant="outline"
                        class="border-primary-color text-primary-color hover:bg-primary-color/10">
                        Cancelar
                    </Button>
                    <Button @click="emit('confirm')" :class="`${confirmButtonClass} text-white`">
                        {{ confirmText ?? 'Confirmar' }}
                    </Button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
