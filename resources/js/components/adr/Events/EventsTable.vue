<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Pencil, SquareX } from 'lucide-vue-next';

const props = defineProps<{ events: any[], title: string }>();
const emit = defineEmits(['delete']);

function formatDate(dateStr: string): string {
    const date = new Date(dateStr);
    return new Intl.DateTimeFormat('es-ES').format(date);
}

function formatTime(timeStr: string): string {
    const [hours, minutes] = timeStr.split(':');
    const date = new Date();
    date.setHours(parseInt(hours), parseInt(minutes));
    return new Intl.DateTimeFormat('es-ES', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    }).format(date);
}

function onDelete(slug: string) {
    if (confirm('¿Estás seguro de que quieres eliminar este evento?')) {
        emit('delete', slug);
    }
}

function toggleStatus(event: any) {
    router.put(`/events/${event.slug}/toggle`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            event.is_active = !event.is_active;
        }
    });
}
</script>

<template>
    <div>
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ title }}</h2>
        <table class="w-full border border-gray-200 rounded shadow-md">
            <thead class="bg-primary-color text-white hidden md:table-header-group">
                <tr>
                    <th class="p-2 text-left">Título</th>
                    <th class="p-2 text-left">Fecha y hora</th>
                    <th class="p-2 text-left">Activo</th>
                    <th class="p-2 text-left">Editar</th>
                    <th class="p-2 text-left">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in props.events" :key="event.id"
                    class="border-b text-primary-color odd:bg-white even:bg-gray-200 block md:table-row">
                    <td class="p-2 block md:table-cell">
                        <span class="font-semibold md:hidden">Título: </span>{{ event.title }}
                    </td>
                    <td class="p-2 block md:table-cell">
                        <span class="font-semibold md:hidden">Fecha y hora: </span>
                        {{ formatDate(event.event_date) }} - {{ formatTime(event.event_time) }}
                    </td>
                    <td class="p-2 block md:table-cell">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold md:hidden">Activo:</span>
                            <label class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" :checked="event.is_active" @change="toggleStatus(event)"
                                    class="sr-only peer" />
                                <div
                                    class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-primary-color peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-color transition-colors">
                                </div>
                                <div
                                    class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 transform peer-checked:translate-x-5">
                                </div>
                            </label>
                        </div>
                    </td>
                    <td class="p-2 block md:table-cell">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold md:hidden">Editar:</span>
                            <Link :href="`/events/${event.slug}/edit`" class="text-blue-600 hover:text-blue-800">
                            <Pencil />
                            </Link>
                        </div>
                    </td>
                    <td class="p-2 block md:table-cell">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold md:hidden">Eliminar:</span>
                            <button @click="onDelete(event.slug)" class="text-red-600 hover:text-red-800">
                                <SquareX />
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
