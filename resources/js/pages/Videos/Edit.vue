<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import VideoForm from '@/components/adr/Aulas/VideoForm.vue';
import GoLink from '@/components/adr/GoLink.vue';

const props = defineProps<{ video: any }>();

function onSubmit(form: any) {
    form.put(`/videos/${props.video.id}`);
}
</script>

<template>

    <Head title="Editar Vídeo" />
    <AppLayout>
        <div class="bg-tertiary-color/80">
            <section class="w-full px-4 max-w-3xl mx-auto py-20">
                <Heading title="Editar vídeo" description="Aquí puedes editar los vídeos del templo." />
                <VideoForm :video="props.video" @submit="onSubmit" />
                <GoLink class="mt-6 text-white hover:text-white" :href="route('videos.index')"
                    text="← Volver a la lista de vídeos" />
            </section>
        </div>
    </AppLayout>
</template>
