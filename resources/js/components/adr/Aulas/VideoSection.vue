<script setup lang="ts">
import VideoList from './VideoList.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';

defineProps<{
    title: string,
    videos: any,
}>();
</script>

<template>
    <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ title }}</h2>

    <VideoList v-if="videos && videos.data && videos.data.length" :videos="videos.data" />
    <p v-else class="text-tertiary-color italic">No hay videos por el momento.</p>

    <Pagination :pagination="videos" class="mb-12" />
</template>
