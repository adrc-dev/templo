<script setup lang="ts">

</script>

<template>
    <!-- contenedor principal -->
    <div class="background-container bg-white w-full h-screen flex flex-col">

        <header class="w-full max-w-[1512px] flex justify-between items-center mx-auto px-4 py-2 bg-primary text-white">
            <!-- logo -->
            <div class="flex items-center">
                <img src="@assets/logo.png" alt="Logo jardín del despertar" class="w-12 h-12 mr-2">
            </div>

            <!-- navegador -->
            <nav class="flex items-center">
                <ul class="flex space-x-4">
                    <li><a href="#" class="nav-item">Inicio</a></li>
                    <li><a href="#" class="nav-item">Nosotros</a></li>
                    <li><a href="#" class="nav-item">Servicios</a></li>
                    <li><a href="#" class="nav-item">Contacto</a></li>
                </ul>
            </nav>
        </header>

    </div>
</template>

<style scoped>
.bg-primary {
    background: #320000 !important;
}
</style>
