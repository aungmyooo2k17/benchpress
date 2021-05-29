<template>
    <app-layout>
        <div>
            <div class="lg:grid lg:grid-cols-12 gap-6">
                <div class="col-span-4">
                    <h4>
                        <span class="block text-gray-600 text-base">
                            {{ greet() }}
                        </span>

                        <span class="block font-semibold text-xl text-blueGray-800">
                            {{ $page.props.user.name }}
                        </span>
                    </h4>

                    <h6 class="mt-1 text-gray-600 text-base">
                        Hope you're well. Let's get started.
                    </h6>

                    <div class="mt-6">
                        <app-button :link="true" href="#" mode="primary">
                            Next <span class="ml-1">&rarr;</span>
                        </app-button>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="h-12 bg-emerald-100 rounded-lg">
                        Hello
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <div>
                    <h5 class="text-blueGray-800 font-semibold text-lg">
                        Get started with {{ config('app.name') }}
                    </h5>
                </div>

                <div class="mt-4">
                    <div class="lg:grid lg:grid-cols-12 gap-6">
                        <div class="col-span-4">
                            <card class="shadow-none" :has-action="false" bg-color="bg-blueGray-50">
                                <template #content>
                                    <div>
                                        <h6 class="text-blueGray-800 font-semibold text-base">
                                            Add new member
                                        </h6>

                                        <p class="mt-4 text-blueGray-500 text-sm">
                                            Grow your business by adding a new member to your customer list
                                        </p>

                                        <div class="mt-6">
                                            <app-link href="#" class="text-sm">
                                                Add member <span class="ml-1">&rarr;</span>
                                            </app-link>
                                        </div>
                                    </div>
                                </template>
                            </card>
                        </div>

                        <div class="col-span-4">
                            <card class="shadow-none" :has-action="false" bg-color="bg-blueGray-50">
                                <template #content>
                                    <div>
                                        <h6 class="text-blueGray-800 font-semibold text-base">
                                            Manage inventory
                                        </h6>

                                        <p class="mt-4 text-blueGray-500 text-sm">
                                            Keep on top of your sales items and subscriptions by keeping them fresh and exciting.
                                        </p>

                                        <div class="mt-6">
                                            <app-link :href="route('products.index', { 'team': $page.props.user.team.slug })" class="text-sm">
                                                Start <span class="ml-1">&rarr;</span>
                                            </app-link>
                                        </div>
                                    </div>
                                </template>
                            </card>
                        </div>

                        <div class="col-span-4">
                            <div>
                                <h6 class="text-blueGray-800 font-semibold text-base">
                                    Build a custom integration
                                </h6>

                                <div class="mt-4 space-y-2">
                                    <app-link class="text-sm flex items-center" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>

                                        <span class="ml-1">Browse developer docs</span>
                                    </app-link>

                                    <app-link class="text-sm flex items-center" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>

                                        <span class="ml-1">Try out a sample app</span>
                                    </app-link>
                                </div>

                                <hr class="my-6">

                                <div>
                                    <h6 class="text-blueGray-800 font-semibold text-base">
                                        Your API token
                                    </h6>

                                    <p class="mt-4 text-blueGray-500 text-sm">
                                        You may create a unique token for your account so an external app can access your account information.
                                    </p>

                                    <div class="mt-6">
                                        <app-link class="text-sm" :href="route('api-tokens.index')">
                                            Create API token <span class="ml-1">&rarr;</span>
                                        </app-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import AppButton from '@/Views/Components/Buttons/Button';
import AppLink from '@/Views/Components/Base/Link';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import Card from '@/Views/Components/Cards/Card';

export default {
    components: {
        AppLayout,
        AppButton,
        Card,
        AppLink,
        SectionBorder,
    },

    methods: {
        greet() {
            let time = (new Date()).getHours();
            let dayTime;

            if (time < 12) {
                dayTime = 'Morning';
            } else if (time == 12) {
                dayTime = 'Afternoon';
            } else {
                dayTime = 'Evening';
            }

            return `Good ${dayTime}`;
        }
    }
};
</script>
