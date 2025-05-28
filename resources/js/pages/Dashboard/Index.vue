<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import FlashMassage from '@/components/FlashMassage.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import MembershipModal from '@/components/Dashboard/MembershipModal.vue';
import UserSearch from '@/components/Dashboard/UserSearch.vue';
import UserTable from '@/components/Dashboard/UserTable.vue';
import ConfirmDialog from '@/components/ConfirmDialog.vue';

const search = ref('');
watch(search, (value) => {
    router.get('/dashboard', { search: value }, { preserveState: true, replace: true });
});
const showConfirmDialog = ref(false);
const userIdToDelete = ref<number | null>(null);

const showConfirmMembershipDialog = ref(false);
const userIdToActivate = ref<number | null>(null);

function activateMembership(userId: number) {
    userIdToActivate.value = userId;
    showConfirmMembershipDialog.value = true;
}

function updateRole(user: any) {
    router.patch(`/users/${user.id}/role`, { role: user.role }, {
        preserveScroll: true,
    });
}

function askDeleteUser(id: number) {
    userIdToDelete.value = id;
    showConfirmDialog.value = true;
}

function confirmDeleteUser() {
    if (userIdToDelete.value !== null) {
        router.delete(`/users/${userIdToDelete.value}`, {
            preserveScroll: true,
        });
        showConfirmDialog.value = false;
        userIdToDelete.value = null;
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

async function confirmActivateMembership() {
    if (userIdToActivate.value !== null) {
        router.post(`/admin/users/${userIdToActivate.value}/activate-membership`, {}, {
            preserveScroll: true,
            onSuccess: () => {
                showModal.value = false;
                showConfirmMembershipDialog.value = false;
                userIdToActivate.value = null;
            }
        });
    }
}
</script>

<template>

    <Head title="Dashboard" />
    <FlashMassage />

    <!-- Modal de comprobantes -->
    <MembershipModal :show="showModal" :user="selectedUser" @close="showModal = false" @activate="activateMembership" />

    <!-- Confirmación de eliminación -->
    <ConfirmDialog :show="showConfirmDialog" title="¿Eliminar usuario?"
        message="Esta acción no se puede deshacer. ¿Seguro que deseas continuar?" confirmText="Eliminar"
        confirm-color="red" @confirm="confirmDeleteUser" @cancel="showConfirmDialog = false" />

    <!-- Confirmación de activación de membresía -->
    <ConfirmDialog :show="showConfirmMembershipDialog" title="¿Activar membresía?"
        message="¿Estás seguro de que deseas activar la membresía de este usuario?" confirm-text="Activar"
        confirm-color="green" @confirm="confirmActivateMembership" @cancel="showConfirmMembershipDialog = false" />

    <AppLayout>
        <div class="max-w-[1200px] mx-auto px-4 py-6">
            <Heading :title="`Tashi delek, ${auth.user.name} ${auth.user.surname}`"
                description="Aquí podrás administrar los usuarios de la web." />

            <!-- Buscador -->
            <UserSearch v-model="search" />

            <!-- Tabla -->
            <UserTable :users="users" :auth="auth" :auth-role="authRole" :update-role="updateRole"
                :delete-user="askDeleteUser" :open-modal="openModal" :bg-class="bgClass" />

            <!-- Paginación -->
            <Pagination :pagination="users" />
        </div>
    </AppLayout>
</template>

<style scoped></style>
