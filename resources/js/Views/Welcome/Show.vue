<template>
    <guest-layout :has-hero="true">
        <template #hero>
            <div class="bg-blueGray-800 pt-16 pb-24">
                <div class="container mx-auto px-4 sm:px-6">
                    <div class="lg:grid lg:grid-cols-12 gap-6">
                        <div class="md:col-span-4 lg:col-span-5 h-full flex flex-col justify-center">
                            <div class="text-center lg:text-left">
                                <h3 class="max-w-lg mx-auto lg:max-w-full font-bold text-2xl lg:text-2xl xl:text-4xl bg-clip-text text-transparent bg-gradient-to-br from-emerald-400 to-blue-300">
                                    Relaunch Your Fitness Business. Stronger and Safer than Ever.
                                </h3>

                                <p class="mt-6 max-w-lg mx-auto lg:max-w-full text-normal xl:text-xl leading-relaxed text-blueGray-100">
                                    Start growing again with a contactless gym, quality live streaming, and our industry leading gym management software.
                                </p>

                                <div class="mt-10 space-x-4">
                                    <app-button :href="route('login')" :link="true" mode="primary">
                                        Get started <span class="ml-1">&rarr;</span>
                                    </app-button>

                                    <app-button href="/about" :link="true" mode="secondary">
                                        Learn more
                                    </app-button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 hidden md:block lg:mt-0 md:col-span-6 lg:col-span-7">
                            <div class="overflow-hidden">
                                <img class="w-full" src="/img/screenshot-hero.png" :alt="config('app.name')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div>
            <div class="py-20 flex flex-col items-center">
                <div class="text-center">
                    <div>
                        <span class="uppercase text-emerald-500 font-semibold tracking-wide">
                            Robust Software
                        </span>
                    </div>

                    <div class="mt-4 max-w-3xl mx-auto">
                        <h3 class="text-3xl font-bold text-blueGray-800">
                            Is your software getting more expensive when you need certainty and support?
                        </h3>

                        <p class="mt-6 text-lg text-blueGray-600 leading-relaxed">
                            Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit.
                        </p>
                    </div>

                    <div class="mt-10 overflow-hidden w-full mx-auto rounded-xl shadow-xl">
                        <img class="w-full h-auto" src="/img/screenshot.png" :alt="config('app.name')">
                    </div>
                </div>
            </div>
        </div>
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Views/Layouts/GuestLayout';
import AppLink from '@/Views/Components/Base/Link';
import AppButton from '@/Views/Components/Buttons/Button';

export default {
    components: {
        GuestLayout,
        AppLink,
        AppButton
    }
};
</script>
