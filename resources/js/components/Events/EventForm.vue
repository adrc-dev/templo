<script setup lang="ts">
import { defineEmits, defineProps, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Checkbox } from '@/components/ui/checkbox'
import { Button } from '@/components/ui/button'
import { LoaderCircle } from 'lucide-vue-next'
import Select from '@/components/ui/Select/Select.vue'
import InputError from '@/components/InputError.vue';

const props = defineProps<{ event?: any }>()
const emit = defineEmits(['submit'])

const form = useForm({
    title: props.event?.title ?? '',
    slug: props.event?.slug ?? '',
    content: props.event?.content ?? '',
    event_date: props.event?.event_date ?? '',
    event_time: props.event?.event_time ?? '',
    event_end_date: props.event?.event_end_date ?? '',
    event_end_time: props.event?.event_end_time ?? '',
    event_location: props.event?.event_location ?? '',
    modality: props.event?.modality ?? '',
    price: Number(props.event?.price ?? 0),
    currency: props.event?.currency ?? 'EUR',
    featured_image: props.event?.featured_image ?? '',
    is_active: props.event?.is_active ?? true,
    language: props.event?.language ?? 'es',
    seo_title: props.event?.seo_title ?? '',
    seo_description: props.event?.seo_description ?? '',
})

// Función para generar slug
function generateSlug(text: string): string {
    return text
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
}

// Watch para actualizar el slug automáticamente
watch(() => form.title, (newTitle) => {
    if (!props.event?.slug) {
        form.slug = generateSlug(newTitle + `-${Date.now()}`)
    }
})

function submit() {
    form.transform((data) => {
        const formData = new FormData()
        formData.append('title', data.title)
        formData.append('slug', data.slug)
        formData.append('content', data.content)
        formData.append('event_date', data.event_date)
        formData.append('event_time', data.event_time)
        formData.append('event_end_date', data.event_end_date)
        formData.append('event_end_time', data.event_end_time)
        formData.append('event_location', data.event_location)
        formData.append('modality', data.modality)
        formData.append('price', data.price.toString())
        formData.append('currency', data.currency)
        formData.append('language', data.language)
        formData.append('seo_title', data.seo_title)
        formData.append('seo_description', data.seo_description)
        formData.append('is_active', data.is_active ? '1' : '0')

        if (data.featured_image instanceof File) {
            formData.append('featured_image', data.featured_image)
        }

        if (props.event) {
            formData.append('_method', 'PUT')
        }

        return formData
    })

    const url = props.event
        ? route('events.update', props.event.slug)
        : route('events.store')

    form.post(url, {
        preserveScroll: true,
        onSuccess: () => emit('submit'),
    })
}

function handleFileUpload(event: Event) {
    const file = (event.target as HTMLInputElement).files?.[0]
    if (file) {
        form.featured_image = file
    }
}
</script>

<template>
    <form @submit.prevent="submit" class="space-y-4">
        <div>
            <Label>{{ $t('events.eventForm.title_label') }}</Label>
            <Input v-model="form.title" :placeholder="$t('events.eventForm.title_placeholder')" required />
            <InputError :message="form.errors.title" />
        </div>

        <div>
            <Label>{{ $t('events.eventForm.content_label') }}</Label>
            <Textarea v-model="form.content" :placeholder="$t('events.eventForm.content_placeholder')" :rows="8"
                required />
            <InputError :message="form.errors.content" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>{{ $t('events.eventForm.start_date_label') }}</Label>
                <Input type="date" v-model="form.event_date" required />
                <InputError :message="form.errors.event_date" />
            </div>
            <div>
                <Label>{{ $t('events.eventForm.start_time_label') }}</Label>
                <Input type="time" v-model="form.event_time" required />
                <InputError :message="form.errors.event_time" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>{{ $t('events.eventForm.end_date_label') }}</Label>
                <Input type="date" v-model="form.event_end_date" />
                <InputError :message="form.errors.event_end_date" />
            </div>
            <div>
                <Label>{{ $t('events.eventForm.end_time_label') }}</Label>
                <Input type="time" v-model="form.event_end_time" />
                <InputError :message="form.errors.event_end_time" />
            </div>
        </div>

        <div>
            <Label>{{ $t('events.eventForm.location_label') }}</Label>
            <Input v-model="form.event_location" :placeholder="$t('events.eventForm.location_placeholder')" required />
            <InputError :message="form.errors.event_location" />
        </div>

        <div>
            <Label>{{ $t('events.eventForm.modality_label') }}</Label>
            <Select v-model="form.modality" :options="[
                { value: 'Presencial', label: $t('events.eventForm.modality_presential') },
                { value: 'Online', label: $t('events.eventForm.modality_online') }
            ]" required :placeholder="$t('events.eventForm.modality_placeholder')" />
            <InputError :message="form.errors.modality" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>{{ $t('events.eventForm.price_label') }}</Label>
                <Input type="number" v-model="form.price" min="0" step="0.01"
                    :placeholder="$t('events.eventForm.price_placeholder')" required />
                <InputError :message="form.errors.price" />
            </div>
            <div>
                <Label>{{ $t('events.eventForm.currency_label') }}</Label>
                <Input v-model="form.currency" :placeholder="$t('events.eventForm.currency_placeholder')"
                    maxlength="3" />
                <InputError :message="form.errors.currency" />
            </div>
        </div>

        <div>
            <Label>{{ $t('events.eventForm.featured_image_label') }}</Label>
            <Input type="file" @change="handleFileUpload" accept="image/*" />
            <InputError :message="form.errors.featured_image" />
        </div>

        <div>
            <Label>{{ $t('events.eventForm.language_label') }}</Label>
            <Input v-model="form.language" :placeholder="$t('events.eventForm.language_placeholder')" maxlength="2"
                required />
            <InputError :message="form.errors.language" />
        </div>

        <div>
            <Label>{{ $t('events.eventForm.seo_title_label') }}</Label>
            <Input v-model="form.seo_title" :placeholder="$t('events.eventForm.seo_title_placeholder')" />
            <InputError :message="form.errors.seo_title" />
        </div>

        <div>
            <Label>{{ $t('events.eventForm.seo_description_label') }}</Label>
            <Textarea v-model="form.seo_description" :placeholder="$t('events.eventForm.seo_description_placeholder')"
                :rows="2" />
            <InputError :message="form.errors.seo_description" />
        </div>

        <div>
            <Label class="flex items-center">
                <Checkbox v-model="form.is_active" />
                <span class="ml-2">{{ $t('events.eventForm.active_label') }}</span>
            </Label>
            <InputError :message="form.errors.is_active" />
        </div>

        <div class="flex justify-center mt-6">
            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
            <Button type="submit" variant="transparent">
                {{ $t('events.eventForm.save_button') }}
            </Button>
        </div>
    </form>
</template>
