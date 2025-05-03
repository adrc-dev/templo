<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import headerImage from '@assets/about-us-header.jpeg';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="headerImage" pageTitle="¿Quienes somos?" />


    </AppLayout>
</template>

<style scoped></style>
