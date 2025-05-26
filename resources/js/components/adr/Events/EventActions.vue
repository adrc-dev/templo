<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const emit = defineEmits(['refresh']);

const { event, isSubscribed, userRole, suscribeCount } = defineProps<{
    event: any,
    isSubscribed: boolean,
    userRole: string | null,
    suscribeCount: number
}>()

function subscribe() {
    router.post(`/events/${event.slug}/register`, {
        onFinish: () => emit('refresh')
    });
}

function unsubscribe() {
    router.delete(`/events/${event.slug}/unsubscribe`, {
        onFinish: () => emit('refresh')
    });
}
</script>

<template>
    <div>
        <div v-if="userRole === 'admin' || userRole === 'operator'" class="mb-6 text-center relative mx-auto block">
            <Button @click="$inertia.visit(`/events/${event.slug}/attendees`)" class="relative">
                Ver inscritos
                <span v-if="suscribeCount > 0"
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg">
                    {{ suscribeCount }}
                </span>
            </Button>
        </div>

        <Button v-else-if="!isSubscribed" @click="subscribe" class="mx-auto block">
            Inscribirme
        </Button>

        <Button v-else class="bg-red-400 hover:bg-red-700 mx-auto block" @click="unsubscribe">
            Desinscribirme
        </Button>
    </div>
</template>
