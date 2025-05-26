<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
    modelValue: string
    options: { value: string, label: string }[]
    required?: boolean
    placeholder?: string
    class?: string
}>()

const emit = defineEmits(['update:modelValue'])

const baseClasses = `text-white file:text-secondary-color placeholder:text-amber-50/50 selection:bg-secondary-color selection:text-primary-color border-input flex h-9 w-full min-w-0 rounded-md border bg-white/10 px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-white focus-visible:ring-white/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 aria-invalid:border-destructive`

const classes = computed(() => `${baseClasses} ${props.class ?? ''}`)
</script>

<template>
    <select :value="modelValue" @input="$emit('update:modelValue', ($event.target as HTMLSelectElement).value)"
        :required="required" :class="classes">
        <option value="">{{ placeholder || 'Selecciona una opción' }}</option>
        <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
