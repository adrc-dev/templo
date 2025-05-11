<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import EventCard from '@/components/adr/EventCard.vue';

import EventsImage from '@assets/eventos-banner.jpg';

const events = [
    {
        id: 1,
        title: "Retiro de Silencio en Montaña",
        date: "2025-05-10",
        description: "Te invitamos a vivir una experiencia transformadora de meditación en la montaña, rodeado de naturaleza, silencio y conexión interior. Durante este retiro de dos días en una encantadora masía rural en la provincia de Girona, te desconectarás del ruido del día a día para re-conectar contigo mismo desde la calma, la presencia y la atención plena. \n\nEl retiro incluye sesiones de meditación guiada, charlas sobre el budismo y la atención plena, y actividades al aire libre para disfrutar de la belleza del entorno natural. Además, tendrás la oportunidad de compartir tus experiencias con otros participantes en un ambiente de respeto y apoyo mutuo.\n\nNo importa si eres principiante o ya tienes experiencia en meditación, este retiro está diseñado para todos los niveles. Ven a descubrir la paz interior y la claridad mental que puedes alcanzar a través de la meditación.",
        image: "https://picsum.photos/800/600"
    },
    {
        id: 2,
        title: "Charla: La mente y el sufrimiento",
        date: "2025-05-18",
        description: "Exploraremos cómo el budismo aborda el sufrimiento mental con herramientas prácticas. \n\nEn esta charla, profundizaremos en la relación entre la mente y el sufrimiento, y cómo el budismo ofrece herramientas prácticas para abordar estos desafíos. Aprenderás sobre la naturaleza de la mente, las emociones y cómo cultivar una mentalidad más positiva y resiliente. \n\nLa charla será interactiva, con espacio para preguntas y reflexiones. No es necesario tener experiencia previa en meditación o budismo, todos son bienvenidos.",
        image: "https://picsum.photos/800/600"
    },
    {
        id: 3,
        title: "Meditación al Atardecer",
        date: "2025-05-22",
        description: "Encuentro gratuito al aire libre para meditar al atardecer en el parque de la ciudad. \n\nTe invitamos a unirte a nosotros para una sesión de meditación al aire libre, donde podrás disfrutar de la belleza del atardecer mientras practicas la atención plena y la conexión con la naturaleza. Este evento es gratuito y abierto a todos, sin importar tu nivel de experiencia en meditación. \n\nNo olvides traer una manta o cojín para sentarte cómodamente, y si lo deseas, puedes traer algo para compartir con los demás después de la meditación.",
        image: "https://picsum.photos/800/600"
    },
    {
        id: 4,
        title: "Meditación al Atardecer",
        date: "2025-05-22",
        description: "Encuentro gratuito al aire libre para meditar al atardecer en el parque de la ciudad. \n\nTe invitamos a unirte a nosotros para una sesión de meditación al aire libre, donde podrás disfrutar de la belleza del atardecer mientras practicas la atención plena y la conexión con la naturaleza. Este evento es gratuito y abierto a todos, sin importar tu nivel de experiencia en meditación. \n\nNo olvides traer una manta o cojín para sentarte cómodamente, y si lo deseas, puedes traer algo para compartir con los demás después de la meditación.",
        image: "https://picsum.photos/800/600"
    },
    {
        id: 5,
        title: "Meditación al Atardecer",
        date: "2025-05-22",
        description: "Encuentro gratuito al aire libre para meditar al atardecer en el parque de la ciudad. \n\nTe invitamos a unirte a nosotros para una sesión de meditación al aire libre, donde podrás disfrutar de la belleza del atardecer mientras practicas la atención plena y la conexión con la naturaleza. Este evento es gratuito y abierto a todos, sin importar tu nivel de experiencia en meditación. \n\nNo olvides traer una manta o cojín para sentarte cómodamente, y si lo deseas, puedes traer algo para compartir con los demás después de la meditación.",
        image: "https://picsum.photos/800/600"
    },

]
/*
defineProps({
    events: Array as () => {
        id: number,
        title: string,
        date: string,
        description: string,
        image: string
    }[]
})
*/
const upcomingEvent = events[0]
const otherEvents = events.slice(1)
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="EventsImage" pageTitle="Eventos" class="bg-primary-color/50" />

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Eventos fijos</h2>
            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
                <img src="@assets/meditacion-online.jpg" alt="Evento fijo"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div>
                    <p class="text-sm text-secondary-color mb-2">Todos los jueves a las 20:00
                    </p>
                    <h2 class="text-3xl font-bold text-primary-color mb-4">Clases de meditación en línea</h2>
                    <p class="text-primary-color mb-4">Te invitamos a conectar contigo mismo y encontrar paz interior
                        desde
                        la comodidad de tu hogar. Cada jueves ofrecemos sesiones de meditación guiada en línea,
                        diseñadas para reducir el estrés, calmar la mente y cultivar la atención plena. No importa si
                        eres principiante o ya tienes experiencia: nuestras clases están abiertas para todos.</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3 text-center text-lg">
                        <div>
                            <span class="block font-semibold text-primary-color">📅 Cuándo</span>
                            <span class="text-primary-color">Todos los jueves</span>
                        </div>
                        <div>
                            <span class="block font-semibold text-primary-color">⏰ Hora</span>
                            <span class="text-primary-color">20:00 - 21:00</span>
                        </div>
                        <div>
                            <span class="block font-semibold text-primary-color">🌐 Modalidad</span>
                            <span class="text-primary-color">Online por Zoom</span>
                        </div>
                    </div>
                    <div class="mt-6 flex align-center justify-center">
                        <a href="#" target="_blank"
                            class="bg-primary-color text-white py-3 px-6 rounded-full hover:bg-tertiary-color hover:text-white transition duration-300">
                            Únete al grupo de WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Proximo Evento</h2>
            <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
                <img :src="upcomingEvent.image" alt="Evento principal"
                    class="w-full h-90 object-cover rounded-xl shadow-lg" />
                <div>
                    <p class="text-sm text-secondary-color mb-2">{{ new Date(upcomingEvent.date).toLocaleDateString() }}
                    </p>
                    <h2 class="text-3xl font-bold text-primary-color mb-4">{{ upcomingEvent.title }}</h2>
                    <p class="text-primary-color mb-4 line-clamp-8">{{ upcomingEvent.description }}</p>
                    <div class="mt-4 flex justify-center">
                        <a :href="`/eventos/${upcomingEvent.id}`"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Más información
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full px-4 max-w-[1200px] mx-auto">
            <h2 class="text-4xl font-bold text-center text-primary-color my-20">Otros Eventos</h2>
            <div class="w-full mx-auto grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-20">
                <EventCard v-for="event in otherEvents" :key="event.id" :image="event.image" :title="event.title"
                    :description="event.description" :date="event.date" :link="`/eventos/${event.id}`">
                    <!-- Puedes sobrescribir slots si quieres, por ejemplo el botón
                    <template #button>
                        <a :href="`/eventos/${event.id}`"
                            class="bg-primary-color text-white font-semibold py-2 px-4 rounded-lg hover:bg-tertiary-color transition duration-300">
                            Más información
                        </a>
                    </template>
-->
                </EventCard>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
