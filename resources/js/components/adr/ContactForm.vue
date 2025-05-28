<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Textarea } from '@/components/ui/textarea';
import { useLegalModal } from '@/composables/useLegalModal';
import { useRecaptcha } from '@/composables/useRecaptcha';

const { openModal } = useLegalModal();


const form = useForm({
    name: '',
    phone: '',
    email: '',
    message: '',
    privacy: false,
    recaptcha_token: '',
});

const { executeRecaptcha } = useRecaptcha();

const submit = async () => {
    const token = await executeRecaptcha('contact');
    form.recaptcha_token = token;
    form.post(route('contact.send'), {
        onSuccess: () => form.reset('message')
        , preserveScroll: true,
    });
};
</script>

<template>
    <section id="contact" class="w-full gradient-bg text-white pb-16">
        <div class="relative z-10">
            <div class="w-full max-w-[1200px] mx-auto text-white mb-16">
                <h2 class="text-4xl font-bold text-center mt-16 tracking-tight">¿Tienes alguna duda?</h2>
                <p class="text-2xl text-center tracking-tight mt-2">¡Entra en contacto!</p>
            </div>

            <div class="w-full max-w-[1200px] flex justify-center items-center mt-8 mx-auto">
                <div class="p-4 w-full md:max-w-[80%] lg:max-w-[60%]">
                    <form @submit.prevent="submit" class="flex flex-col gap-6">

                        <div class="grid gap-2">
                            <Label for="name">Nombre:</Label>
                            <Input id="name" v-model="form.name" type="text" required autofocus placeholder="Nombre" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="md:flex md:space-x-4">
                            <div class="md:w-1/2 grid gap-2">
                                <Label for="phone">Teléfono:</Label>
                                <Input id="phone" v-model="form.phone" type="tel" required placeholder="Teléfono" />
                                <InputError :message="form.errors.phone" />
                            </div>

                            <div class="md:w-1/2 grid gap-2 mt-6 md:mt-0">
                                <Label for="email">Correo electrónico:</Label>
                                <Input id="email" v-model="form.email" type="email" required
                                    placeholder="email@ejemplo.com" />
                                <InputError :message="form.errors.email" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="message">Mensaje:</Label>
                            <Textarea id="message" v-model="form.message" :rows="6" placeholder="Escribe tu mensaje..."
                                required />
                            <InputError :message="form.errors.message" />
                        </div>

                        <div class="flex items-start space-x-3">
                            <Checkbox id="privacy" v-model="form.privacy" required />
                            <Label for="privacy" class="text-base font-medium text-white">
                                Al enviar este formulario acepto la
                                <span @click="openModal('privacyPolicy')"
                                    class="font-bold hover:text-gray-300 cursor-pointer">Política
                                    de
                                    privacidad</span>.
                            </Label>
                        </div>
                        <InputError :message="form.errors.privacy" />

                        <Button type="submit" class="mt-2 w-30 self-center" :disabled="form.processing || !form.privacy"
                            variant="transparent">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Enviar
                        </Button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.gradient-bg {
    position: relative;
    overflow: hidden;
}

.gradient-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("@assets/bg-contact-home.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: 1;
}

.gradient-bg::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(50, 0, 0, 0.9);
    z-index: 2;
}
</style>
