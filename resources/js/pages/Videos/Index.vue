<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import FlashMassage from '@/components/FlashMassage.vue';
import VideosTable from '@/components/adr/Aulas/VideosTable.vue';
import GoLink from '@/components/adr/GoLink.vue';

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

    <Head title="Gestión de vídeos" />
    <FlashMassage />

    <AppLayout>
        <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
            <Heading title="Gestión de vídeos" description="Aquí puedes gestionar los vídeos del templo." />
            <div class="flex justify-end">
                <Button @click="$inertia.visit('/videos/create')">Nuevo vídeo</Button>
            </div>

            <VideosTable :videos="freeVideos" title="Vídeos gratuitos" @delete="deleteVideo" />

            <VideosTable :videos="premiumVideos" title="Vídeos premium" @delete="deleteVideo" />

            <GoLink class="mt-12" :href="route('aulas.index')" text="← Volver a Aulas" />
        </section>
    </AppLayout>
</template>
