<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/HeaderBanner.vue';
import ShopImage from '@assets/bg-shop.png';
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :pageTitle="$t('shop.title')" class="bg-primary-color/50" :imageUrl="ShopImage" />
        </div>

        <section class="w-full px-4 max-w-[1200px] mx-auto text-primary-color mb-16">
            <h2 class="text-4xl font-bold text-center my-16 tracking-tight">{{ $t('shop.title') }}</h2>
            <p class="text-center text-lg max-w-xl mx-auto leading-relaxed">
                {{ $t('shop.message1') }}<br />
                {{ $t('shop.message2') }}<br />
                {{ $t('shop.message3') }}
            </p>
        </section>
    </AppLayout>
</template>

<style scoped></style>
