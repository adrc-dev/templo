<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import SociosImage from '@assets/about-us-header.jpeg';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { LoaderCircle } from 'lucide-vue-next';

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
        <HeaderBanner :imageUrl="SociosImage" pageTitle="¡Hazte socio!" class="bg-primary-color/50" />
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">¡Hazte socio!</h2>

            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center mb-10">
                <img src="@assets/atencion-individual.png" alt="Evento fijo"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div class="text-primary-color leading-relaxed space-y-4">
                    <p>Al hacerte socio, obtienes acceso ilimitado a <strong>todas las clases</strong>, tanto gratuitas
                        como de pago.</p>
                    <p>Además, disfrutas de <strong>descuentos exclusivos en la tienda</strong> y productos especiales
                        para miembros.</p>
                    <p>Tu contribución también es una forma directa de <strong>apoyar la continuidad del
                            templo</strong>, permitiendo que siga ofreciendo enseñanzas y <strong>acciones
                            sociales</strong> para la comunidad.</p>
                    <p>Por tan solo <strong>20 € al mes</strong>, podrás disfrutar de todos los beneficios: acceso a
                        todas las clases, descuentos exclusivos y la satisfacción de apoyar una causa significativa.</p>
                </div>
            </div>

            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-stretch mb-20">
                <div class="bg-secondary-color/20 px-6 lg:px-16 py-6 rounded-lg mb-8 max-w-2xl mx-auto h-full">
                    <h3 class="text-2xl font-semibold text-primary-color mb-4">Opciones de pago</h3>

                    <div class="space-y-6 text-primary-color">
                        <div>
                            <h4 class="text-lg font-medium">💳 Transferencia bancaria</h4>
                            <p>Titular: Asociación Budista Templo del Dharma</p>
                            <p>IBAN: <strong>ES12 3456 7890 1234 5678 9012</strong></p>
                            <p>Concepto: <em>Tu nombre + Cuota socio</em></p>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium">📱 Bizum</h4>
                            <p>Número: <strong>655255355</strong></p>
                            <p>Concepto: <em>Tu nombre + Cuota socio</em></p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm text-tertiary-color">Una vez realizado el pago, sube el comprobante en el
                        formulario
                        para validar tu membresía.</p>
                </div>

                <div
                    class="max-w-xl mx-auto bg-primary-color px-6 lg:px-16 py-6 rounded-lg shadow-lg h-full flex flex-col justify-center">
                    <p class="mb-10 text-white">
                        Envía una imagen o PDF del comprobante de pago. El equipo validará manualmente tu solicitud y
                        activará
                        tu membresía.
                    </p>

                    <form @submit.prevent="submit">
                        <Input type="file" @change="e => form.payment_proof = e.target.files[0]" required
                            class="mb-10 w-full border p-2 rounded text-white" />

                        <Button type="submit" class="mt-2 w-full" :disabled="form.processing" variant="transparent">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Enviar comprobante
                        </Button>
                    </form>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
