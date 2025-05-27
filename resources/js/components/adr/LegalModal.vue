<script setup lang="ts">
const props = defineProps({
    visible: Boolean,
    title: String,
    content: String,
});
const emit = defineEmits(['close']);
const close = () => emit('close');
</script>

<template>
    <Transition name="fade">
        <div v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-primary-color/40"
            @click.self="close">
            <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto rounded-lg shadow-xl p-6 relative">
                <h2 class="text-4xl font-semibold text-primary-color text-center mb-12">{{ title }}</h2>
                <div class="text-primary-color/60 space-y-4" v-html="content"></div>
                <button class="absolute top-3 right-3 text-primary-color/50 hover:text-primary-color cursor-pointer"
                    @click="close">
                    ✕
                </button>
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
