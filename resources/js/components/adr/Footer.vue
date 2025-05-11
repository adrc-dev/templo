<script setup lang="ts">
</script>

<template>
    <footer class="z-10 bg-primary-color text-white">
        <!-- redes sociales en el footer -->
        <div class="bg-tertiary-color py-4">
            <div class="max-w-[1200px] mx-auto flex justify-center gap-6">
                <!-- facebook -->
                <a href="#" aria-label="Facebook"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <!-- twitter -->
                <a href="#" aria-label="Twitter"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <!-- instagram -->
                <a href="#" aria-label="Instagram"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <!-- tiktok -->
                <a href="#" aria-label="Tiktok"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-tiktok"></i>
                </a>
                <!-- email -->
                <a href="#" aria-label="Email"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fa-sharp fa-regular fa-envelope"></i>
                </a>
                <!-- whatsapp -->
                <a href="#" aria-label="WhatsApp"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
        </div>

        <!-- second footer -->
        <div class="max-w-[1200px] mx-auto px-4 py-8 flex flex-col items-center">
            <div class="mb-6">
                <a href="#">
                    <img src="@assets/logo-claro.png" alt="Logo Jardín del Despertar" class="w-100 h-auto" />
                </a>
            </div>

            <nav class="mb-6">
                <ul class="flex flex-wrap justify-center gap-6 text-sm">
                    <li><a href="#" class="hover:text-gray-300 transition">Aviso legal</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition">Política de cookies</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition">Política de privacidad</a></li>
                </ul>
            </nav>

            <div class="text-xs text-center border-t border-white/20 pt-6 w-full">
                <strong>© 2025 Jardín del Despertar.</strong> Todos los derechos reservados.
            </div>
        </div>
    </footer>
</template>

<style scoped></style>
