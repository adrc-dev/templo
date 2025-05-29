<script setup lang="ts">
import { ref, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

import {
    DropdownMenu,
    DropdownMenuTrigger,
    DropdownMenuContent,
    DropdownMenuItem
} from '@/components/ui/dropdown-menu';

import { Languages } from 'lucide-vue-next'; // Icono opcional

const page = usePage();
const currentLocale = ref(page.props.locale || 'en');

const form = useForm({
    locale: currentLocale.value,
});

function changeLocale(locale: string) {
    currentLocale.value = locale;
    form.locale = locale;
    form.post('/locale', {
        onSuccess: () => window.location.reload(),
    });
}

watch(() => page.props.locale, (newLocale) => {
    currentLocale.value = newLocale || 'en';
});

const locales = [
    { code: 'es', label: 'ES' },
    { code: 'en', label: 'EN' },
    { code: 'pt', label: 'PT' },
];
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <button class="flex items-center text-white hover:text-gray-300 focus:outline-none cursor-pointer">
                <Languages class="w-4 h-4 mr-1" />
                {{locales.find(l => l.code === currentLocale)?.label}}
            </button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="end" class="mt-2">
            <DropdownMenuItem v-for="locale in locales" :key="locale.code" @click="changeLocale(locale.code)"
                class="cursor-pointer">
                {{ locale.label }}
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
