<script setup lang="ts">
import VideoList from './VideoList.vue';
import Button from '@/components/ui/button/Button.vue';

defineProps<{
    title: string,
    videos: any,
}>();
</script>

<template>
    <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ title }}</h2>

    <VideoList v-if="videos && videos.data && videos.data.length" :videos="videos.data" />

    <p v-else class="text-tertiary-color italic">No hay videos por el momento.</p>

    <div class="md:col-span-2 mt-6 flex justify-center gap-2 mb-12">
        <Button v-if="videos.prev_page_url" @click="$inertia.visit(videos.prev_page_url)">Anterior</Button>
        <Button v-if="videos.next_page_url" @click="$inertia.visit(videos.next_page_url)">Siguiente</Button>
    </div>
</template>
