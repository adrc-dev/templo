<script setup lang="ts">
import { cn } from '@/lib/utils'
import { Label, type LabelProps } from 'reka-ui'
import { computed, type HTMLAttributes } from 'vue'

const props = defineProps<LabelProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props

    return delegated
})
</script>

<template>
    <Label data-slot="label" v-bind="delegatedProps" :class="cn(
        'block pl-3 text-base text-white font-medium mb-2 leading-none select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50',
        props.class,
    )
        ">
        <slot />
    </Label>
</template>
