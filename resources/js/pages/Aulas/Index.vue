<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AulasImage from '@assets/banner-aulas.png';

defineProps<{
    freeVideos: any,
    premiumVideos: any,
}>();
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="AulasImage" pageTitle="Aulas" />
        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Aulas</h2>

            <!-- free -->
            <h3 class="text-2xl font-semibold mb-6 text-green-700">Contenido gratuito</h3>
            <div v-if="freeVideos && freeVideos.data && freeVideos.data.length" class="space-y-8 mb-12">
                <article v-for="video in freeVideos.data" :key="video.id"
                    class="md:h-94 grid md:grid-cols-2 border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                    <div class="w-full h-full">
                        <iframe class="w-full h-full"
                            :src="`https://www.youtube.com/embed/${video.youtube_id}?modestbranding=1&rel=0&enablejsapi=1`"
                            frameborder="0" allowfullscreen sandbox="allow-same-origin allow-scripts allow-presentation"
                            referrerpolicy="no-referrer">
                        </iframe>
                    </div>
                    <div class="p-6 flex flex-col justify-center">
                        <h4 class="text-xl font-bold mb-2">{{ video.title }}</h4>
                        <p class="text-gray-600">{{ video.description }}</p>
                    </div>
                </article>

                <div class="mt-6 flex justify-center gap-2">
                    <button v-if="freeVideos.prev_page_url" @click="$inertia.visit(freeVideos.prev_page_url)"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Anterior</button>

                    <button v-if="freeVideos.next_page_url" @click="$inertia.visit(freeVideos.next_page_url)"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Siguiente</button>
                </div>
            </div>
            <p v-else class="text-gray-500 italic">No hay videos gratuitos por el momento.</p>

            <!-- Premium -->
            <div>
                <h3 class="text-2xl font-semibold mb-6 text-blue-700">Contenido para socios</h3>
                <div v-if="premiumVideos && premiumVideos.data && premiumVideos.data.length" class="space-y-8 mb-12">
                    <article v-for="video in premiumVideos.data" :key="video.id"
                        class="md:h-94 grid md:grid-cols-2 border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                        <div class="w-full h-full">
                            <iframe class="w-full h-full"
                                :src="`https://www.youtube.com/embed/${video.youtube_id}?modestbranding=1&rel=0&enablejsapi=1`"
                                frameborder="0" allowfullscreen
                                sandbox="allow-same-origin allow-scripts allow-presentation"
                                referrerpolicy="no-referrer">
                            </iframe>
                        </div>
                        <div class="p-6 flex flex-col justify-center">
                            <h4 class="text-xl font-bold mb-2">{{ video.title }}</h4>
                            <p class="text-gray-600">{{ video.description }}</p>
                        </div>
                    </article>

                    <div class="mt-6 flex justify-center gap-2">
                        <button v-if="premiumVideos.prev_page_url" @click="$inertia.visit(premiumVideos.prev_page_url)"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Anterior</button>

                        <button v-if="premiumVideos.next_page_url" @click="$inertia.visit(premiumVideos.next_page_url)"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Siguiente</button>
                    </div>
                </div>
                <p v-else class="text-gray-500 italic">Este contenido está reservado para socios.</p>
            </div>
        </section>
    </AppLayout>
</template>
