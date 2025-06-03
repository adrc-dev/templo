<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
        <div class="bg-secondary-color/20 p-10 rounded-2xl text-center shadow-lg">
            <!-- Header -->
            <h2 class="text-4xl font-bold text-primary-color mb-6">
                {{ t('home.aulasBanner.title') }}
            </h2>
            <!-- Descripción -->
            <p class="text-lg text-tertiary-color mb-8 max-w-2xl mx-auto">
                {{ t('home.aulasBanner.description') }}
            </p>
            <!-- Botón que varía según si el usuario está logueado -->
            <Button v-if="user" @click="$inertia.visit('/aulas')">
                {{ t('home.aulasBanner.goToClasses') }}
            </Button>
            <Button v-else @click="$inertia.visit('/register')">
                {{ t('home.aulasBanner.createAccount') }}
            </Button>
        </div>
    </section>
</template>

<style scoped></style>
