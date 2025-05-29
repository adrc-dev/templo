<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuLabel } from '@/components/ui/dropdown-menu';
import type { User } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LogOut, Settings, UserSearch, UserRound } from 'lucide-vue-next';

interface Props {
    user: User;
}

defineProps<Props>();
</script>

<template>
    <DropdownMenuItem v-if="user.role === 'admin' || user.role === 'operator'" :as-child="true">
        <Link class="block w-full cursor-pointer" :href="route('dashboard')" as="button">
        <UserSearch class="mr-2 h-4 w-4" />
        <UserInfo :user="user" :show-email="false" class="mr-2 h-4 w-4" />
        </Link>
    </DropdownMenuItem>

    <DropdownMenuLabel v-else class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1.5 py-1.5 text-left text-sm">
            <UserRound class="mr-2 h-4 w-4" />
            <UserInfo :user="user" :show-email="true" />
        </div>
    </DropdownMenuLabel>

    <DropdownMenuSeparator />

    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" :href="route('profile.edit')" as="button">
            <Settings class="mr-2 h-4 w-4" />
            {{ $t('user_menu.account') }}
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>

    <DropdownMenuSeparator />

    <DropdownMenuItem :as-child="true">
        <Link class="block w-full cursor-pointer" method="post" :href="route('logout')" as="button">
        <LogOut class="mr-2 h-4 w-4" />
        {{ $t('user_menu.logout') }}
        </Link>
    </DropdownMenuItem>
</template>
