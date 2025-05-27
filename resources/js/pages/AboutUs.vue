<script setup lang="ts">
import HeaderBanner from '@/components/adr/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import headerImage from '@assets/about-us-header.jpeg';
import donationImage from '@assets/buda-maitreya.png';
import AboutUsBlock from '@/components/adr/AboutUsBlock.vue';

import fachadaTemplo from '@assets/fachada-templo.png';
import meditacionFazenda from '@assets/meditacion-fazenda.png';
import atencionIndividual from '@assets/atencion-individual.png';
import introBudismo from '@assets/intro-budismo.png';
import clasesOnline from '@assets/clases-online.png';
import tarotTibetano from '@assets/tarot-tibetano.webp';
import DonationBanner from '@/components/adr/DonationBanner.vue';
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="headerImage" pageTitle="¿Quienes somos?" />
        </div>

        <h2 class="text-4xl font-bold text-center text-primary-color my-20">¿Quienes somos?</h2>
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

        <DonationBanner :imageUrl="donationImage" title="Ayúdanos a seguir mejorando"
            description="Tu contribución es fundamental para mantener nuestro templo y actividades."
            buttonText="Haz tu donación" />
    </AppLayout>
</template>

<style scoped></style>
