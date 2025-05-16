<script setup lang="ts">
import { ref, computed } from 'vue';
import LegalModal from '@/Components/adr/LegalModal.vue';

const activeModal = ref(null);

const closeModal = () => {
    activeModal.value = null;
}
const modalTitle = computed(() => {
    switch (activeModal.value) {
        case 'legalNotice':
            return 'Aviso legal';
        case 'cookiesPolicy':
            return 'Política de cookies';
        case 'privacyPolicy':
            return 'Política de privacidad';
        default:
            return '';
    }
})
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
                    <li class="text-white hover:text-gray-300 transition cursor-pointer"
                        @click="activeModal = 'legalNotice'">
                        Aviso legal
                    </li>
                    <li class="text-white hover:text-gray-300 transition cursor-pointer"
                        @click="activeModal = 'cookiesPolicy'">
                        Política de cookies
                    </li>
                    <li class="text-white hover:text-gray-300 transition cursor-pointer"
                        @click="activeModal = 'privacyPolicy'">
                        Política de privacidad
                    </li>
                </ul>
            </nav>
            <LegalModal :visible="!!activeModal" :title="modalTitle" @close="closeModal">
                <!-- aviso legal -->
                <template v-if="activeModal === 'legalNotice'">
                    <p>Titular: Templo budista Jardín del Despertar</p>
                    <p>Domicilio social: Rua Engenheiro Rebouças 1040, São Caetano do Sul, SP, Brasil - 09540-000</p>
                    <p>Email: monjasherab@gmail.com</p>
                    <p>NIF/CIF: 074.647.658-26</p>

                    <p><strong>OBJETO:</strong></p>
                    <p>Este sitio web tiene como finalidad ofrecer información sobre el templo budista, sus actividades,
                        eventos, enseñanzas y recursos para personas interesadas.</p>

                    <p><strong>PROPIEDAD INTELECTUAL:</strong></p>
                    <p>Todos los contenidos de esta web, incluidos textos, imágenes, logotipos, vídeos o cualquier otro
                        material, son propiedad del templo budista o de sus respectivos autores, y están protegidos por
                        los derechos de propiedad intelectual e industrial.</p>

                    <p><strong>RESPONSABILIDAD:</strong></p>
                    <p>El titular no se hace responsable del mal uso de los contenidos del sitio, ni de posibles daños
                        derivados de su uso. Nos reservamos el derecho a modificar el contenido del sitio sin previo
                        aviso.</p>

                    <p><strong>ENLACES EXTERNOS:</strong></p>
                    <p>Este sitio puede contener enlaces a páginas de terceros. No nos hacemos responsables del
                        contenido ni de la política de privacidad de dichas páginas.</p>

                    <p><strong>LEGISLACIÓN APLICABLE:</strong></p>
                    <p>La relación entre el usuario y el titular del sitio se regirá por la normativa española vigente.
                    </p>
                </template>

                <!-- cookies -->
                <template v-else-if="activeModal === 'cookiesPolicy'">
                    <p>Este sitio web utiliza cookies propias y de terceros con fines técnicos y estadísticos. Una
                        cookie es un pequeño archivo que se descarga en tu navegador al acceder a determinadas páginas
                        web.</p>

                    <p><strong>TIPOS DE COOKIES UTILIZADAS:</strong></p>

                    <li>Cookies técnicas: necesarias para el funcionamiento del sitio.</li>
                    <li>Cookies analíticas: utilizadas para obtener estadísticas de uso mediante herramientas como
                        Google Analytics.</li>

                    <p><strong>GESTIÓN DE COOKIES:</strong></p>

                    <li>Puedes permitir, bloquear o eliminar las cookies instaladas en tu equipo configurando las
                        opciones del navegador que estés utilizando.</li>


                    <p>Al continuar navegando por este sitio web, aceptas el uso de cookies en las condiciones
                        establecidas en esta Política.</p>
                </template>

                <!-- privacidad -->
                <template v-else-if="activeModal === 'privacyPolicy'">
                    <p>Responsable: Jardín del despertar</p>
                    <p>Dirección: Engenheiro rebouças 1040</p>
                    <p>Email de contacto: monjasherab@gmail.com</p>
                    <p>Finalidad: Gestionar las comunicaciones, actividades y servicios ofrecidos por el templo a
                        través del sitio web.</p>
                    <p>Base legal: Consentimiento del usuario y cumplimiento de obligaciones legales.</p>
                    <p>Destinatarios: No se cederán datos a terceros, salvo obligación legal.
                        Derechos: Acceder, rectificar y suprimir los datos, así como otros derechos detallados en la
                        información adicional.</p>
                    <p>Información adicional: Puedes consultar la información adicional y detallada sobre Protección
                        de
                        Datos solicitándola por email a nuestro responsable.</p>

                    <p>El templo budista garantiza la confidencialidad de los datos personales y el cumplimiento de
                        la
                        normativa de protección de datos conforme al Reglamento (UE) 2016/679 (RGPD) y la Ley
                        Orgánica
                        3/2018 (LOPDGDD).</p>
                </template>
            </LegalModal>

            <div class="text-xs text-center border-t border-white/20 pt-6 w-full">
                <strong>© 2025 Jardín del Despertar.</strong> Todos los derechos reservados.
            </div>
        </div>
    </footer>
</template>

<style scoped></style>
