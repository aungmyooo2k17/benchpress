<template>
    <div class="min-h-screen min-w-full overflow-x-hidden">
        <banner></banner>

        <!-- Main Header Area -->
        <header>
            <navbar class="bg-blueGray-800">
                <template #logo>
                    <logo classes="h-7 w-auto text-white" :title="config('app.name')"></logo>
                </template>

                <template #linksleft>
                    <navbar-link :href="route('home')" :active="route().current('home')" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Home
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        About
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Features
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Pricing
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Support
                    </navbar-link>
                </template>

                <template #linksright>
                    <navbar-link v-if="$page.props.user" :href="route('home')" :active="route().current('home')" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Dashboard <span class="ml-1">&rarr;</span>
                    </navbar-link>

                    <navbar-link v-else :href="route('login')" :active="route().current('login')" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Sign in <span class="ml-1">&rarr;</span>
                    </navbar-link>
                </template>
            </navbar>
        </header>

        <!-- Optional Hero Content Area -->
        <div v-if="hasHero">
            <slot name="hero"></slot>
        </div>

        <!-- Main Content Area -->
        <main class="py-8" role="main">
            <div class="container mx-auto px-4 sm:px-6">
                <slot></slot>
            </div>
        </main>

        <!-- Main Footer Area -->
        <footer class="bg-blueGray-50 py-16">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="lg:grid lg:grid-cols-12 gap-6">
                    <div class="sm:col-span-6 lg:col-span-4">
                        <div>
                            <logo classes="h-7 w-auto text-blueGray-400" :title="config('app.name')"></logo>

                            <p class="mt-6 text-sm text-blueGray-400 sm:max-w-lg md:max-w-full">
                                You achieve success and change lives when your members keep coming back. Glofox helps you understand the data so you can see who you need to contact and when you need to make that call.
                            </p>
                        </div>
                    </div>

                    <div class="mt-10 lg:mt-0 sm:col-span-6 lg:col-start-7">
                        <div class="grid grid-cols-12 gap-6">
                            <div class="mt-6 md:mt-0 col-span-6 md:col-span-4">
                                <div>
                                    <span class="uppercase font-semibold tracking-wide text-sm text-blueGray-400">
                                        Solutions
                                    </span>
                                </div>

                                <div class="mt-4 space-y-3">
                                    <app-link class="block text-blueGray-600" href="#">Marketing</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Analytics</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Commerce</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Insights</app-link>
                                </div>
                            </div>

                            <div class="mt-6 md:mt-0 col-span-6 md:col-span-4">
                                <div>
                                    <span class="uppercase font-semibold tracking-wide text-sm text-blueGray-400">
                                        Support
                                    </span>
                                </div>

                                <div class="mt-4 space-y-3">
                                    <app-link class="block text-blueGray-600" href="#">Pricing</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Documentation</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Guides</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Contact</app-link>
                                </div>
                            </div>

                            <div class="mt-6 md:mt-0 col-span-6 md:col-span-4">
                                <div>
                                    <span class="uppercase font-semibold tracking-wide text-sm text-blueGray-400">
                                        Company
                                    </span>
                                </div>

                                <div class="mt-4 space-y-3">
                                    <app-link class="block text-blueGray-600" href="#">About</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Blog</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Privacy</app-link>
                                    <app-link class="block text-blueGray-600" href="#">Terms</app-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section-border class="my-6"></section-border>

                <div class="flex items-center justify-center">
                    <p class="text-center">
                        <span class="text-gray-500 text-sm">{{ copyright }}</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import Logo from '@/Views/Components/Logos/Logo';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import Navbar from '@/Views/Components/Navbars/Navbar';
import AppLink from '@/Views/Components/Base/Link';
import NavbarLink from '@/Views/Components/Navbars/NavbarLink';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import Banner from '@/Views/Components/Banners/Banner';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';

export default {
    props: {
        hasHero: {
            type: Boolean,
            default: false,
            required: false
        }
    },

    components: {
        Logo,
        Navbar,
        NavbarLink,
        Dropdown,
        DropdownLink,
        Banner,
        SectionBorder,
        AppLink,
    },

    data() {
        return {
            copyright: `© ${new Date().getFullYear()} ${this.config('app.name')}. All rights reserved.`,
        };
    },
}
</script>
