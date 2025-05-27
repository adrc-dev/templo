<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import FlashMassage from '@/components/FlashMassage.vue';
import { ref, watch, computed } from 'vue';
import { SquareX, Mail } from 'lucide-vue-next';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import { Button } from '@/components/ui/button';

const search = ref('');
watch(search, (value) => {
    router.get('/dashboard', { search: value }, { preserveState: true, replace: true });
});

function updateRole(user: any) {
    router.patch(`/users/${user.id}/role`, { role: user.role }, {
        preserveScroll: true,
    });
}

function deleteUser(userId: number) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        router.delete(`/users/${userId}`, {
            preserveScroll: true,
        });
    }
}

function bgClass(role: string) {
    switch (role) {
        case 'user':
            return 'bg-gray-200';
        case 'socio':
            return 'bg-green-100';
        case 'operator':
            return 'bg-blue-100';
        default:
            return 'bg-white';
    }
}

defineProps(['users'])

const page = usePage();
const auth = page.props.auth;
const authRole = auth.user.role;

const showModal = ref(false);
const selectedUser = ref(null);

function openModal(user: any) {
    selectedUser.value = user;
    showModal.value = true;
}

function formatToSpanishDateTime(isoDate: Date | string) {
    const date = new Date(isoDate);
    return date.toLocaleString('es-ES', {
        timeZone: 'Europe/Madrid',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
}


async function activateMembership(userId: number) {
    if (!confirm('¿Estás seguro de que deseas activar la membresía?')) return;

    router.post(`/admin/users/${userId}/activate-membership`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = false;
        }
    });
}

const pendingMemberships = computed(() => {
    return selectedUser.value?.memberships?.filter(m => m.status === 'pending') || [];
});
const activeMemberships = computed(() => {
    return selectedUser.value?.memberships?.filter(m => m.status === 'active') || [];
});
const expiredMemberships = computed(() => {
    return selectedUser.value?.memberships?.filter(m => m.status === 'expired') || [];
});
</script>

<template>
    <!-- Modal de comprobantes -->
    <Transition name="fade">
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-primary-color/40"
            @click.self="showModal = false">
            <div class="bg-white max-w-2xl w-full max-h-[90vh] overflow-y-auto rounded-lg shadow-xl p-6 relative">
                <button @click="showModal = false"
                    class="absolute top-3 right-3 text-primary-color/50 hover:text-primary-color cursor-pointer text-2xl">
                    ✕
                </button>

                <h2 class="text-4xl font-semibold text-primary-color text-center mb-12">
                    Comprobantes de {{ selectedUser.name }} {{ selectedUser.surname }}
                </h2>

                <div v-if="pendingMemberships.length" class="mb-10">
                    <h3 class="text-xl font-semibold text-yellow-600 mb-4">⏳ Pendientes</h3>
                    <div v-for="member in pendingMemberships" :key="member.id"
                        class="mb-6 p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                        <div class="text-sm text-gray-500 mb-2"># {{ formatToSpanishDateTime(member.created_at)
                            }}</div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block text-primary-color hover:text-tertiary-color text-base p-2 rounded">
                            Ver comprobante
                        </a>
                        <Button @click="activateMembership(selectedUser.id)" variant="transparent"
                            class="mt-3 border-primary-color text-primary-color hover:text-white hover:bg-green-700 hover:border-green-700">
                            Activar membresía 30 días
                        </Button>
                    </div>
                </div>

                <div v-if="activeMemberships.length" class="mb-10">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">✅ Activas</h3>
                    <div class="text-sm text-gray-500 mb-4">
                        Socio hasta {{ formatToSpanishDateTime(selectedUser.membership_expires_at) }}
                    </div>
                    <div v-for="member in activeMemberships" :key="member.id"
                        class="mb-6 p-4 border border-green-200 rounded-lg bg-green-50">
                        <div class="text-sm text-gray-500 mb-2"># {{ formatToSpanishDateTime(member.created_at)
                            }}</div>
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
                        <div class="text-sm text-gray-500 mb-2"># {{ formatToSpanishDateTime(member.created_at)
                            }}</div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block text-gray-700 underline text-sm  p-2 rounded">
                            Ver comprobante
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </Transition>

    <Head title="Dashboard" />
    <FlashMassage />

    <AppLayout>
        <div class="max-w-[1200px] mx-auto px-4 py-6">
            <Heading :title="`Tashi delek, ${auth.user.name} ${auth.user.surname}`"
                description="Aquí podrás administrar los usuarios de la web." />

            <!-- Buscador -->
            <div class="relative max-w-sm mx-auto my-6">
                <input v-model="search" type="text" placeholder="Buscar usuario..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm focus:outline-none focus:ring focus:border-primary-color" />
                <button v-if="search" @click="search = ''"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 text-xl font-bold">
                    &times;
                </button>
            </div>

            <!-- Tabla -->
            <div class="overflow-auto rounded-lg shadow">
                <table class="min-w-full text-base text-center text-primary-color">
                    <thead class="bg-primary-color text-white hidden md:table-header-group">
                        <tr>
                            <th class="p-3">ID</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Rol</th>
                            <th class="p-3">Comprobante</th>
                            <th v-if="authRole === 'admin'" class="p-3">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" :key="user.id"
                            class="border-b odd:bg-white even:bg-gray-200 block md:table-row">
                            <!-- ID -->
                            <td class="p-3 md:table-cell hidden md:text-center">
                                {{ user.id }}
                            </td>
                            <!-- Nombre -->
                            <td class="p-3 block md:table-cell text-left md:text-center">
                                <span class="font-semibold md:hidden">Nombre: </span>{{ user.name }} {{ user.surname }}
                            </td>
                            <!-- Email -->
                            <td class="p-3 block md:table-cell text-left md:text-center">
                                <span class="font-semibold md:hidden">Email: </span>{{ user.email }}
                            </td>
                            <!-- Rol -->
                            <td class="p-3 block md:table-cell text-left md:text-center">
                                <span class="font-semibold md:hidden">Rol: </span>
                                <span
                                    v-if="user.role === 'admin' || (authRole === 'operator' && user.role === 'operator')">
                                    {{ user.role }}
                                </span>
                                <select v-else v-model="user.role" @change="updateRole(user)"
                                    :class="bgClass(user.role)"
                                    class="border border-primary-color rounded px-2 py-1 text-sm focus:outline-none focus:ring-0 focus:border-primary-color w-full md:w-auto">
                                    <option value="user">User</option>
                                    <option value="socio">Socio</option>
                                    <option v-if="authRole === 'admin'" value="operator">Operator</option>
                                </select>
                            </td>
                            <!-- Comprobante -->
                            <td class="p-3 block md:table-cell text-left md:text-center">
                                <span class="font-semibold md:hidden">Comprobante: </span>
                                <template v-if="['admin', 'operator'].includes(user.role)"></template>
                                <template v-else>
                                    <div class="relative inline-block" v-if="user.memberships.length">
                                        <button @click="openModal(user)"
                                            class="text-blue-400 hover:text-blue-800 flex items-center cursor-pointer">
                                            <Mail class="w-7 h-7" />
                                        </button>
                                        <span v-if="user.memberships.filter(m => m.status === 'pending').length"
                                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                            {{user.memberships.filter(m => m.status === 'pending').length}}
                                        </span>
                                    </div>
                                    <span v-else class="italic text-gray-500">No enviado</span>
                                </template>
                            </td>
                            <!-- Eliminar -->
                            <td v-if="authRole === 'admin'" class="p-3 block md:table-cell text-left md:text-center">
                                <span class="font-semibold md:hidden">Eliminar: </span>
                                <button v-if="user.id !== auth.user.id" @click="deleteUser(user.id)"
                                    class="text-red-600 hover:text-red-800 cursor-pointer">
                                    <SquareX class="w-5 h-5 inline-block" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <Pagination :pagination="users" />
        </div>
    </AppLayout>
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
