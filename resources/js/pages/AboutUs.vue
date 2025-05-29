<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import headerImage from '@assets/about-us-header.jpeg';
import donationImage from '@assets/buda-maitreya.png';
import AboutUsBlock from '@/components/AboutUsBlock.vue';
import fachadaTemplo from '@assets/fachada-templo.png';
import meditacionFazenda from '@assets/meditacion-fazenda.png';
import atencionIndividual from '@assets/atencion-individual.png';
import introBudismo from '@assets/intro-budismo.png';
import clasesOnline from '@assets/clases-online.png';
import tarotTibetano from '@assets/tarot-tibetano.webp';
import DonationBanner from '@/components/DonationBanner.vue';
</script>

<template>
    <AppLayout>
        <div class="hidden md:block">
            <HeaderBanner :imageUrl="headerImage" :pageTitle="$t('aboutUs.title')" />
        </div>

        <h2 class="text-4xl font-bold text-center text-primary-color my-20">{{ $t('aboutUs.title') }}</h2>
        <div class="w-full max-w-[1200px] mx-auto flex flex-col justify-center mt-16 mb-32 px-4">
            <AboutUsBlock :title="$t('aboutUs.our_center.title')" :image="fachadaTemplo"
                :alt="$t('aboutUs.our_center.alt')" :paragraphs="[
                    $t('aboutUs.our_center.paragraph1'),
                    $t('aboutUs.our_center.paragraph2')
                ]" />

            <AboutUsBlock :title="$t('aboutUs.guided_meditation.title')" :image="meditacionFazenda"
                :alt="$t('aboutUs.guided_meditation.alt')" :paragraphs="[
                    $t('aboutUs.guided_meditation.paragraph1'),
                    $t('aboutUs.guided_meditation.paragraph2')
                ]" reverse />

            <AboutUsBlock :title="$t('aboutUs.individual_attention.title')" :image="atencionIndividual"
                :alt="$t('aboutUs.individual_attention.alt')" :paragraphs="[
                    $t('aboutUs.individual_attention.paragraph1'),
                    $t('aboutUs.individual_attention.paragraph2')
                ]" />

            <AboutUsBlock :title="$t('aboutUs.tibetan_buddhism_intro.title')" :image="introBudismo"
                :alt="$t('aboutUs.tibetan_buddhism_intro.alt')" :paragraphs="[
                    $t('aboutUs.tibetan_buddhism_intro.paragraph1'),
                    $t('aboutUs.tibetan_buddhism_intro.paragraph2')
                ]" reverse />

            <AboutUsBlock :title="$t('aboutUs.online_classes.title')" :image="clasesOnline"
                :alt="$t('aboutUs.online_classes.alt')" :paragraphs="[
                    $t('aboutUs.online_classes.paragraph1'),
                    $t('aboutUs.online_classes.paragraph2')
                ]" />

            <AboutUsBlock :title="$t('aboutUs.tibetan_tarot.title')" :image="tarotTibetano"
                :alt="$t('aboutUs.tibetan_tarot.alt')" :paragraphs="[
                    $t('aboutUs.tibetan_tarot.paragraph1'),
                    $t('aboutUs.tibetan_tarot.paragraph2'),
                    $t('aboutUs.tibetan_tarot.paragraph3')
                ]" reverse />
        </div>

        <DonationBanner :imageUrl="donationImage" :title="$t('home.donationBanner.title')"
            :description="$t('home.donationBanner.description')" :buttonText="$t('home.donationBanner.buttonText')" />
    </AppLayout>
</template>

<style scoped></style>
