<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
    modelValue: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void;
}>();

const input = ref(props.modelValue);

// Sincroniza con el padre
watch(() => props.modelValue, (val) => {
    input.value = val;
});

watch(input, (val) => {
    emit('update:modelValue', val);
});

// Función para limpiar el buscador
const clearSearch = () => {
    input.value = '';
};
</script>

<template>
    <div class="relative max-w-sm mx-auto my-6">
        <input v-model="input" type="text" :placeholder="$t('dashboard.userSearch.placeholder')"
            class="w-full border border-primary-color rounded-lg px-4 py-2 pr-10 text-sm focus:outline-none focus:ring focus:border-primary-color bg-white" />
        <button v-if="input" @click="clearSearch"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 text-xl font-bold">
            &times;
        </button>
    </div>
</template>
