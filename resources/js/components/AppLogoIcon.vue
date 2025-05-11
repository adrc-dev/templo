<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import LogoClaro from '@assets/logo-claro.svg';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="LogoClaro" alt="logo claro" />
</template>
