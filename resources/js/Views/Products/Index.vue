<template>
    <app-layout>
        <div>
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-gray-800 font-semibold text-2xl">Products</h4>
                </div>

                <div class="flex space-x-4 items-center">
                    <dropdown align="right">
                        <template #trigger>
                            <app-button class="inline-flex items-center" mode="secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fillRule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clipRule="evenodd" />
                                </svg>

                                <span class="ml-1">Filter</span>
                            </app-button>
                        </template>

                        <template #items>
                            <div class="block px-4 py-2 text-xs text-gray-500">Filter by</div>
                            <dropdown-link :href="route('products.index', { 'team': $page.props.user.team.slug })" :active="route().current('products.index')">Created</dropdown-link>
                            <dropdown-link href="#">Available</dropdown-link>
                            <dropdown-link href="#">Reserved</dropdown-link>
                        </template>
                    </dropdown>

                    <app-button :href="route('products.create', { 'team': $page.props.user.team.slug })" :link="true" mode="primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>

                        <span class="ml-1">Add product</span>
                    </app-button>
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <table v-if="products.data.length > 0" class="mt-6 table-fixed min-w-full divide-y divide-blueGray-200">
                <thead class="bg-white">
                    <tr>
                        <th scope="col" class="w-4/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Updated
                        </th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-blueGray-50" v-for="(product, id) in products.data" :key="id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <img class="h-12 w-12 rounded-xl" :src="product.profile_photo_url || '/img/product.svg'" :alt="product.name">
                                </div>

                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <app-link class="text-blueGray-800" :href="product.path">{{ product.name }}</app-link>
                                    </div>

                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ pricingPlan(product) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ simple(product.updated_at) }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <dropdown v-if="$page.props.isAdmin" align="right">
                                <template #trigger>
                                    <app-button class="shadow-none border-none" mode="secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </app-button>
                                </template>

                                <template #items>
                                    <dropdown-link :href="route('products.edit', { 'team': $page.props.user.team.slug, product })">Edit product</dropdown-link>
                                    <dropdown-link class="text-red-500 hover:text-red-500" href="#">Delete product</dropdown-link>
                                </template>
                            </dropdown>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-else class="mt-6">
                <span class="text-sm text-blueGray-500">No products found.</span>
            </div>

            <pagination :links="products.links"></pagination>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import AppButton from '@/Views/Components/Buttons/Button';
import AppLink from '@/Views/Components/Base/Link';
import Pagination from '@/Views/Components/Pagination/Pagination';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';

export default {
    props: ['products'],

    components: {
        AppLayout,
        AppButton,
        AppLink,
        Pagination,
        Dropdown,
        DropdownLink,
    },

    methods: {
        pricingPlan(product) {
            if (product.payment_type === 'onetime') {
                return 'US' + product.amount;
            }

            return 'US' + product.amount + ' | ' + product.billing_period;
        }
    }
}
</script>
