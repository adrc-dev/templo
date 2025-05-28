<script setup lang="ts">
import { ref } from 'vue';
import Button from '@/components/ui/button/Button.vue';
import Modal from '@/components/LegalModal.vue';

defineProps<{
    imageUrl: string
    title: string
    description: string
    buttonText: string
    buttonUrl?: string
}>()

const showModal = ref(false)
const modalTitle = 'Tu apoyo hace la diferencia 🧘‍♂️';
const modalContent = `<div class="bg-secondary-color/20 px-6 lg:px-16 py-6 rounded-lg mb-8 max-w-2xl mx-auto h-full">
    <div class="space-y-6 text-primary-color">
        <div>
            <h4 class="text-lg font-medium">💳 Transferencia bancaria</h4>
            <p>Titular: Asociación Budista Templo del Dharma</p>
            <p>IBAN: <strong>ES12 3456 7890 1234 5678 9012</strong></p>
            <p>Concepto: <em>Tu nombre (caso quieras identificarte)</em></p>
        </div>

        <div>
            <h4 class="text-lg font-medium">📱 Bizum</h4>
            <p>Número: <strong>655255355</strong></p>
            <p>Concepto: <em>Tu nombre (caso quieras identificarte)</em></p>
        </div>

        <div class="flex flex-col items-center">
            <a href="https://wa.me/5511989964269" target="_blank" rel="noopener" class="inline-block bg-primary-color text-white text-center px-6 py-3 rounded-lg hover:bg-primary-color/80 transition">
                Enviar comprobante por WhatsApp
            </a>
        </div>
    </div>
</div>`;
</script>

<template>
    <div class="donation-container w-full bg-cover min-h-[500px] flex items-center justify-center relative"
        :style="{ backgroundImage: `url(${imageUrl})` }">
        <div class="w-full max-w-[1200px] flex flex-col justify-center items-center text-center relative z-10 mx-4">
            <h2 class="text-4xl font-bold text-white mb-4">{{ title }}</h2>
            <p class="text-lg text-white mb-8">{{ description }}</p>
            <Button @click="buttonUrl ? $inertia.visit(buttonUrl) : (showModal = true)" variant="transparent">
                {{ buttonText }}
            </Button>
        </div>

        <Modal :visible="showModal" :title="modalTitle" :content="modalContent" @close="showModal = false" />
    </div>
</template>

<style scoped>
.donation-container::after {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background: var(--primary-color);
    opacity: 0.8;
    pointer-events: none;
}
</style>
