import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

type ModalType = 'legalNotice' | 'privacyPolicy' | 'cookiesPolicy' | null;

const activeModal = ref<ModalType>(null);

export function useLegalModal() {
    const { t } = useI18n();

    const openModal = (type: ModalType) => {
        activeModal.value = type;
    };

    const closeModal = () => {
        activeModal.value = null;
    };

    const modalTitle = computed(() => {
        switch (activeModal.value) {
            case 'legalNotice':
                return t('legal.legalNotice.title');
            case 'privacyPolicy':
                return t('legal.privacyPolicy.title');
            case 'cookiesPolicy':
                return t('legal.cookiesPolicy.title');
            default:
                return '';
        }
    });

    const modalContent = computed(() => {
        switch (activeModal.value) {
            case 'legalNotice':
                return `
          <p>${t('legal.legalNotice.holder')}</p>
          <p>${t('legal.legalNotice.address')}</p>
          <p>Email: monjasherab@gmail.com</p>
          <p>${t('legal.legalNotice.taxId')}</p>

          <p><strong>${t('legal.legalNotice.object.title')}</strong></p>
          <p>${t('legal.legalNotice.object.content')}</p>

          <p><strong>${t('legal.legalNotice.intellectualProperty.title')}</strong></p>
          <p>${t('legal.legalNotice.intellectualProperty.content')}</p>

          <p><strong>${t('legal.legalNotice.responsibility.title')}</strong></p>
          <p>${t('legal.legalNotice.responsibility.content')}</p>

          <p><strong>${t('legal.legalNotice.externalLinks.title')}</strong></p>
          <p>${t('legal.legalNotice.externalLinks.content')}</p>

          <p><strong>${t('legal.legalNotice.applicableLaw.title')}</strong></p>
          <p>${t('legal.legalNotice.applicableLaw.content')}</p>
      `;
            case 'privacyPolicy':
                return `
          <p>${t('legal.privacyPolicy.responsible')}</p>
          <p>${t('legal.privacyPolicy.address')}</p>
          <p>${t('legal.privacyPolicy.contactEmail')} monjasherab@gmail.com</p>
          <p>${t('legal.privacyPolicy.purpose')}</p>
          <p>${t('legal.privacyPolicy.legalBasis')}</p>
          <p>${t('legal.privacyPolicy.recipients')}</p>
          <p>${t('legal.privacyPolicy.rights')}</p>
          <p>${t('legal.privacyPolicy.additionalInfo')}</p>
          <p>${t('legal.privacyPolicy.guarantee')}</p>
      `;
            case 'cookiesPolicy':
                return `
          <p>${t('legal.cookiesPolicy.introduction')}</p>
          <p><strong>${t('legal.cookiesPolicy.typesTitle')}</strong></p>
          <li>${t('legal.cookiesPolicy.technicalCookies')}</li>
          <li>${t('legal.cookiesPolicy.analyticalCookies')}</li>

          <p><strong>${t('legal.cookiesPolicy.managementTitle')}</strong></p>
          <li>${t('legal.cookiesPolicy.managementContent')}</li>

          <p>${t('legal.cookiesPolicy.acceptance')}</p>
      `;
            default:
                return '';
        }
    });

    return {
        activeModal,
        openModal,
        closeModal,
        modalTitle,
        modalContent,
    };
}
