<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Pencil, SquareX } from 'lucide-vue-next';

const props = defineProps<{ videos: any[], title: string }>();
const emit = defineEmits(['delete']);

function onDelete(id: number) {
    if (confirm('¿Estás seguro de que quieres eliminar este vídeo?')) {
        emit('delete', id);
    }
}
</script>

<template>
    <div>
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ title }}</h2>
        <table class="w-full border border-gray-200 rounded shadow-md">
            <thead class="bg-primary-color text-white hidden md:table-header-group">
                <tr>
                    <th class="p-2 text-left">Título</th>
                    <th class="p-2 text-left">Editar</th>
                    <th class="p-2 text-left">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="video in props.videos" :key="video.id"
                    class="border-b text-primary-color odd:bg-white even:bg-gray-200 block md:table-row">
                    <td class="p-2 block md:table-cell">
                        <span class="font-semibold md:hidden">Título: </span>{{ video.title }}
                    </td>
                    <td class="p-2 block md:table-cell">
                        <div class="flex justify-center items-center">
                            <Link :href="`/videos/${video.id}/edit`" class="text-blue-600 hover:text-blue-800">
                            <Pencil />
                            </Link>
                        </div>
                    </td>
                    <td class="p-2 block md:table-cell">
                        <div class="flex justify-center items-center">
                            <button @click="onDelete(video.id)" class="text-red-600 hover:text-red-800">
                                <SquareX />
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
