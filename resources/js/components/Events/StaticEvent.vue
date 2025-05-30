<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <section class="w-full px-4 max-w-[1200px] mx-auto">
        <div v-if="user && (user.role === 'admin' || user.role === 'operator')" class="mt-12 flex justify-end gap-6">
            <Button @click="$inertia.visit('/events/create')">
                {{ $t('events.staticEvent.create_button') }}
            </Button>
            <Button @click="$inertia.visit('/events/admin')">
                {{ $t('events.staticEvent.manage_button') }}
            </Button>
        </div>

        <h2 class="text-4xl font-bold text-center text-primary-color my-20">
            {{ $t('events.staticEvent.title') }}
        </h2>

        <div class="w-full mx-auto grid md:grid-cols-2 gap-6 items-center">
            <img src="@assets/meditacion-online.jpg" :alt="$t('events.staticEvent.image_alt')"
                class="w-full h-90 object-cover rounded-xl shadow-lg" />

            <div>
                <p class="text-sm text-secondary-color mb-2">
                    {{ $t('events.staticEvent.schedule') }}
                </p>

                <h2 class="text-3xl font-bold text-primary-color mb-4">
                    {{ $t('events.staticEvent.event_title') }}
                </h2>

                <p class="text-primary-color mb-4">
                    {{ $t('events.staticEvent.description') }}
                </p>

                <div class="mt-4 grid gap-4 sm:grid-cols-3 text-center text-lg">
                    <div>
                        <span class="block font-semibold text-primary-color">
                            {{ $t('events.staticEvent.when_label') }}
                        </span>
                        <span class="text-primary-color">
                            {{ $t('events.staticEvent.when_value') }}
                        </span>
                    </div>

                    <div>
                        <span class="block font-semibold text-primary-color">
                            {{ $t('events.staticEvent.time_label') }}
                        </span>
                        <span class="text-primary-color">
                            {{ $t('events.staticEvent.time_value') }}
                        </span>
                    </div>

                    <div>
                        <span class="block font-semibold text-primary-color">
                            {{ $t('events.staticEvent.mode_label') }}
                        </span>
                        <span class="text-primary-color">
                            {{ $t('events.staticEvent.mode_value') }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 flex align-center justify-center">
                    <Button @click="$inertia.visit('#')" target="_blank">
                        {{ $t('events.staticEvent.join_button') }}
                    </Button>
                </div>
            </div>
        </div>
    </section>
</template>
