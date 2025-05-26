<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: string
}>();
</script>

<template>
    <Link :href="href"
        class="text-xl text-primary-color hover:text-tertiary-color my-8 block text-left font-medium cursor-pointer">
    <slot />
    </Link>
</template>
