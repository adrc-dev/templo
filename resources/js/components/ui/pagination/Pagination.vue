<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';

defineProps<{
    pagination: {
        prev_page_url: string | null;
        next_page_url: string | null;
    };
}>();
</script>

<template>
    <div class="mt-6 flex justify-center gap-2">
        <Button v-if="pagination.prev_page_url" @click="$inertia.visit(pagination.prev_page_url)">
            Anterior
        </Button>

        <Button v-if="pagination.next_page_url" @click="$inertia.visit(pagination.next_page_url)">
            Siguiente
        </Button>
    </div>
</template>
