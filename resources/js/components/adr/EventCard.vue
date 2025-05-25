<script setup lang="ts">
import Button from '../ui/button/Button.vue';
const props = defineProps({
    image: String,
    title: String,
    description: String,
    date: String,
    link: String,
    alt: String
})

const formattedDate = props.date ? new Date(props.date).toLocaleDateString() : 'Fecha no disponible'
</script>

<template>
    <div
        class="bg-amber-50 shadow-lg rounded-xl overflow-hidden hover:shadow-md transition pb-16 relative min-h-[450px]">
        <img :src="image" :alt="alt || 'Imagen de evento'" class="w-full h-60 object-cover" />

        <div class="py-4 px-6 md:px-8">
            <slot>
                <slot name="date">
                    <p class="text-xs text-secondary-color mb-1">{{ formattedDate }}</p>
                </slot>

                <slot name="title">
                    <h3 class="text-lg font-semibold text-primary-color mb-2">{{ title }}</h3>
                </slot>

                <slot name="description">
                    <p class="text-base text-primary-color line-clamp-4">{{ description }}</p>
                </slot>
            </slot>

            <div class="mt-4 flex justify-center absolute bottom-0 left-0 right-0 p-4">
                <slot name="button">
                    <Button :href="link">
                        Más información
                    </Button>
                </slot>
            </div>
        </div>
    </div>
</template>
