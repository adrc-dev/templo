<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AulasImage from '@assets/banner-aulas.png';
import HazteSocioImage from '@assets/hazte-socio-aulas.png';
import Button from '@/components/ui/button/Button.vue';
import DonationBanner from '@/components/adr/DonationBanner.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;

defineProps<{
    freeVideos: any,
    premiumVideos: any,
}>();
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="AulasImage" pageTitle="Aulas" />
        </div>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <!-- Administración -->
            <div v-if="user && (user.role === 'admin' || user.role === 'operator')" class="mt-12 flex justify-end">
                <Button @click="$inertia.visit('/videos')">
                    Administrar videos
                </Button>
            </div>

            <!-- Contenido gratuito -->
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Aulas gratuitas</h2>
            <div v-if="freeVideos && freeVideos.data && freeVideos.data.length"
                class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <article v-for="video in freeVideos.data" :key="video.id"
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
                            <span v-if="!video.showFull">{{ video.description.slice(0, 100) }}<span
                                    v-if="video.description.length > 100">... <button
                                        class="text-primary-color hover:text-tertiary-color cursor-pointer"
                                        @click="video.showFull = true">leer más</button></span></span>
                            <span v-else>
                                {{ video.description }}
                                <button class="text-primary-color hover:text-tertiary-color cursor-pointer"
                                    @click="video.showFull = false">mostrar menos</button>
                            </span>
                        </p>
                    </div>
                </article>
            </div>
            <p v-else class="text-tertiary-color italic">No hay videos gratuitos por el momento.</p>

            <!-- Paginación -->
            <div class="md:col-span-2 mt-6 flex justify-center gap-2">
                <Button v-if="freeVideos.prev_page_url"
                    @click="$inertia.visit(freeVideos.prev_page_url)">Anterior</Button>

                <Button v-if="freeVideos.next_page_url"
                    @click="$inertia.visit(freeVideos.next_page_url)">Siguiente</Button>
            </div>

            <!-- Premium -->
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Aulas solo para socios</h2>
            <div v-if="premiumVideos && premiumVideos.data && premiumVideos.data.length"
                class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <article v-for="video in premiumVideos.data" :key="video.id"
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
                            <span v-if="!video.showFull">{{ video.description.slice(0, 100) }}<span
                                    v-if="video.description.length > 100">... <button
                                        class="text-primary-color hover:text-tertiary-color cursor-pointer"
                                        @click="video.showFull = true">leer más</button></span></span>
                            <span v-else>
                                {{ video.description }}
                                <button class="text-primary-color hover:text-tertiary-color cursor-pointer"
                                    @click="video.showFull = false">mostrar menos</button>
                            </span>
                        </p>
                    </div>
                </article>
            </div>

            <!-- Paginación -->
            <div class="md:col-span-2 mt-6 flex justify-center gap-2 mb-20">
                <Button v-if="premiumVideos.prev_page_url"
                    @click="$inertia.visit(premiumVideos.prev_page_url)">Anterior</Button>

                <Button v-if="premiumVideos.next_page_url"
                    @click="$inertia.visit(premiumVideos.next_page_url)">Siguiente</Button>
            </div>

        </section>
        <!-- Hazte socio -->
        <div v-if="user.role != 'socio'">
            <DonationBanner :imageUrl="HazteSocioImage" title="¡Hazte socio y accede a contenido exclusivo!"
                description="Conviértete en socio del Jardín del Despertar y disfruta de acceso ilimitado a nuestros clases premium"
                buttonText="Hazte socio" buttonUrl="/hazte-socio" />
        </div>
    </AppLayout>
</template>
