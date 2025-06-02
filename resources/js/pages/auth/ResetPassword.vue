<script setup lang="ts">
import FlashMessage from '@/components/FlashMessage.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <FlashMessage />
    <AuthLayout :title="t('resetPassword.title')" :description="t('resetPassword.description')">

        <Head :title="t('resetPassword.title')" />

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">{{ t('resetPassword.emailLabel') }}</Label>
                    <Input id="email" type="email" name="email" autocomplete="email" v-model="form.email"
                        class="mt-1 block w-full" readonly />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">{{ t('resetPassword.passwordLabel') }}</Label>
                    <Input id="password" type="password" name="password" autocomplete="new-password"
                        v-model="form.password" class="mt-1 block w-full" autofocus
                        :placeholder="t('resetPassword.passwordPlaceholder')" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ t('resetPassword.confirmPasswordLabel') }}</Label>
                    <Input id="password_confirmation" type="password" name="password_confirmation"
                        autocomplete="new-password" v-model="form.password_confirmation" class="mt-1 block w-full"
                        :placeholder="t('resetPassword.confirmPasswordPlaceholder')" />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button class="mt-2 mx-auto" :disabled="form.processing" variant="transparent">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    {{ t('resetPassword.buttonText') }}
                </Button>
            </div>
        </form>
    </AuthLayout>
</template>
