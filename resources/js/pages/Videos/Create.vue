<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import VideoForm from '@/components/Aulas/VideoForm.vue';
import GoLink from '@/components/GoLink.vue';

function onSubmit(form: any) {
    form.post('/videos');
}
</script>

<template>

    <Head :title="$t('videos.createVideo')" />
    <AppLayout>
        <div class="bg-tertiary-color/80">
            <section class="w-full px-4 max-w-3xl mx-auto py-20">
                <Heading :title="$t('videos.createVideo')" :description="$t('videos.createDescription')" />
                <VideoForm @submit="onSubmit" />
                <GoLink class="mt-6 text-white hover:text-white" :href="route('videos.index')"
                    :text="$t('videos.backToList')" />
            </section>
        </div>
    </AppLayout>
</template>
