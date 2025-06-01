<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    surname: user.surname,
    phone: user.phone,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>

    <Head :title="$t('settings.profile.pageTitle')" />

    <AppLayout>
        <SettingsLayout>
            <div class="space-y-6 w-full pt-6 lg:pt-0 md:w-xl">
                <HeadingSmall :title="$t('settings.profile.title')" :description="$t('settings.profile.description')" />

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">{{ $t('settings.profile.nameLabel') }}</Label>
                        <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name"
                            :placeholder="$t('settings.profile.namePlaceholder')" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="surname">{{ $t('settings.profile.surnameLabel') }}</Label>
                        <Input id="surname" class="mt-1 block w-full" v-model="form.surname" required
                            autocomplete="surname" :placeholder="$t('settings.profile.surnamePlaceholder')" />
                        <InputError class="mt-2" :message="form.errors.surname" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">{{ $t('settings.profile.phoneLabel') }}</Label>
                        <Input id="phone" class="mt-1 block w-full" v-model="form.phone" required autocomplete="tel"
                            :placeholder="$t('settings.profile.phonePlaceholder')" />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">{{ $t('settings.profile.emailLabel') }}</Label>
                        <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" placeholder="email@example.com" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-sm text-muted-foreground">
                            {{ $t('settings.profile.emailUnverified') }}
                            <Link :href="route('verification.send')" method="post" as="button"
                                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500">
                            {{ $t('settings.profile.resendVerification') }}
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
                            {{ $t('settings.profile.verificationSent') }}
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">
                            {{ $t('settings.profile.saveButton') }}
                        </Button>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-show="form.recentlySuccessful" class="text-sm text-green-600">
                                {{ $t('settings.profile.savedSuccess') }}
                            </p>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
