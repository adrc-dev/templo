<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const show = ref(false);
const message = ref('');

watchEffect(() => {
    const flash = usePage().props.flash;
    if (flash?.message) {
        message.value = flash.message;
        show.value = true;
        setTimeout(() => show.value = false, 3000);
    }
});
</script>


<template>
    <transition name="fade">
        <div v-if="show" class="fixed top-1/5 left-1/2 transform -translate-x-1/2 translate-y-1/5 z-50
               bg-green-100 text-green-800 border border-green-400
               px-4 py-2 rounded shadow text-center">
            {{ usePage().props.flash.message }}
        </div>
    </transition>
</template>
