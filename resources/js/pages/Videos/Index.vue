<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import FlashMessage from '@/components/FlashMessage.vue';
import VideosTable from '@/components/Aulas/VideosTable.vue';
import GoLink from '@/components/GoLink.vue';

const props = defineProps<{ videos: any[] }>();
const videos = ref([...props.videos]);

const premiumVideos = computed(() => videos.value.filter(video => video.is_premium));
const freeVideos = computed(() => videos.value.filter(video => !video.is_premium));

function deleteVideo(id: number) {
    router.delete(`/videos/${id}`, {
        onSuccess: () => {
            videos.value = videos.value.filter(video => video.id !== id);
        }
    });
}
</script>

<template>

    <Head :title="$t('videos.management')" />
    <FlashMessage />

    <AppLayout>
        <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
            <Heading :title="$t('videos.management')" :description="$t('videos.managementDescription')" />
            <div class="flex justify-end">
                <Button @click="$inertia.visit('/videos/create')">{{ $t('videos.newVideo') }}</Button>
            </div>

            <VideosTable :videos="freeVideos" :title="$t('videos.freeVideos')" @delete="deleteVideo" />

            <VideosTable :videos="premiumVideos" :title="$t('videos.premiumVideos')" @delete="deleteVideo" />

            <GoLink class="mt-12" :href="route('aulas.index')" :text="$t('videos.backToAulas')" />
        </section>
    </AppLayout>
</template>
