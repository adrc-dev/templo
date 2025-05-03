<script setup lang="ts">
import HeaderBanner from '@/components/HeaderBanner.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import headerImage from '@assets/about-us-header.jpeg';
</script>

<template>
    <AppLayout>
        <HeaderBanner :imageUrl="headerImage" pageTitle="¿Quienes somos?" />
        <!-- container -->
        <div class="w-full max-w-[1200px] mx-auto flex flex-col items-center justify-center my-16 px-4 ">
            <!-- nuestro centro -->
            <div class="flex flex-row w-full min-h-[400px]">
                <div class="flex flex-col justify-center w-1/2 pr-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Nuestro centro</h3>
                    <p class="text-primary-color text-lg">
                        Fundado en septiembre de 2007 por inspiración de la monja Ani Sherab Wangmo, y pertenece a la
                        linaje Dagpo Shangpa Kagyü, una transmisión oral ininterrumpida de más de mil años. Su apertura
                        fue bendecida por Mingyur Rinpoche y actualmente está bajo la dirección espiritual de Ani
                        Sherab.
                    </p>
                    <p class="text-primary-color text-lg mt-4 pb-4">
                        El templo ofrece enseñanzas, oraciones y prácticas con el objetivo de cultivar felicidad, paz,
                        compasión y despertar espiritual. Los retiros están abiertos a personas de todos los niveles.
                    </p>
                </div>
                <img src="@assets/fachada-templo.png" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
            </div>

            <!-- meditación grupal -->
            <div class="flex flex-row w-full min-h-[400px]">
                <img src="@assets/meditacion-fazenda.png" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
                <div class="flex flex-col justify-center w-1/2 pl-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Meditación guiada</h3>
                    <p class="text-primary-color text-lg">
                        Conecta contigo mismo a través de sesiones guiadas de meditación, diseñadas para calmar la mente
                        y cultivar la presencia.
                    </p>
                    <p class="text-primary-color text-lg mt-4">
                        Nuestras clases son accesibles para todos los niveles e integran prácticas tradicionales
                        adaptadas a la vida moderna.
                    </p>
                </div>
            </div>

            <!-- atención individual -->
            <div class="flex flex-row w-full min-h-[400px]">
                <div class="flex flex-col justify-center w-1/2 pr-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Atención individual</h3>
                    <p class="text-primary-color text-lg">
                        Ofrecemos acompañamiento personalizado con instructores formados en escucha consciente y
                        práctica budista.
                    </p>
                    <p class="text-primary-color text-lg mt-4 pb-4">
                        Estas sesiones permiten profundizar en los retos personales con claridad, compasión y dirección.
                    </p>
                </div>
                <img src="@assets/atencion-individual.png" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
            </div>

            <!-- introducción al budismo -->
            <div class="flex flex-row w-full min-h-[400px]">
                <img src="@assets/intro-budismo.png" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
                <div class="flex flex-col justify-center w-1/2 pl-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Introducción al budismo tibetano</h3>
                    <p class="text-primary-color text-lg">
                        Un curso básico para conocer las enseñanzas fundamentales del budismo y cómo aplicarlas en la
                        vida cotidiana.
                    </p>
                    <p class="text-primary-color text-lg mt-4">
                        Incluye charlas, lectura guiada y espacios para la reflexión compartida.
                    </p>
                </div>
            </div>

            <!-- clases en linea -->
            <div class="flex flex-row w-full min-h-[400px]">
                <div class="flex flex-col justify-center w-1/2 pr-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Clases en linea</h3>
                    <p class="text-primary-color text-lg">
                        Participa desde cualquier lugar en nuestras sesiones en vivo o grabadas.
                    </p>
                    <p class="text-primary-color text-lg mt-4 pb-4">
                        Usamos plataformas accesibles y ofrecemos recursos complementarios para acompañar tu aprendizaje
                        a tu ritmo.
                    </p>
                </div>
                <img src="@assets/clases-online.png" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
            </div>

            <!-- tarot tibetano -->
            <div class="flex flex-row w-full max-h-[400px]">
                <img src="@assets/tarot-tibetano.webp" alt="imagen de nuestro centro"
                    class="w-1/2 object-cover max-h-[700px] h-auto">
                <div class="flex flex-col justify-center w-1/2 pl-12">
                    <h3 class="text-primary-color text-center text-3xl mb-4">Tarot tibetano</h3>
                    <p class="text-primary-color text-lg">
                        Una herramienta de autoconocimiento basada en símbolos y arquetipos del budismo tibetano.
                    </p>
                    <p class="text-primary-color text-lg mt-4">
                        El tarot tibetano no predice el futuro, sino que ayuda a comprender el presente desde una
                        perspectiva espiritual, revelando patrones mentales y emocionales que influyen en tu vida
                        diaria.
                    </p>
                    <p class="text-primary-color text-lg mt-4">
                        Ofrecemos sesiones individuales donde, a través de la lectura consciente, se abre un espacio de
                        reflexión y guía interna.
                    </p>
                </div>
            </div>
        </div>
        <div>

        </div>
    </AppLayout>
</template>

<style scoped></style>
