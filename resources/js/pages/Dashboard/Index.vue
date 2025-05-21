<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import FlashMassage from '@/components/FlashMassage.vue';
import { ref, watch } from 'vue';
import { SquareX } from 'lucide-vue-next';

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
    </AppLayout>
</template>
