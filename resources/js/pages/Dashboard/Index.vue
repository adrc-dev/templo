<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage, router, Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import FlashMessage from '@/components/FlashMessage.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import MembershipModal from '@/components/Dashboard/MembershipModal.vue';
import UserSearch from '@/components/Dashboard/UserSearch.vue';
import UserTable from '@/components/Dashboard/UserTable.vue';
import ConfirmDialog from '@/components/ConfirmDialog.vue'; import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const search = ref('');
watch(search, (value) => {
    router.get('/dashboard', { search: value }, { preserveState: true, replace: true });
});
const showConfirmDialog = ref(false);
const userIdToDelete = ref<number | null>(null);

const showConfirmMembershipDialog = ref(false);
const userIdToActivate = ref<number | null>(null);

const showCancelReceiptDialog = ref(false);
const membershipIdToCancel = ref<number | null>(null);

function activateMembership(userId: number) {
    userIdToActivate.value = userId;
    showConfirmMembershipDialog.value = true;
}

function cancelReceipt(membershipId: number) {
    membershipIdToCancel.value = membershipId;
    showCancelReceiptDialog.value = true;
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

function confirmCancelReceipt() {
    if (membershipIdToCancel.value !== null) {
        router.delete(route('memberships.destroy', {
            membership: membershipIdToCancel.value
        }), {
            preserveScroll: true,
            onSuccess: () => {
                if (selectedUser.value) {
                    const index = selectedUser.value.memberships.findIndex(
                        m => m.id === membershipIdToCancel.value
                    );
                    if (index !== -1) {
                        selectedUser.value.memberships.splice(index, 1);
                    }
                }
                showCancelReceiptDialog.value = false;
                membershipIdToCancel.value = null;
            }
        });
    }
}
</script>

<template>

    <Head :title="t('dashboard.page_title')" />
    <FlashMessage />

    <!-- Modal de comprobantes -->
    <MembershipModal :show="showModal" :user="selectedUser" @close="showModal = false" @activate="activateMembership"
        @cancel="cancelReceipt" />

    <!-- Confirmación de eliminación -->
    <ConfirmDialog :show="showConfirmDialog" :title="t('dashboard.delete_user_title')"
        :message="t('dashboard.delete_user_message')" :confirm-text="t('dashboard.delete_user_confirm')"
        confirm-color="red" @confirm="confirmDeleteUser" @cancel="showConfirmDialog = false" />

    <!-- Confirmación de activación de membresía -->
    <ConfirmDialog :show="showConfirmMembershipDialog" :title="t('dashboard.activate_membership_title')"
        :message="t('dashboard.activate_membership_message')" :confirm-text="t('dashboard.activate_membership_confirm')"
        confirm-color="green" @confirm="confirmActivateMembership" @cancel="showConfirmMembershipDialog = false" />

    <!-- Confirmación de cancelación de comprobante -->
    <ConfirmDialog :show="showCancelReceiptDialog" :title="t('dashboard.cancel_receipt_title')"
        :message="t('dashboard.cancel_receipt_message')" :confirm-text="t('dashboard.cancel_receipt_confirm')"
        confirm-color="red" @confirm="confirmCancelReceipt" @cancel="showCancelReceiptDialog = false" />

    <AppLayout>
        <div class="max-w-[1200px] mx-auto px-4 py-6">
            <Heading :title="`${t('dashboard.greeting')}, ${auth.user.name} ${auth.user.surname}`"
                :description="t('dashboard.description')" />

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
