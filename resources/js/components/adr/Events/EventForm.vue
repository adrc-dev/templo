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
import { router } from '@inertiajs/vue3'
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
            <Label>Título*</Label>
            <Input v-model="form.title" placeholder="Título del evento" required />
            <InputError :message="form.errors.title" />
        </div>

        <div>
            <Label>Contenido*</Label>
            <Textarea v-model="form.content" placeholder="Descripción detallada del evento" :rows="8" required />
            <InputError :message="form.errors.content" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Fecha inicio*</Label>
                <Input type="date" v-model="form.event_date" required />
                <InputError :message="form.errors.event_date" />
            </div>
            <div>
                <Label>Hora inicio*</Label>
                <Input type="time" v-model="form.event_time" required />
                <InputError :message="form.errors.event_time" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Fecha fin</Label>
                <Input type="date" v-model="form.event_end_date" />
                <InputError :message="form.errors.event_end_date" />
            </div>
            <div>
                <Label>Hora fin</Label>
                <Input type="time" v-model="form.event_end_time" />
                <InputError :message="form.errors.event_end_time" />
            </div>
        </div>

        <div>
            <Label>Localización*</Label>
            <Input v-model="form.event_location" placeholder="Dirección o lugar del evento" required />
            <InputError :message="form.errors.event_location" />
        </div>

        <div>
            <Label>Modalidad*</Label>
            <Select v-model="form.modality" :options="[
                { value: 'Presencial', label: 'Presencial' },
                { value: 'Online', label: 'Online' }
            ]" required placeholder="Selecciona una modalidad" />
            <InputError :message="form.errors.modality" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Precio*</Label>
                <Input type="number" v-model="form.price" min="0" step="0.01" placeholder="Ej: 20.00" required />
                <InputError :message="form.errors.price" />
            </div>
            <div>
                <Label>Moneda</Label>
                <Input v-model="form.currency" placeholder="EUR, USD..." maxlength="3" />
                <InputError :message="form.errors.currency" />
            </div>
        </div>

        <div>
            <Label>Imagen destacada</Label>
            <Input type="file" @change="handleFileUpload" accept="image/*" />
            <InputError :message="form.errors.featured_image" />
        </div>

        <div>
            <Label>Idioma*</Label>
            <Input v-model="form.language" placeholder="es, en..." maxlength="2" required />
            <InputError :message="form.errors.language" />
        </div>

        <div>
            <Label>Título SEO</Label>
            <Input v-model="form.seo_title" placeholder="Título para motores de búsqueda (opcional)" />
            <InputError :message="form.errors.seo_title" />
        </div>

        <div>
            <Label>Descripción SEO</Label>
            <Textarea v-model="form.seo_description" placeholder="Descripción corta para SEO (opcional)" :rows="2" />
            <InputError :message="form.errors.seo_description" />
        </div>

        <div>
            <Label class="flex items-center">
                <Checkbox v-model="form.is_active" />
                <span class="ml-2">¿Evento activo?</span>
            </Label>
            <InputError :message="form.errors.is_active" />
        </div>

        <div class="flex justify-center mt-6">
            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
            <Button type="submit" variant="transparent">Guardar evento</Button>
        </div>
    </form>
</template>
