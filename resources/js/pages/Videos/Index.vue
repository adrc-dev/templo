<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps(['videos']);
</script>

<template>
    <AppLayout title="Gestión de vídeos">
        <div class="max-w-4xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Gestión de vídeos</h1>

            <Link href="/videos/create"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Nuevo vídeo</Link>

            <table class="w-full mt-4">
                <thead>
                    <tr class="text-left border-b">
                        <th>Título</th>
                        <th>Premium</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="video in videos" :key="video.id" class="border-b">
                        <td>{{ video.title }}</td>
                        <td>{{ video.is_premium ? 'Sí' : 'No' }}</td>
                        <td class="space-x-2">
                            <Link :href="`/videos/${video.id}/edit`" class="text-blue-600">Editar</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
