<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { useVModel } from '@vueuse/core'

const props = defineProps<{
    defaultValue?: string
    modelValue?: string
    class?: HTMLAttributes['class']
    rows?: number
}>()

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string): void
}>()

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
})
</script>

<template>
    <textarea v-model="modelValue" :rows="props.rows || 4" data-slot="textarea" :class="cn(
        'text-white placeholder:text-amber-50/50 selection:bg-secondary-color selection:text-primary-color',
        'border-input w-full min-w-0 rounded-md border bg-white/10 px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none',
        'focus-visible:border-white focus-visible:ring-white/50 focus-visible:ring-[3px]',
        'aria-invalid:ring-destructive/20 aria-invalid:border-destructive',
        'disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
        props.class
    )" />
</template>
