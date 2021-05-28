<template>
    <app-layout>
        <div>
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-gray-800 font-semibold text-2xl">Products</h4>
                </div>

                <div>
                    <app-button :href="route('products.create', { 'team': $page.props.user.team.slug })" :link="true" :mode="primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>

                        <span class="ml-1">Add product</span>
                    </app-button>
                </div>
            </div>

            <section-border></section-border>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import AppButton from '@/Views/Components/Buttons/Button';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';

export default {
    components: {
        AppLayout,
        AppButton,
        SectionBorder,
    },
}
</script>
