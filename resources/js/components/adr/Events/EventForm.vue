<script setup lang="ts">
import { defineEmits, defineProps, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Checkbox } from '@/components/ui/checkbox'
import { Button } from '@/components/ui/button'
import { LoaderCircle } from 'lucide-vue-next'

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
    price: props.event?.price ?? '',
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
        form.slug = generateSlug(newTitle)
    }
})

function submit() {
    form.post(route('events.store'), {
        forceFormData: true,
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
        </div>

        <div>
            <Label>Contenido*</Label>
            <Textarea v-model="form.content" placeholder="Descripción detallada del evento" rows="8" required />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Fecha inicio*</Label>
                <Input type="date" v-model="form.event_date" required />
            </div>
            <div>
                <Label>Hora inicio*</Label>
                <Input type="time" v-model="form.event_time" required />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Fecha fin</Label>
                <Input type="date" v-model="form.event_end_date" />
            </div>
            <div>
                <Label>Hora fin</Label>
                <Input type="time" v-model="form.event_end_time" />
            </div>
        </div>

        <div>
            <Label>Localización*</Label>
            <Input v-model="form.event_location" placeholder="Dirección o lugar del evento" required />
        </div>

        <div>
            <Label>Modalidad*</Label>
            <select v-model="form.modality" class="border p-2 rounded w-full" required>
                <option value="">Selecciona una modalidad</option>
                <option value="Presencial">Presencial</option>
                <option value="Online">Online</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <Label>Precio</Label>
                <Input type="number" v-model="form.price" min="0" step="0.01" placeholder="Ej: 20.00" />
            </div>
            <div>
                <Label>Moneda</Label>
                <Input v-model="form.currency" placeholder="EUR, USD..." maxlength="3" />
            </div>
        </div>

        <div>
            <Label>Imagen destacada</Label>
            <Input type="file" @change="handleFileUpload" accept="image/*" />
        </div>

        <div>
            <Label>Idioma*</Label>
            <Input v-model="form.language" placeholder="es, en..." maxlength="2" required />
        </div>

        <div>
            <Label>Título SEO</Label>
            <Input v-model="form.seo_title" placeholder="Título para motores de búsqueda (opcional)" />
        </div>

        <div>
            <Label>Descripción SEO</Label>
            <Textarea v-model="form.seo_description" placeholder="Descripción corta para SEO (opcional)" rows="2" />
        </div>

        <div>
            <Label class="flex items-center">
                <Checkbox v-model="form.is_active" />
                <span class="ml-2">¿Evento activo?</span>
            </Label>
        </div>

        <div class="flex justify-center mt-6">
            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
            <Button type="submit" variant="transparent">Guardar evento</Button>
        </div>
    </form>
</template>
