<script setup lang="ts">
import LegalModal from '@/components/LegalModal.vue'
import { useLegalModal } from '@/composables/useLegalModal'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const { activeModal, openModal, closeModal, modalTitle, modalContent } = useLegalModal()
</script>

<template>
    <footer class="z-10 bg-primary-color text-white">
        <!-- redes sociales en el footer -->
        <div class="bg-tertiary-color py-4">
            <div class="max-w-[1200px] mx-auto flex justify-center gap-6">
                <!-- facebook -->
                <a href="#" :aria-label="t('footer.facebook')"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <!-- instagram -->
                <a href="#" :aria-label="t('footer.instagram')"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <!-- tiktok -->
                <a href="#" :aria-label="t('footer.tiktok')"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fab fa-tiktok"></i>
                </a>
                <!-- email -->
                <a href="#" :aria-label="t('footer.email')"
                    class="bg-primary-color text-white rounded-full w-12 h-12 flex items-center justify-center hover:opacity-80 transition">
                    <i class="fa-sharp fa-regular fa-envelope"></i>
                </a>
                <!-- whatsapp -->
                <a href="#" :aria-label="t('footer.whatsapp')"
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
                        {{ t('footer.legalNotice') }}
                    </li>
                    <li class="text-white hover:text-gray-300 transition cursor-pointer"
                        @click="activeModal = 'cookiesPolicy'">
                        {{ t('footer.cookiesPolicy') }}
                    </li>
                    <li class="text-white hover:text-gray-300 transition cursor-pointer"
                        @click="activeModal = 'privacyPolicy'">
                        {{ t('footer.privacyPolicy') }}
                    </li>
                </ul>
            </nav>

            <LegalModal :visible="!!activeModal" :title="modalTitle" :content="modalContent" @close="closeModal" />

            <div class="text-xs text-center border-t border-white/20 pt-6 w-full">
                <strong>© 2025 Jardín del Despertar.</strong> {{ t('footer.rightsReserved') }}
            </div>
        </div>
    </footer>
</template>

<style scoped></style>
