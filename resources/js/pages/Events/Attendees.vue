<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import GoLink from '@/components/GoLink.vue'

defineProps<{
    event: {
        id: number
        title: string
        slug: string
    },
    inscritos: {
        id: number
        name: string
        surname: string
        email: string
        phone: string
        pivot: {
            created_at: string
        }
        created_at: string
    }[],
    suscribeCount: number
}>()
</script>

<template>
    <AppLayout>
        <section class="max-w-[1200px] mx-auto px-4 py-10">
            <h1 class="text-3xl font-bold text-primary-color mb-6">
                {{ $t('events.eventAttendees.title', { count: suscribeCount, title: event.title }) }}
            </h1>

            <table class="w-full border border-gray-200 rounded shadow-md">
                <thead class="bg-primary-color text-white hidden md:table-header-group">
                    <tr>
                        <th class="p-2 text-left">{{ $t('events.eventAttendees.name') }}</th>
                        <th class="p-2 text-left">{{ $t('events.eventAttendees.phone') }}</th>
                        <th class="p-2 text-left">{{ $t('events.eventAttendees.email') }}</th>
                        <th class="p-2 text-left">{{ $t('events.eventAttendees.registrationDate') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in inscritos" :key="user.id"
                        class="border-b text-primary-color odd:bg-white even:bg-gray-200 block md:table-row">
                        <!-- Nombre -->
                        <td class="p-2 block md:table-cell">
                            <span class="font-semibold md:hidden">{{ $t('events.eventAttendees.name') }}: </span>
                            {{ user.name }} {{ user.surname }}
                        </td>
                        <!-- Teléfono -->
                        <td class="p-2 hidden md:table-cell">
                            {{ user.phone }}
                        </td>
                        <!-- Email -->
                        <td class="p-2 hidden md:table-cell">
                            {{ user.email }}
                        </td>
                        <!-- Fecha inscripción -->
                        <td class="p-2 block md:table-cell">
                            <span class="font-semibold md:hidden">{{ $t('events.eventAttendees.registrationDate') }}:
                            </span>
                            {{ new Date(user.pivot.created_at).toLocaleString() }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6">
                <GoLink :href="`/events/${event.slug}`">
                    ← {{ $t('events.eventAttendees.backToEvent') }}
                </GoLink>
            </div>
        </section>
    </AppLayout>
</template>
