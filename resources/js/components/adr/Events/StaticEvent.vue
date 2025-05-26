<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto">
        <h2 class="text-4xl font-bold text-center text-primary-color my-20">Eventos fijos</h2>
        <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
            <img src="@assets/meditacion-online.jpg" alt="Evento fijo"
                class="w-full h-90 object-cover rounded-xl shadow-lg" />
            <div>
                <p class="text-sm text-secondary-color mb-2">Todos los jueves a las 20:00</p>
                <h2 class="text-3xl font-bold text-primary-color mb-4">Clases de meditación en línea</h2>
                <p class="text-primary-color mb-4">Te invitamos a conectar contigo mismo [...]</p>
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
                    <Button @click="$inertia.visit('#')" target="_blank">
                        Únete al grupo de WhatsApp
                    </Button>
                </div>
            </div>
        </div>
    </section>
</template>
