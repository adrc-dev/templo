<script lang="ts" setup>
</script>
<template>
    <header class="z-20">
        <!-- barra superior -->
        <div class="py-1 bg-secondary-color w-full">
            <div class="flex items-center text-primary-color justify-between max-w-[1200px] w-full mx-auto px-4">
                <div><a href="#" class="hover:text-tertiary-color">Entrar en contacto</a></div>
                <div><a href="#" class="hover:text-tertiary-color">¡Hazte socio!</a></div>
            </div>
        </div>
        <div class="w-full bg-primary-color h-[100px] flex items-center">
            <div class="max-w-[1200px] w-full flex justify-between items-center mx-auto px-4 py-2 text-white">
                <!-- logo -->
                <div class="flex items-center">
                    <a href="/"><img src="@assets/logo-claro-solo.png" alt="Logo jardín del despertar"
                            class="w-45 h-full"></a>
                </div>

                <!-- navegador -->
                <nav class="flex items-center">
                    <ul class="flex space-x-4">
                        <li><a href="/about-us" class="text-white hover:text-gray-300">Quienes somos</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Eventos</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Aulas</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Nuestra tienda</a></li>
                        <li><a href="#" class="text-white hover:text-gray-300">Novedades</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>

<style scoped></style>
