<script setup lang="ts">
import { ref, computed } from 'vue';
import { Button } from '@/components/ui/button';

const props = defineProps<{
    show: boolean;
    user: any;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'activate', userId: number): void;
    (e: 'cancel', membershipId: number): void; // Nuevo evento
}>();

function formatToSpanishDateTime(isoDate: Date | string) {
    const date = new Date(isoDate);
    return date.toLocaleString('es-ES', {
        timeZone: 'Europe/Madrid',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
}

const pendingMemberships = computed(() => {
    return props.user?.memberships?.filter(m => m.status === 'pending') || [];
});
const activeMemberships = computed(() => {
    return props.user?.memberships?.filter(m => m.status === 'active') || [];
});
const expiredMemberships = computed(() => {
    return props.user?.memberships?.filter(m => m.status === 'expired') || [];
});
</script>

<template>
    <Transition name="fade">
        <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-primary-color/40"
            @click.self="emit('close')">
            <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto rounded-lg shadow-xl p-6 relative">
                <button @click="emit('close')"
                    class="absolute top-3 right-3 text-primary-color/50 hover:text-primary-color cursor-pointer text-2xl">
                    ✕
                </button>

                <h2 class="text-4xl font-semibold text-primary-color text-center mb-12">
                    Comprobantes de {{ user?.name }} {{ user?.surname }}
                </h2>

                <div v-if="pendingMemberships.length" class="mb-10">
                    <h3 class="text-xl font-semibold text-yellow-600 mb-4">⏳ Pendientes</h3>
                    <div v-for="member in pendingMemberships" :key="member.id"
                        class="mb-6 p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                        <div class="text-sm text-gray-500 mb-2">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block text-primary-color hover:text-tertiary-color text-base p-2 rounded">
                            Ver comprobante
                        </a>
                        <div class="flex gap-2 mt-3">
                            <Button @click="emit('activate', user.id)" variant="transparent"
                                class="border-primary-color text-primary-color hover:text-white hover:bg-green-700 hover:border-green-700">
                                Activar membresía 30 días
                            </Button>
                            <!-- Botón para cancelar recibo -->
                            <Button @click="emit('cancel', member.id)" variant="transparent"
                                class="border-red-500 text-red-500 hover:text-white hover:bg-red-700 hover:border-red-700">
                                Cancelar recibo
                            </Button>
                        </div>
                    </div>
                </div>

                <div v-if="activeMemberships.length" class="mb-10">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">✅ Activas</h3>
                    <div class="text-sm text-gray-500 mb-4">
                        Socio hasta {{ formatToSpanishDateTime(user.membership_expires_at) }}
                    </div>
                    <div v-for="member in activeMemberships" :key="member.id"
                        class="mb-6 p-4 border border-green-200 rounded-lg bg-green-50">
                        <div class="text-sm text-gray-500 mb-2">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block text-green-700 underline text-sm p-2 rounded">
                            Ver comprobante
                        </a>
                    </div>
                </div>

                <div v-if="expiredMemberships.length">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">📅 Expiradas</h3>
                    <div v-for="member in expiredMemberships" :key="member.id"
                        class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="text-sm text-gray-500 mb-2">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block text-gray-700 underline text-sm p-2 rounded">
                            Ver comprobante
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
