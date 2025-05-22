<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['video']);

const form = useForm({
    title: props.video?.title ?? '',
    youtube_id: props.video?.youtube_id ?? '',
    description: props.video?.description ?? '',
    is_premium: props.video?.is_premium ?? false,
});
</script>

<template>
    <AppLayout title="Editar vídeo">
        <div class="max-w-xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">{{ props.video ? 'Editar vídeo' : 'Crear vídeo' }}</h1>

            <form @submit.prevent="props.video ? form.put(`/videos/${props.video.id}`) : form.post('/videos')">
                <div class="mb-4">
                    <label class="block mb-1">Título</label>
                    <input v-model="form.title" class="w-full border rounded p-2" required />
                </div>

                <div class="mb-4">
                    <label class="block mb-1">ID de YouTube</label>
                    <input v-model="form.youtube_id" class="w-full border rounded p-2" required />
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea v-model="form.description" class="w-full border rounded p-2"></textarea>
                </div>

                <div class="mb-4">
                    <label>
                        <input type="checkbox" v-model="form.is_premium" />
                        ¿Es un vídeo premium?
                    </label>
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Guardar
                </button>
            </form>
        </div>
    </AppLayout>
</template>
