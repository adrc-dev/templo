<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import EventForm from '@/components/Events/EventForm.vue';
import GoLink from '@/components/GoLink.vue';

const props = defineProps<{ event: any }>()

function onSubmit(form: any) {
    form.put(`/events/${props.event.id}`);
}
</script>

<template>

    <Head :title="$t('events.editEvents.page_title')" />
    <AppLayout>
        <div class="bg-tertiary-color/80">
            <section class="w-full px-4 max-w-3xl mx-auto py-20">
                <Heading :title="$t('events.editEvents.heading_title')"
                    :description="$t('events.editEvents.heading_description')" />
                <EventForm :event="props.event" @submit="onSubmit" />
                <GoLink class="mt-12 text-white hover:text-white" :href="route('events.index')"
                    :text="$t('events.editEvents.back_link')" />
            </section>
        </div>
    </AppLayout>
</template>
