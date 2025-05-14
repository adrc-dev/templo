<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface Props {
    href: string;
    tabindex?: number;
    method?: string;
    as?: string;
}

defineProps<Props>();
</script>

<template>
    <Link :href="href" :tabindex="tabindex" :method="method" :as="as"
        class="text-white font-bold transition-colors duration-300 hover:text-gray-300">
    <slot />
    </Link>
</template>
