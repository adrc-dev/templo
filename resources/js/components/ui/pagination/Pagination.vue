<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { router } from '@inertiajs/vue3';

defineProps<{
    pagination: {
        prev_page_url: string | null;
        next_page_url: string | null;
    };
}>();

function goToPage(url: string) {
    router.visit(url, { preserveScroll: true });
}
</script>

<template>
    <div class="mt-6 flex justify-center gap-2">
        <Button v-if="pagination.prev_page_url" @click="goToPage(pagination.prev_page_url)">
            Anterior
        </Button>

        <Button v-if="pagination.next_page_url" @click="goToPage(pagination.next_page_url)">
            Siguiente
        </Button>
    </div>
</template>
