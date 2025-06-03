<script setup lang="ts">
// Props: controlan visibilidad, título y contenido del modal
const props = defineProps({
    visible: Boolean,
    title: String,
    content: String,
});

// Emite evento 'close' al cerrar el modal
const emit = defineEmits(['close']);
const close = () => emit('close');
</script>

<template>
    <!-- Teleporta el modal al <body> para evitar problemas de stacking/contexto -->
    <Teleport to="body">
        <Transition name="fade">
            <!-- Modal: se muestra solo si 'visible' es true -->
            <div v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-primary-color/40"
                @click.self="close"> <!-- Cierra al hacer clic fuera del modal -->
                <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto rounded-lg shadow-xl p-6 relative">
                    <!-- Título centrado -->
                    <h2 class="text-4xl font-semibold text-primary-color text-center mb-12">{{ title }}</h2>
                    <!-- Contenido HTML dinámico -->
                    <div class="text-primary-color/60 space-y-4" v-html="content"></div>
                    <!-- Botón de cierre (esquina superior derecha) -->
                    <button class="absolute top-3 right-3 text-primary-color/50 hover:text-primary-color cursor-pointer"
                        @click="close">
                        ✕
                    </button>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
/* Transición de opacidad para mostrar/ocultar el modal */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
