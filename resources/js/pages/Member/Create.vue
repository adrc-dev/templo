<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import FlashMassage from '@/components/FlashMassage.vue';

const form = useForm({
    payment_proof: null,
});

function submit() {
    form.post(route('member.store'));
}
</script>

<template>
    <FlashMassage />
    <AppLayout>
        <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Hazte socio</h2>
            <p class="mb-4 text-gray-600">Envía una imagen o PDF del comprobante de pago. El equipo lo validará
                manualmente.</p>

            <form @submit.prevent="submit">
                <input type="file" @change="e => form.payment_proof = e.target.files[0]" required
                    class="mb-4 w-full border p-2 rounded" />

                <button type="submit" class="bg-primary-color text-white px-4 py-2 rounded hover:bg-opacity-80"
                    :disabled="form.processing">
                    Enviar solicitud
                </button>
            </form>
        </div>
    </AppLayout>
</template>
