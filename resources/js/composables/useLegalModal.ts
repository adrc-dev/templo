// src/composables/useLegalModal.ts
import { computed, ref } from 'vue';

type ModalType = 'legalNotice' | 'privacyPolicy' | 'cookiesPolicy' | null;

const activeModal = ref<ModalType>(null);

const openModal = (type: ModalType) => {
    activeModal.value = type;
};

const closeModal = () => {
    activeModal.value = null;
};

const modalTitle = computed(() => {
    switch (activeModal.value) {
        case 'legalNotice':
            return 'Aviso legal';
        case 'privacyPolicy':
            return 'Política de privacidad';
        case 'cookiesPolicy':
            return 'Política de cookies';
        default:
            return '';
    }
});

const modalContent = computed(() => {
    switch (activeModal.value) {
        case 'legalNotice':
            return `
                <p>Titular: Templo budista Jardín del Despertar</p>
                <p>Domicilio social: Rua Engenheiro Rebouças 1040, São Caetano do Sul, SP, Brasil - 09540-000</p>
                <p>Email: monjasherab@gmail.com</p>
                <p>NIF/CIF: 074.647.658-26</p>

                <p><strong>OBJETO:</strong></p>
                <p>Este sitio web tiene como finalidad ofrecer información sobre el templo budista, sus actividades, eventos, enseñanzas y recursos para personas interesadas.</p>

                <p><strong>PROPIEDAD INTELECTUAL:</strong></p>
                <p>
                    Todos los contenidos de esta web, incluidos textos, imágenes, logotipos, vídeos o cualquier otro material, son propiedad del templo budista o de sus respectivos autores, y están protegidos por los derechos de propiedad intelectual e industrial.
                </p>

                <p><strong>RESPONSABILIDAD:</strong></p>
                <p>
                    El titular no se hace responsable del mal uso de los contenidos del sitio, ni de posibles daños derivados de su uso. Nos reservamos el derecho a modificar el contenido del sitio sin previo aviso.
                </p>

                <p><strong>ENLACES EXTERNOS:</strong></p>
                <p>Este sitio puede contener enlaces a páginas de terceros. No nos hacemos responsables del contenido ni de la política de privacidad de dichas páginas.</p>

                <p><strong>LEGISLACIÓN APLICABLE:</strong></p>
                <p>
                    La relación entre el usuario y el titular del sitio se regirá por la normativa española vigente.
                </p>
            `;
        case 'privacyPolicy':
            return `
                <p>Responsable: Jardín del despertar</p>
                <p>Dirección: Engenheiro rebouças 1040</p>
                <p>Email de contacto: monjasherab@gmail.com</p>
                <p>Finalidad: Gestionar las comunicaciones, actividades y servicios ofrecidos por el templo a través del sitio web.</p>
                <p>Base legal: Consentimiento del usuario y cumplimiento de obligaciones legales.</p>
                <p>
                    Destinatarios: No se cederán datos a terceros, salvo obligación legal.
                    Derechos: Acceder, rectificar y suprimir los datos, así como otros derechos detallados en la
                    información adicional.
                </p>
                <p>
                    Información adicional: Puedes consultar la información adicional y detallada sobre Protección de Datos solicitándola por email a nuestro responsable.
                </p>
                <p>
                    El templo budista garantiza la confidencialidad de los datos personales y el cumplimiento de la normativa de protección de datos conforme al Reglamento (UE) 2016/679 (RGPD) y la Ley Orgánica 3/2018 (LOPDGDD).
                </p>
            `;
        case 'cookiesPolicy':
            return `
                <p>
                    Este sitio web utiliza cookies propias y de terceros con fines técnicos y estadísticos. Una cookie es un pequeño archivo que se descarga en tu navegador al acceder a determinadas páginas web.
                </p>
                <p><strong>TIPOS DE COOKIES UTILIZADAS:</strong></p>
                <li>Cookies técnicas: necesarias para el funcionamiento del sitio.</li>
                <li>Cookies analíticas: utilizadas para obtener estadísticas de uso mediante herramientas como Google Analytics.</li>

                <p><strong>GESTIÓN DE COOKIES:</strong></p>
                <li>Puedes permitir, bloquear o eliminar las cookies instaladas en tu equipo configurando las opciones del navegador que estés utilizando.</li>

                <p>Al continuar navegando por este sitio web, aceptas el uso de cookies en las condiciones establecidas en esta Política.</p>
            `;
        default:
            return '';
    }
});

export function useLegalModal() {
    return {
        activeModal,
        openModal,
        closeModal,
        modalTitle,
        modalContent,
    };
}
