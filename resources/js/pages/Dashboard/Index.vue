<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import FlashMassage from '@/components/FlashMassage.vue';
import { ref, watch, computed } from 'vue';
import { SquareX } from 'lucide-vue-next';
import axios from 'axios'

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

defineProps(['users', 'authRole'])

const page = usePage();
const auth = page.props.auth;

const showModal = ref(false);
const selectedUser = ref(null);

function openModal(user) {
    selectedUser.value = user;
    showModal.value = true;
}

function formatToSpanishDateTime(isoDate) {
    const date = new Date(isoDate);
    return date.toLocaleString('es-ES', {
        timeZone: 'Europe/Madrid',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
}

async function activateMembership(userId) {
    try {
        const response = await axios.post(`/admin/users/${userId}/activate-membership`)
        alert(response.data.message)
        showModal.value = false
        window.location.reload()
    } catch (error) {
        alert('Hubo un error al activar la membresía.')
    }
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

    <Head title="Dashboard" />

    <FlashMassage />

    <AppLayout>
        <div class="px-4 py-6 mx-auto max-w-[1200px] flex flex-col justify-center">
            <Heading :title="`Tashi delek, ${auth.user.name} ${auth.user.surname}`"
                description="Aquí podrás administrar los usuarios de la web." />

            <div class="relative w-full max-w-[300px] mx-auto">
                <input type="text" v-model="search" placeholder="Buscar usuario..."
                    class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring focus:border-primary-color pr-8" />
                <button v-if="search" @click="search = ''"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-500"
                    aria-label="Limpiar búsqueda">
                    ✕
                </button>
            </div>
        </div>

        <table class="min-w-full border">
            <thead>
                <tr class="bg-primary-color text-white">
                    <th class="p-2">ID</th>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Rol</th>
                    <th class="p-2">Comprobante</th>
                    <th v-if="authRole === 'admin'" class="p-2">Borrar usuarios</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="user in users.data" :key="user.id" class="border-t text-primary-color text-center" :class="{
                    'bg-green-600/40': user.role === 'socio',
                    'bg-red-600/40': user.role === 'user',
                    'bg-yellow-500/40': user.role === 'admin',
                    'bg-blue-600/40': user.role === 'operator',
                }">
                    <td class="p-2">{{ user.id }}</td>
                    <td class="p-2">{{ user.name }} {{ user.surname }}</td>
                    <td class="p-2">{{ user.email }}</td>

                    <td class="p-2" v-if="authRole === 'admin' || authRole === 'operator'">
                        <span v-if="user.role === 'admin' || (authRole === 'operator' && user.role === 'operator')">
                            {{ user.role }}
                        </span>
                        <select v-else v-model="user.role" @change="updateRole(user)">
                            <option value="user">User</option>
                            <option value="socio">Socio</option>
                            <option v-if="authRole === 'admin'" value="operator">Operator</option>
                        </select>
                    </td>

                    <td class="p-2">
                        <button v-if="user.memberships.length" @click="openModal(user)" class="text-blue-600 underline">
                            Ver ({{user.memberships.filter(m => m.status === 'pending').length}})
                        </button>
                        <span v-else class="text-gray-400 italic">No enviado</span>
                    </td>

                    <td v-if="authRole === 'admin'" class="p-2">
                        <button v-if="user.id !== auth.user.id" @click="deleteUser(user.id)"
                            class="text-red-600 hover:text-red-800 cursor-pointer">
                            <SquareX class="w-5 h-5 inline-block" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- pagination -->
        <div class="flex justify-center my-6 gap-2">
            <template v-for="(link, index) in users.links" :key="index">
                <button v-if="link.url" @click="router.visit(link.url, { preserveScroll: true })"
                    class="px-3 py-1 border rounded-full text-sm" :class="{
                        'bg-primary-color text-secondary-color': link.active,
                        'bg-white text-primary-color hover:bg-secondary-color cursor-pointer': !link.active
                    }" v-html="link.label" />
                <span v-else class="px-3 py-1 border rounded-full text-sm text-gray-400 cursor-not-allowed"
                    v-html="link.label" />
            </template>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl w-full max-w-lg max-h-[90vh] overflow-y-auto relative">
                <button @click="showModal = false"
                    class="absolute top-2 right-2 text-gray-600 hover:text-black">&times;</button>
                <h2 class="text-lg font-semibold mb-4">Comprobantes de {{ selectedUser.name }} {{ selectedUser.surname
                }}</h2>
                <!-- PENDING -->
                <div v-if="pendingMemberships.length">
                    <h3 class="text-base font-semibold mb-2">⏳ Pendientes</h3>
                    <div v-for="member in pendingMemberships" :key="member.id" class="mb-4">
                        <div class="mb-1 text-sm text-gray-600">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block border p-2 rounded hover:bg-gray-100 text-blue-600 underline">
                            Ver comprobante
                        </a>
                        <button @click="activateMembership(selectedUser.id)"
                            class="mt-2 bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Activar membresía 30 días
                        </button>
                    </div>
                </div>

                <!-- ACTIVE -->
                <div v-if="activeMemberships.length">
                    <h3 class="text-base font-semibold mb-2">✅ Activas</h3>
                    <div class="mb-1 text-sm text-gray-600">
                        Socio hasta {{ formatToSpanishDateTime(selectedUser.membership_expires_at) }}
                    </div>
                    <div v-for="member in activeMemberships" :key="member.id" class="mb-4">
                        <div class="mb-1 text-sm text-gray-600">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block border p-2 rounded hover:bg-gray-100 text-green-600 underline">
                            Ver comprobante
                        </a>
                    </div>
                </div>

                <!-- EXPIRED -->
                <div v-if="expiredMemberships.length">
                    <h3 class="text-base font-semibold mb-2">📅 Expiradas</h3>
                    <div v-for="member in expiredMemberships" :key="member.id" class="mb-4">
                        <div class="mb-1 text-sm text-gray-600">
                            # {{ formatToSpanishDateTime(member.created_at) }}
                        </div>
                        <a :href="`/storage/${member.payment_proof_path}`" target="_blank"
                            class="block border p-2 rounded hover:bg-gray-100 text-gray-600 underline">
                            Ver comprobante
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
