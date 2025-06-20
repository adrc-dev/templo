<script setup lang="ts">
import { ref, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { i18n } from '@/i18n';
import {
    DropdownMenu,
    DropdownMenuTrigger,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator
} from '@/components/ui/dropdown-menu';

const page = usePage();
const currentLocale = ref(page.props.locale || 'en');

// Formulario para enviar el nuevo idioma al backend
const form = useForm({
    locale: currentLocale.value,
});

// Cambia el idioma y lo envía al backend
function changeLocale(locale: string) {
    form.locale = locale;
    form.post('/locale', {
        preserveState: true,
        preserveScroll: true,
    });
}

// Sincroniza el idioma en tiempo real si Laravel lo devuelve actualizado
watch(() => page.props.locale, (newLocale) => {
    if (newLocale && newLocale !== i18n.global.locale.value) {
        i18n.global.locale.value = newLocale;
        currentLocale.value = newLocale;
    }
});

// Idiomas disponibles
const locales = [
    { code: 'es', label: '🇪🇸 ES' },
    { code: 'en', label: '🇺🇸 EN' },
    { code: 'pt', label: '🇧🇷 PT' },
];
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <button class="flex items-center text-white hover:text-gray-300 focus:outline-none cursor-pointer">
                {{locales.find(l => l.code === currentLocale)?.label}}
            </button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="center" class="mt-2">
            <template v-for="(locale, index) in locales" :key="locale.code">
                <DropdownMenuItem @click="changeLocale(locale.code)" class="cursor-pointer">
                    {{ locale.label }}
                </DropdownMenuItem>
                <DropdownMenuSeparator v-if="index < locales.length - 1" />
            </template>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
