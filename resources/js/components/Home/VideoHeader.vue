<script setup lang="ts">

</script>

<template>
    <section class="w-full mx-auto relative">
        <!-- video -->
        <div class="flex justify-center items-center w-full">
            <video class="w-full max-h-[700px] object-cover object-top" autoplay muted loop>
                <source src="@assets/home_banner.mp4" type="video/mp4" />
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>

        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
            <div class="w-full max-w-[1200px] relative">
                <div
                    class="absolute bottom-10 right-4 hidden lg:flex flex-col items-end text-primary-color drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]">
                    <img src="@assets/logo-oscuro-rec.png" alt="Logo jardín del despertar" class="w-100 h-full">
                </div>
            </div>
        </div>

        <!-- texto fuera del video (mobile) -->
        <div class="block lg:hidden mt-6 w-[80%] text-center text-primary-color mx-auto">
            <img src="@assets/logo-oscuro-rec.png" alt="Logo jardín del despertar" class="w-130 h-full mx-auto">
        </div>
    </section>
</template>

<style scoped></style>
