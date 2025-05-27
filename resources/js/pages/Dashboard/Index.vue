<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import MembershipModal from '@/components/adr/Dashboard/MembershipModal.vue';
import UserSearch from '@/components/adr/Dashboard/UserSearch.vue';
import UserTable from '@/components/adr/Dashboard/UserTable.vue';

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

async function activateMembership(userId: number) {
    if (!confirm('¿Estás seguro de que deseas activar la membresía?')) return;

    router.post(`/admin/users/${userId}/activate-membership`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = false;
        }
    });
}
</script>

<template>

    <Head title="Dashboard" />
    <FlashMassage />

    <!-- Modal de comprobantes -->
    <MembershipModal :show="showModal" :user="selectedUser" @close="showModal = false" @activate="activateMembership" />

    <AppLayout>
        <div class="max-w-[1200px] mx-auto px-4 py-6">
            <Heading :title="`Tashi delek, ${auth.user.name} ${auth.user.surname}`"
                description="Aquí podrás administrar los usuarios de la web." />

            <!-- Buscador -->
            <UserSearch v-model="search" />

            <!-- Tabla -->
            <UserTable :users="users" :auth="auth" :auth-role="authRole" :update-role="updateRole"
                :delete-user="deleteUser" :open-modal="openModal" :bg-class="bgClass" />

            <!-- Paginación -->
            <Pagination :pagination="users" />
        </div>
    </AppLayout>
</template>

<style scoped></style>
