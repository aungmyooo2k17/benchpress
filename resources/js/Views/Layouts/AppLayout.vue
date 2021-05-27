<template>
    <div class="min-h-screen min-w-full overflow-x-hidden">
        <!-- Main Header Area -->
        <header>
            <navbar class="bg-blueGray-800">
                <template #logo>
                    <logo classes="h-5 w-auto text-white" :title="config('app.name')"></logo>
                </template>

                <template #linksleft>
                    <navbar-link :href="route('home')" :active="route().current('home')" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Home
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Members
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Products
                    </navbar-link>

                    <navbar-link href="#" :active="false" class="text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900">
                        Support
                    </navbar-link>
                </template>

                <template #linksright>
                    <dropdown v-if="$page.props.isAdmin" align="right">
                        <template #trigger>
                            <button class="flex items-center px-3 py-1.5 rounded-xl opacity-75 bg-opacity-0 text-white bg-blueGray-900 hover:bg-blueGray-900 focus:bg-blueGray-900 hover:bg-opacity-75 focus:bg-opacity-100 hover:opacity-100 focus:outline-none transition ease-in-out duration-150 ml-2">
                                <span class="font-semibold text-sm">
                                    {{ $page.props.user.team.name }}
                                </span>

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </template>

                        <template #items>
                            <div class="block px-4 py-2 text-xs text-gray-500">Manage Team</div>
                            <dropdown-link :href="route('staff.index', { 'team': $page.props.user.team.slug })">Staff</dropdown-link>
                            <dropdown-link :href="route('teams.show', { 'team': $page.props.user.team.slug })">Settings</dropdown-link>
                        </template>
                    </dropdown>

                    <dropdown align="right">
                        <template #trigger>
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-blueGray-600 transition duration-150 ease-in-out">
                                <img :src="$page.props.user.profile_photo_url" class="rounded-full object-cover w-8 h-8" :alt="$page.props.user.name"/>
                            </button>
                        </template>

                        <template #items>
                            <div class="block px-4 py-2 text-xs text-gray-500">Manage Account</div>
                            <dropdown-link :href="route('user.show')">Profile</dropdown-link>
                            <dropdown-link v-if="$page.props.isAdmin" :href="route('api-tokens.index')">API token</dropdown-link>
                            <dropdown-link href="#" @clicked="logout">Sign out</dropdown-link>
                        </template>
                    </dropdown>
                </template>
            </navbar>
        </header>

        <!-- Main Content Area -->
        <main class="py-8" role="main">
            <div class="container mx-auto px-4 sm:px-6">
                <slot></slot>
            </div>
        </main>

        <!-- Main Footer Area -->
        <footer>
            <div class="container mx-auto px-4 sm:px-6">
                <div class="py-16 flex items-center justify-center">
                    <p class="text-center">
                        <span class="text-gray-500 text-xs">{{ copyright }}</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import axios from 'axios';
import Logo from '@/Views/Components/Logos/Logo';
import Navbar from '@/Views/Components/Navbars/Navbar';
import NavbarLink from '@/Views/Components/Navbars/NavbarLink';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';

export default {
    components: {
        Logo,
        Navbar,
        NavbarLink,
        Dropdown,
        DropdownLink,
    },

    data() {
        return {
            copyright: `© ${new Date().getFullYear()} ${this.config('app.name')}. All rights reserved.`,
        };
    },

    methods: {
        logout() {
            this.$inertia.post(this.route('logout'));
        }
    }
}
</script>
