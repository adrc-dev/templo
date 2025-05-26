<script setup lang="ts">
defineProps<{
    video: {
        id: number,
        title: string,
        description: string,
        youtube_id: string,
        showFull: boolean,
    },
    toggleDescription: () => void
}>();
</script>

<template>
    <article
        class="rounded-xl overflow-hidden shadow hover:shadow-md transition duration-300 bg-amber-50 min-h-[375px]">
        <div class="aspect-video w-full">
            <iframe class="w-full h-full"
                :src="`https://www.youtube.com/embed/${video.youtube_id}?modestbranding=1&rel=0&enablejsapi=1`"
                frameborder="0" allowfullscreen sandbox="allow-same-origin allow-scripts allow-presentation"
                referrerpolicy="no-referrer"></iframe>
        </div>
        <div class="p-4">
            <h4 class="text-lg font-semibold mb-2">{{ video.title }}</h4>
            <p class="text-gray-600">
                <span v-if="!video.showFull">
                    {{ video.description.slice(0, 100) }}
                    <span v-if="video.description.length > 100">
                        ...
                        <button class="text-primary-color hover:text-tertiary-color cursor-pointer"
                            @click="toggleDescription()">leer más</button>
                    </span>
                </span>
                <span v-else>
                    {{ video.description }}
                    <button class="text-primary-color hover:text-tertiary-color cursor-pointer"
                        @click="toggleDescription()">mostrar menos</button>
                </span>
            </p>
        </div>
    </article>
</template>
