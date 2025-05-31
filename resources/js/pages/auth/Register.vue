<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useRecaptcha } from '@/composables/useRecaptcha';

const form = useForm({
    name: '',
    surname: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    recaptcha_token: '',
});

const { executeRecaptcha } = useRecaptcha();

const submit = async () => {
    const token = await executeRecaptcha('register');
    form.recaptcha_token = token;
    form.email = form.email.toLowerCase();
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase :title="$t('register.title')" :description="$t('register.description')">

        <Head :title="$t('register.page_title')" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <!-- Nombre -->
                <div class="grid gap-2">
                    <Label for="name">{{ $t('register.name_label') }}</Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name"
                        v-model="form.name" :placeholder="$t('register.name_placeholder')" />
                    <InputError :message="form.errors.name" />
                </div>

                <!-- Apellidos -->
                <div class="grid gap-2">
                    <Label for="surname">{{ $t('register.surname_label') }}</Label>
                    <Input id="surname" type="text" required :tabindex="2" autocomplete="surname" v-model="form.surname"
                        :placeholder="$t('register.surname_placeholder')" />
                    <InputError :message="form.errors.surname" />
                </div>

                <!-- Teléfono -->
                <div class="grid gap-2">
                    <Label for="phone">{{ $t('register.phone_label') }}</Label>
                    <Input id="phone" type="tel" required :tabindex="3" autocomplete="tel" v-model="form.phone"
                        :placeholder="$t('register.phone_placeholder')" />
                    <InputError :message="form.errors.phone" />
                </div>

                <!-- Email -->
                <div class="grid gap-2">
                    <Label for="email">{{ $t('register.email_label') }}</Label>
                    <Input id="email" type="email" required :tabindex="4" autocomplete="email" v-model="form.email"
                        placeholder="email@exemplo.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <!-- Contraseña -->
                <div class="grid gap-2">
                    <Label for="password">{{ $t('register.password_label') }}</Label>
                    <Input id="password" type="password" required :tabindex="5" autocomplete="new-password"
                        v-model="form.password" :placeholder="$t('register.password_placeholder')" />
                    <InputError :message="form.errors.password" />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ $t('register.confirm_password_label') }}</Label>
                    <Input id="password_confirmation" type="password" required :tabindex="6" autocomplete="new-password"
                        v-model="form.password_confirmation"
                        :placeholder="$t('register.confirm_password_placeholder')" />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <!-- Botón de Registro -->
                <Button type="submit" class="mt-2 w-40 mx-auto" tabindex="7" :disabled="form.processing"
                    variant="transparent">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    {{ $t('register.submit_button') }}
                </Button>
            </div>

            <!-- Enlace a Login -->
            <div class="text-center text-sm text-white">
                {{ $t('register.already_registered') }}
                <TextLink :href="route('login')" :tabindex="8">{{ $t('register.login_link') }}</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
