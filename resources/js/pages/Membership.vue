<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import SociosImage from '@assets/about-us-header.jpeg';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-vue-next';
import InputError from '@/components/InputError.vue';
import { useRecaptcha } from '@/composables/useRecaptcha';

const form = useForm({
    payment_proof: null,
    recaptcha_token: '',
});

const fileInputRef = ref<HTMLInputElement | null>(null);

const { executeRecaptcha } = useRecaptcha();

const submit = async () => {
    const token = await executeRecaptcha('payment_proof');
    form.recaptcha_token = token;

    form.post(route('member.store'), {
        onSuccess: () => {
            form.reset('payment_proof');
            if (fileInputRef.value) {
                fileInputRef.value.value = '';
            }
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <FlashMassage />
    <AppLayout>

        <div class="hidden md:block">
            <HeaderBanner :imageUrl="SociosImage" :pageTitle="$t('membership.title')" class="bg-primary-color/50" />
        </div>
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ $t('membership.title') }}</h2>

            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center mb-10">
                <img src="@assets/atencion-individual.png" alt="{{ $t('membership.image_alt') }}"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div class="text-primary-color leading-relaxed space-y-4">
                    <p>
                        {{ $t('membership.part1_1') }} <strong>{{ $t('membership.part1_strong') }}</strong>{{
                            $t('membership.part1_2') }}
                    </p>
                    <p>
                        {{ $t('membership.part2_1') }} <strong>{{ $t('membership.part2_strong') }}</strong>{{
                            $t('membership.part2_2') }}
                    </p>
                    <p>
                        {{ $t('membership.part3_1') }} <strong>{{ $t('membership.part3_strong1') }}</strong>{{
                            $t('membership.part3_2') }} <strong>{{ $t('membership.part3_strong2') }}</strong>{{
                            $t('membership.part3_3') }}
                    </p>
                    <p>
                        {{ $t('membership.part4_1') }} <strong>{{ $t('membership.part4_strong') }}</strong>{{
                            $t('membership.part4_2') }}
                    </p>
                </div>
            </div>

            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-stretch mb-20">
                <div class="bg-secondary-color/20 px-6 lg:px-16 py-6 rounded-lg mb-8 max-w-2xl mx-auto h-full">
                    <h3 class="text-2xl font-semibold text-primary-color mb-4">{{ $t('membership.paymentOptions.title')
                    }}</h3>

                    <div class="space-y-6 text-primary-color">
                        <div>
                            <h4 class="text-lg font-medium">{{ $t('membership.paymentOptions.bank_title') }}</h4>
                            <p>{{ $t('membership.paymentOptions.account_holder') }}</p>
                            <p>{{ $t('membership.paymentOptions.iban') }} <strong>{{
                                $t('membership.paymentOptions.iban_number') }}</strong></p>
                            <p>{{ $t('membership.paymentOptions.concept') }} <em>{{
                                $t('membership.paymentOptions.concept_text') }}</em></p>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium">{{ $t('membership.paymentOptions.bizum_title') }}</h4>
                            <p>{{ $t('membership.paymentOptions.phone') }} <strong>{{
                                $t('membership.paymentOptions.phone_number') }}</strong></p>
                            <p>{{ $t('membership.paymentOptions.concept') }} <em>{{
                                $t('membership.paymentOptions.concept_text') }}</em></p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm text-tertiary-color">{{ $t('membership.paymentOptions.instructions') }}</p>
                </div>

                <div
                    class="max-w-xl mx-auto bg-primary-color px-6 lg:px-16 py-6 rounded-lg shadow-lg h-full flex flex-col justify-center">
                    <p class="mb-10 text-white">
                        {{ $t('membership.paymentOptions.upload_description') }}
                    </p>

                    <form @submit.prevent="submit">
                        <input type="file" ref="fileInputRef" @change="e => form.payment_proof = e.target.files[0]"
                            required
                            class="text-white bg-primary-color border border-secondary-color rounded-lg px-3 py-2
            file:bg-primary-color file:text-secondary-color file:border-0 file:rounded file:px-4 file:py-2 file:cursor-pointer" />
                        <InputError :message="form.errors.payment_proof" />

                        <div class="flex justify-center mt-12">
                            <Button type="submit" :disabled="form.processing" variant="transparent">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                {{ $t('membership.paymentOptions.submit_button') }}
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
