<script setup lang="ts">
import { defineEmits, defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-vue-next';
import InputError from '@/components/InputError.vue';

const props = defineProps<{ video?: any }>();
const emit = defineEmits(['submit']);

const form = useForm({
    title: props.video?.title ?? '',
    youtube_id: props.video?.youtube_id ?? '',
    description: props.video?.description ?? '',
    is_premium: Boolean(props.video?.is_premium),
});

function submit() {
    emit('submit', form);
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid gap-2">
            <Label class="block mb-1">{{ $t('videos.form.title') }}</Label>
            <Input v-model="form.title" class="w-full border rounded p-2" :placeholder="$t('videos.form.title')"
                required />
            <InputError :message="form.errors.title" />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="block mb-1">{{ $t('videos.form.youtubeUrl') }}</Label>
            <Input v-model="form.youtube_id" class="w-full border rounded p-2"
                :placeholder="$t('videos.form.youtubePlaceholder')" required />
            <InputError :message="form.errors.youtube_id" />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="block mb-1">{{ $t('videos.form.description') }}</Label>
            <Textarea v-model="form.description" class="w-full border rounded p-2"
                :placeholder="$t('videos.form.descriptionPlaceholder')" />
            <InputError :message="form.errors.description" />
        </div>

        <div class="grid gap-2 mt-4">
            <Label class="flex items-center">
                <Checkbox id="premium" v-model="form.is_premium" />
                <span class="ml-2">{{ $t('videos.form.premiumCheckbox') }}</span>
            </Label>
            <InputError :message="form.errors.is_premium" />
        </div>

        <div class="flex justify-center items-center mt-6">
            <Button type="submit" variant="transparent">
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                {{ $t('videos.form.saveButton') }}
            </Button>
        </div>
    </form>
</template>
