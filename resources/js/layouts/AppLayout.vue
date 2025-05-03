<script setup lang="ts">
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
</script>

<template>
    <div class="background-container bg-white relative overflow-hidden w-full mx-auto min-h-screen flex flex-col">
        <Header />

        <main class="z-1">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<style scoped>
.background-container::before {
    content: "";
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 100%;
    width: 100%;
    max-width: 1512px;
    background: url("@assets/bg.png") no-repeat left bottom fixed;
    background-size: 1200px;
    opacity: 0.2;
    pointer-events: none;
}

@media (max-width: 768px) {
    .background-container::before {
        background-position: left bottom;
        background-size: 600px;
        /* o usa 'contain' si prefieres que no recorte */
    }
}
</style>
