<script setup lang="ts">
import { defineEmits, defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';

const props = defineProps<{ video?: any }>();
const emit = defineEmits(['submit']);

const form = useForm({
    title: props.video?.title ?? '',
    youtube_id: props.video?.youtube_id ?? '',
    description: props.video?.description ?? '',
    is_premium: props.video?.is_premium ?? false,
});

function submit() {
    emit('submit', form);
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid gap-2">
            <Label class="block mb-1">Título</Label>
            <Input v-model="form.title" class="w-full border rounded p-2" placeholder="Título" required />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="block mb-1">URL de YouTube</Label>
            <Input v-model="form.youtube_id" class="w-full border rounded p-2"
                placeholder="Ej: https://www.youtube.com/watch?v=qfMIgYvebho&list=PL3tGU3_EgiHZiICIIwoOaOF50GmLQ7iQW"
                required />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="block mb-1">Descripción</Label>
            <Textarea v-model="form.description" class="w-full border rounded p-2"
                placeholder="Escribe la descripción" />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="flex items-center">
                <Checkbox id="premium" v-model="form.is_premium" />
                <span class="ml-2">¿Es un vídeo premium?</span>
            </Label>
        </div>

        <div class="flex justify-center items-center mt-6">
            <Button type="submit" variant="transparent">Guardar</Button>
        </div>
    </form>
</template>
