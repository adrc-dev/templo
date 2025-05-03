<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import headerImage from '@assets/about-us-header.jpeg';
import AboutUsBlock from '@/components/AboutUsBlock.vue';

import fachadaTemplo from '@assets/fachada-templo.png';
import meditacionFazenda from '@assets/meditacion-fazenda.png';
import atencionIndividual from '@assets/atencion-individual.png';
import introBudismo from '@assets/intro-budismo.png';
import clasesOnline from '@assets/clases-online.png';
import tarotTibetano from '@assets/tarot-tibetano.webp';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="headerImage" pageTitle="¿Quienes somos?" />
        <div class="w-full max-w-[1200px] mx-auto flex flex-col justify-center mt-16 mb-32 px-4">
            <AboutUsBlock title="Nuestro centro" :image="fachadaTemplo" alt="Imagen de nuestro centro" :paragraphs="[
                'Fundado en septiembre de 2007 por inspiración de la monja Ani Sherab Wangmo, y pertenece a la linaje Dagpo Shangpa Kagyü, una transmisión oral ininterrumpida de más de mil años. Su apertura fue bendecida por Mingyur Rinpoche y actualmente está bajo la dirección espiritual de Ani Sherab.',
                'El templo ofrece enseñanzas, oraciones y prácticas con el objetivo de cultivar felicidad, paz, compasión y despertar espiritual. Los retiros están abiertos a personas de todos los niveles.'
            ]" />

            <AboutUsBlock title="Meditación guiada" :image="meditacionFazenda" alt="Meditación grupal" :paragraphs="[
                'Conecta contigo mismo a través de sesiones guiadas de meditación, diseñadas para calmar la mente y cultivar la presencia.',
                'Nuestras clases son accesibles para todos los niveles e integran prácticas tradicionales adaptadas a la vida moderna.'
            ]" reverse />

            <AboutUsBlock title="Atención individual" :image="atencionIndividual" alt="Atención personalizada"
                :paragraphs="[
                    'Ofrecemos acompañamiento personalizado con instructores formados en escucha consciente y práctica budista.',
                    'Estas sesiones permiten profundizar en los retos personales con claridad, compasión y dirección.'
                ]" />

            <AboutUsBlock title="Introducción al budismo tibetano" :image="introBudismo" alt="Curso introductorio"
                :paragraphs="[
                    'Un curso básico para conocer las enseñanzas fundamentales del budismo y cómo aplicarlas en la vida cotidiana.',
                    'Incluye charlas, lectura guiada y espacios para la reflexión compartida.'
                ]" reverse />

            <AboutUsBlock title="Clases en línea" :image="clasesOnline" alt="Clases online" :paragraphs="[
                'Participa desde cualquier lugar en nuestras sesiones en vivo o grabadas.',
                'Usamos plataformas accesibles y ofrecemos recursos complementarios para acompañar tu aprendizaje a tu ritmo.'
            ]" />

            <AboutUsBlock title="Tarot tibetano" :image="tarotTibetano" alt="Tarot tibetano" :paragraphs="[
                'Una herramienta de autoconocimiento basada en símbolos y arquetipos del budismo tibetano.',
                'El tarot tibetano no predice el futuro, sino que ayuda a comprender el presente desde una perspectiva espiritual, revelando patrones mentales y emocionales que influyen en tu vida diaria.',
                'Ofrecemos sesiones individuales donde, a través de la lectura consciente, se abre un espacio de reflexión y guía interna.'
            ]" reverse />
        </div>

        <div id="donation"
            class="donation-container w-full bg-[url(@assets/buda-maitreya.webp)] bg-cover min-h-[500px] flex items-center justify-center relative">
            <div class="w-full max-w-[1200px] flex flex-col justify-center items-center text-center relative z-10">
                <h2 class="text-4xl font-bold text-white mb-4">Ayúdanos a seguir mejorando</h2>
                <p class="text-lg text-white mb-8">Tu contribución es fundamental para mantener nuestro templo y
                    actividades.</p>
                <a href="/donar"
                    class="bg-transparent text-white border border-white py-3 px-6 rounded-full hover:bg-secondary-color  hover:text-primary-color hover:border-secondary-color transition duration-300">Haz
                    tu donación</a>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* fondo degradad */
.donation-container::after {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background: var(--primary-color);
    opacity: 0.8;
    pointer-events: none;
}
</style>
