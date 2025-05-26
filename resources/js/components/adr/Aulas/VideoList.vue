<script setup lang="ts">
import VideoCard from './VideoCard.vue';
import { ref } from 'vue';

const props = defineProps<{
    videos: any[]
}>();

const videosWithToggle = ref(props.videos.map(video => ({
    ...video,
    showFull: false,
})));

function toggleDescription(index: number) {
    videosWithToggle.value[index].showFull = !videosWithToggle.value[index].showFull;
}
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <VideoCard v-for="(video, index) in videosWithToggle" :key="video.id" :video="video"
            :toggleDescription="() => toggleDescription(index)" />
    </div>
</template>
