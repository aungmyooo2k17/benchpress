<template>
    <app-layout>
        <div>
            <div class="lg:grid lg:grid-cols-12 gap-6">
                <div class="md:col-span-6 lg:col-span-7">
                    <h5 class="font-semibold text-lg text-blueGray-800">Details</h5>

                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0 h-28 w-28">
                            <img class="h-28 w-28 rounded-xl" :src="product.profile_photo_url || '/img/product.svg'" :alt="product.name">
                        </div>

                        <div class="ml-4">
                            <div>
                                <div class="text-sm font-medium text-blueGray-900">
                                    <app-link class="text-blueGray-800" :href="product.path">{{ product.name }}</app-link>
                                </div>

                                <div class="mt-1 text-sm text-blueGray-500">
                                    {{ pricingPlan(product) }}
                                </div>

                                <div class="mt-4">
                                    <div>
                                        <span class="text-xs text-blueGray-400">Updated</span>
                                    </div>

                                    <div class="text-sm text-blueGray-500">
                                        {{ expanded(product.updated_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 rounded-xl overflow-hidden border border-blueGray-100">
                        <dl>
                            <div class="bg-blueGray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Product name
                                </dt>

                                <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
                                    {{ product.name }}
                                </dd>
                            </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Product Code
                                </dt>

                                <dd class="mt-1 text-xs sm:mt-0 sm:col-span-2">
                                    <span class="px-3 py-1 font-mono rounded-lg text-emerald-300 bg-blueGray-700">
                                        {{ product.code }}
                                    </span>
                                </dd>
                            </div>

                            <div class="bg-blueGray-100 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Created
                                </dt>

                                <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
                                    {{ expanded(product.created_at) }}
                                </dd>
                            </div>

                            <div v-if="product.dimensions.length > 0" class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Dimensions
                                </dt>

                                <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
                                   {{ product.dimensions.height }} x {{ product.dimensions.width }} x {{ product.dimensions.length }}
                                </dd>
                            </div>

                            <div :class="{ 'bg-blueGray-100' : product.dimensions.length > 0 }" class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Description
                                </dt>

                                <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
                                    {{ product.description }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-6">
                        <dropdown v-if="$page.props.isAdmin" align="left">
                            <template #trigger>
                                <app-button class="shadow-none" mode="secondary">
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
                    </div>
                </div>

                <div class="md:col-span-6 lg:col-span-5">
                    <div>
                        <div>
                            <h5 class="font-semibold text-lg text-blueGray-800">Pricing</h5>
                        </div>

                        <div class="mt-6">
                            <card class="shadow-none" bg-color="bg-blueGray-100" :has-action="false">
                                <template #content>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div>
                                                <span class="text-sm font-medium text-blueGray-800">
                                                    {{ 'US' + product.amount }}
                                                </span>
                                            </div>

                                            <div>
                                                <span class="text-xs text-blueGray-400">
                                                    {{ product.payment_type }}
                                                </span>
                                            </div>
                                        </div>

                                        <div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                                {{ product.payment_type === 'recurring' ? product.billing_period : 'One time payment' }}
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </card>
                        </div>
                    </div>

                    <div v-if="product.payment_type === 'recurring'" class="mt-10">
                        <div>
                            <h5 class="font-semibold text-lg text-blueGray-800">Subscriptions</h5>
                        </div>

                        <div class="mt-6">
                            <div v-if="product.subscriptions.length > 0">
                                <card v-for="(subscription, id) in product.Subscriptions" :key="id" class="shadow-none" bg-color="bg-blueGray-100" :has-action="false">
                                    <template #content>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div>
                                                    <span class="text-sm font-medium text-blueGray-800">
                                                        {{ subscription.code }}
                                                    </span>
                                                </div>

                                                <div>
                                                    <span class="text-xs text-blueGray-400">
                                                        Subscription code
                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <span class="text-blueGray-500 text-sm">
                                                    {{ expanded(subscription.started_at) }}
                                                </span>
                                            </div>
                                        </div>
                                    </template>
                                </card>
                            </div>

                            <div>
                                <span class="text-sm text-blueGray-500">No active subscriptions</span>
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
import ActionSection from '@/Views/Components/Sections/ActionSection';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import Card from '@/Views/Components/Cards/Card';
import AppLink from '@/Views/Components/Base/Link';
import AppButton from '@/Views/Components/Buttons/Button';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';

export default {
    props: ['product'],

    components: {
        AppLayout,
        SectionBorder,
        ActionSection,
        AppLink,
        Card,
        AppButton,
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
