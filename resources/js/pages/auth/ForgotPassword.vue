<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import FlashMessage from '@/components/FlashMessage.vue';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>

    <FlashMessage />
    <AuthLayout :title="$t('forgotPassword.title')" :description="$t('forgotPassword.description')">

        <Head :title="$t('forgotPassword.page_title')" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="space-y-6">
            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="email">{{ $t('forgotPassword.email_label') }}</Label>
                    <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email" autofocus
                        placeholder="email@exemplo.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button class="mt-2 w-30 mx-auto" :disabled="form.processing" variant="transparent">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        {{ $t('forgotPassword.submit_button') }}
                    </Button>
                </div>
            </form>

            <div class="space-x-1 text-center text-sm text-white">
                <span>{{ $t('forgotPassword.or_text') }}</span>
                <TextLink :href="route('login')">{{ $t('forgotPassword.login_link') }}</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
