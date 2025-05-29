<script lang="ts" setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { CircleUserRound, UserRoundCheck } from 'lucide-vue-next';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent } from '@/components/ui/dropdown-menu';
import TextLink from '@/components/TextLink.vue';
import SelectLeguage from './SelectLeguage.vue';
import { onMounted, onUnmounted } from 'vue';

const isMenuOpen = ref(false);
const isHeaderVisible = ref(true);

let lastScrollY = window.scrollY;

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}

function handleScroll() {
    const currentScrollY = window.scrollY;
    if (currentScrollY > lastScrollY && currentScrollY > 100) {
        // scrolling down
        isHeaderVisible.value = false;
    } else {
        // scrolling up
        isHeaderVisible.value = true;
    }
    lastScrollY = currentScrollY;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header :class="[
        'z-20 fixed top-0 left-0 w-full transition-transform duration-500',
        isHeaderVisible ? 'translate-y-0' : '-translate-y-full'
    ]">
        <!-- barra superior -->
        <div class="py-1 bg-secondary-color w-full">
            <div class="flex items-center text-primary-color justify-between w-full max-w-[1512px] mx-auto px-8">
                <div>
                    <TextLink :href="route('contact')" class="text-primary-color hover:text-tertiary-color font-normal">
                        {{ $t('header.contact') }}
                    </TextLink>
                    <a href="https://wa.me/5511989964269"
                        class="text-white hover:text-tertiary-color ml-10 hidden md:inline-block">
                        {{ $t('header.call_us') }}
                    </a>
                </div>
                <TextLink :href="route('member.create')"
                    class="text-primary-color hover:text-tertiary-color font-normal">
                    {{ $t('header.become_member') }}
                </TextLink>
            </div>
        </div>

        <!-- barra principal -->
        <div class="w-full bg-primary-color h-[100px] flex items-center">
            <div class="w-full max-w-[1512px] flex justify-between items-center mx-auto px-8 py-2 text-white">
                <!-- logo -->
                <div class="flex items-center">
                    <Link :href="route('home')" preserve-scroll><img src="@assets/logo-claro-solo.png" alt="Logo"
                        class="w-45 h-full" /></Link>
                </div>

                <!-- menú escritorio -->
                <div class="flex items-center space-x-4">
                    <nav class="hidden md:flex items-center">
                        <ul class="flex space-x-4">
                            <li>
                                <TextLink :href="route('about-us')" class="font-normal">
                                    {{ $t('header.menu.about_us') }}
                                </TextLink>
                            </li>
                            <li>
                                <TextLink :href="route('events.index')" class="font-normal">
                                    {{ $t('header.menu.events') }}
                                </TextLink>
                            </li>
                            <li>
                                <TextLink :href="route('aulas.index')" class="font-normal">
                                    {{ $t('header.menu.aulas') }}
                                </TextLink>
                            </li>
                            <li>
                                <TextLink :href="route('shop')" class="font-normal">
                                    {{ $t('header.menu.shop') }}
                                </TextLink>
                            </li>
                            <li>
                                <SelectLeguage />
                            </li>
                        </ul>
                    </nav>

                    <div v-if="$page.props.auth.user" class="hidden relative md:flex items-center pl-5">
                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <button
                                    class="flex flex-col items-center text-white font-bold hover:text-gray-300 focus:outline-none cursor-pointer">
                                    <UserRoundCheck class="w-7 h-7" />
                                    {{ $page.props.auth.user.name }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="center" class="w-56 mt-2">
                                <UserMenuContent :user="$page.props.auth.user" />
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>

                    <div v-else class="hidden md:block">
                        <Link :href="route('login')"
                            class="flex flex-col justify-center items-center pl-5 py-1.5 leading-normal hover:text-gray-300 text-white font-bold">
                        <CircleUserRound class="w-7 h-7 inline-block" />
                        {{ $t('header.auth.login') }}
                        </Link>
                    </div>
                </div>

                <!-- botón hamburguesa -->
                <button class="md:hidden focus:outline-none" @click="toggleMenu">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>


            </div>
        </div>

        <!-- menú móvil -->
        <transition name="fade">
            <nav v-show="isMenuOpen"
                class="md:hidden bg-primary-color text-white transition-all duration-300 ease-in-out text-center">
                <ul class="flex flex-col space-y-2">
                    <li class="mt-2 px-4">
                        <a href="/about-us" class="hover:text-gray-300" @click="toggleMenu">
                            {{ $t('header.menu.about_us') }}
                        </a>
                    </li>
                    <li class="px-4">
                        <a href="/events" class="hover:text-gray-300" @click="toggleMenu">
                            {{ $t('header.menu.events') }}
                        </a>
                    </li>
                    <li class="px-4">
                        <a href="/aulas" class="hover:text-gray-300" @click="toggleMenu">
                            {{ $t('header.menu.aulas') }}
                        </a>
                    </li>
                    <li class="px-4">
                        <a href="/shop" class="hover:text-gray-300" @click="toggleMenu">
                            {{ $t('header.menu.shop') }}
                        </a>
                    </li>
                    <li class="px-4 self-center">
                        <SelectLeguage />
                    </li>
                    <li class="px-4 py-2 bg-secondary-color text-primary-color">
                        <div v-if="$page.props.auth.user" class="relative">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <button class="">
                                        {{ $page.props.auth.user.name }}
                                    </button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end" class="w-56 mt-2">
                                    <UserMenuContent :user="$page.props.auth.user" />
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>
                        <div v-else>
                            <Link :href="route('login')" class="hover:text-gray-300 text-white">
                            {{ $t('header.auth.login') }}
                            </Link>
                        </div>
                    </li>
                </ul>
            </nav>
        </transition>
    </header>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
