<script setup lang="ts">
import { reactive } from 'vue'
import { useForm, Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
    title: { es: '', en: '' },
    content: { es: '', en: '' },
    event_date: '',
    event_time: '',
    modality: '',
    price: '',
    featured_image: '',
    is_active: true,
    meta_title: '',
    meta_description: '',
    og_image: ''
})

const submit = () => {
    form.post(route('posts.store'))
}
</script>

<template>
    <AppLayout>

        <Head title="Crear Evento" />

        <div class="max-w-[1200px] text-primary-color mx-auto px-4 py-12">
            <h1 class="text-7xl font-bold text-primary-color mb-8">Crear Evento</h1>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Título (multilingüe) -->
                <div>
                    <label class="block font-semibold">Título (ES)</label>
                    <input v-model="form.title.es" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                    <div v-if="form.errors['title.es']" class="text-red-500 text-sm">{{ form.errors['title.es'] }}</div>
                </div>
                <div>
                    <label class="block font-semibold">Título (EN)</label>
                    <input v-model="form.title.en" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                    <div v-if="form.errors['title.en']" class="text-red-500 text-sm">{{ form.errors['title.en'] }}</div>
                </div>

                <!-- Contenido (multilingüe) -->
                <div>
                    <label class="block font-semibold">Contenido (ES)</label>
                    <textarea v-model="form.content.es"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50 h-28"></textarea>
                    <div v-if="form.errors['content.es']" class="text-red-500 text-sm">{{ form.errors['content.es'] }}
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Contenido (EN)</label>
                    <textarea v-model="form.content.en"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50 h-28"></textarea>
                    <div v-if="form.errors['content.en']" class="text-red-500 text-sm">{{ form.errors['content.en'] }}
                    </div>
                </div>

                <!-- Fecha y hora del evento -->
                <div class="flex gap-4 text-primary-color">
                    <div class="flex-1">
                        <label class="block font-semibold">Fecha del Evento</label>
                        <input v-model="form.event_date" type="date"
                            class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                        <div v-if="form.errors.event_date" class="text-red-500 text-sm">{{ form.errors.event_date }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold">Hora del Evento</label>
                        <input v-model="form.event_time" type="time"
                            class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                        <div v-if="form.errors.event_time" class="text-red-500 text-sm">{{ form.errors.event_time }}
                        </div>
                    </div>
                </div>

                <!-- Modalidad -->
                <div>
                    <label class="block font-semibold">Modalidad</label>
                    <input v-model="form.modality" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                    <div v-if="form.errors.modality" class="text-red-500 text-sm">{{ form.errors.modality }}</div>
                </div>

                <!-- Precio -->
                <div>
                    <label class="block font-semibold">Precio (€)</label>
                    <input v-model="form.price" type="number"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                    <div v-if="form.errors.price" class="text-red-500 text-sm">{{ form.errors.price }}</div>
                </div>

                <!-- Imagen destacada -->
                <div>
                    <label class="block font-semibold">Imagen Destacada (URL)</label>
                    <input v-model="form.featured_image" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                    <div v-if="form.errors.featured_image" class="text-red-500 text-sm">{{ form.errors.featured_image }}
                    </div>
                </div>

                <!-- Activo -->
                <div class="flex items-center">
                    <input v-model="form.is_active" type="checkbox" id="is_active" class="mr-2" />
                    <label for="is_active" class="font-semibold">Está activo</label>
                </div>

                <!-- SEO opcional -->
                <div>
                    <label class="block font-semibold">Meta Título</label>
                    <input v-model="form.meta_title" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                </div>
                <div>
                    <label class="block font-semibold">Meta Descripción</label>
                    <textarea v-model="form.meta_description"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50 h-20"></textarea>
                </div>
                <div>
                    <label class="block font-semibold">Imagen OG (URL)</label>
                    <input v-model="form.og_image" type="text"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color/50" />
                </div>

                <button type="submit"
                    class="bg-primary-color text-white font-semibold px-6 py-2 rounded-lg hover:bg-tertiary-color transition">
                    Crear Evento
                </button>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
