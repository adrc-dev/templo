<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import type { User } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LogOut, Settings, UserSearch } from 'lucide-vue-next';

interface Props {
    user: User;
}

defineProps<Props>();
</script>

<template>
    <DropdownMenuItem :as-child="true">
        <Link class="block w-full cursor-pointer" :href="route('dashboard')" as="button">
        <UserSearch class="mr-2 h-4 w-4" />
        <UserInfo :user="user" :show-email="false" class="mr-2 h-4 w-4" />
        </Link>
    </DropdownMenuItem>
    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" :href="route('profile.edit')" as="button">
            <Settings class="mr-2 h-4 w-4" />
            Mi cuenta
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <Link class="block w-full cursor-pointer" method="post" :href="route('logout')" as="button">
        <LogOut class="mr-2 h-4 w-4" />
        Cerrar sesión
        </Link>
    </DropdownMenuItem>
</template>
