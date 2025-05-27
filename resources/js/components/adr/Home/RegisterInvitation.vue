<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto my-20">
        <div class="bg-secondary-color/20 p-10 rounded-2xl text-center shadow-lg">
            <h2 class="text-4xl font-bold text-primary-color mb-6">Accede a las aulas gratuitas</h2>
            <p class="text-lg text-tertiary-color mb-8 max-w-2xl mx-auto">
                Regístrate de forma gratuita para comenzar a explorar nuestras aulas y acceder a enseñanzas y
                recursos que nutren tu camino espiritual.
            </p>
            <Button v-if="user" @click="$inertia.visit('/aulas')">
                Ir a las aulas
            </Button>
            <Button v-else @click="$inertia.visit('/register')">
                Crear una cuenta gratis
            </Button>
        </div>
    </section>

</template>

<style scoped></style>
