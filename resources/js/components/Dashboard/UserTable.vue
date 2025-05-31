<script setup lang="ts">
import { Mail, SquareX } from 'lucide-vue-next';

defineProps<{
    users: any,
    auth: any,
    authRole: string,
    updateRole: (user: any) => void,
    deleteUser: (id: number) => void,
    openModal: (user: any) => void,
    bgClass: (role: string) => string,
}>();
</script>

<template>
    <div class="overflow-auto rounded-lg shadow">
        <table class="min-w-full text-base text-center text-primary-color">
            <thead class="bg-primary-color text-white hidden md:table-header-group">
                <tr>
                    <th class="p-3">{{ $t('dashboard.userTable.id') }}</th>
                    <th class="p-3">{{ $t('dashboard.userTable.name') }}</th>
                    <th class="p-3">{{ $t('dashboard.userTable.email') }}</th>
                    <th class="p-3">{{ $t('dashboard.userTable.role') }}</th>
                    <th class="p-3">{{ $t('dashboard.userTable.proof') }}</th>
                    <th v-if="authRole === 'admin'" class="p-3">{{ $t('dashboard.userTable.delete') }}</th>
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
                        <span class="font-semibold md:hidden">{{ $t('dashboard.userTable.name') }}: </span>
                        {{ user.name }} {{ user.surname }}
                    </td>
                    <!-- Email -->
                    <td class="p-3 block md:table-cell text-left md:text-center">
                        <span class="font-semibold md:hidden">{{ $t('dashboard.userTable.email') }}: </span>
                        {{ user.email }}
                    </td>
                    <!-- Rol -->
                    <td class="p-3 block md:table-cell text-left md:text-center">
                        <span class="font-semibold md:hidden">{{ $t('dashboard.userTable.role') }}: </span>
                        <span v-if="user.role === 'admin' || (authRole === 'operator' && user.role === 'operator')">
                            {{ $t(`dashboard.userTable.roles.${user.role}`) }}
                        </span>
                        <select v-else v-model="user.role" @change="updateRole(user)" :class="bgClass(user.role)"
                            class="border border-primary-color rounded px-2 py-1 text-sm focus:outline-none focus:ring-0 focus:border-primary-color w-full md:w-auto">
                            <option value="user">{{ $t('dashboard.userTable.roles.user') }}</option>
                            <option value="socio">{{ $t('dashboard.userTable.roles.socio') }}</option>
                            <option v-if="authRole === 'admin'" value="operator">
                                {{ $t('dashboard.userTable.roles.operator') }}
                            </option>
                        </select>
                    </td>
                    <!-- Comprobante -->
                    <td class="p-3 block md:table-cell text-left md:text-center">
                        <span class="font-semibold md:hidden">{{ $t('dashboard.userTable.proof') }}: </span>
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
                            <span v-else class="italic text-gray-500">
                                {{ $t('dashboard.userTable.proof_not_sent') }}
                            </span>
                        </template>
                    </td>
                    <!-- Eliminar -->
                    <td v-if="authRole === 'admin'" class="p-3 block md:table-cell text-left md:text-center">
                        <span class="font-semibold md:hidden">{{ $t('dashboard.userTable.delete') }}: </span>
                        <button v-if="user.id !== auth.user.id" @click="deleteUser(user.id)"
                            class="text-red-600 hover:text-red-800 cursor-pointer">
                            <SquareX class="w-5 h-5 inline-block" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
