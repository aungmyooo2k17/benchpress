<template>
    <app-layout>
        <manage-product-form :product="product"></manage-product-form>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ManageProductForm from './ManageProductForm';

export default {
    props: ['product'],

    components: {
        AppLayout,
        SectionBorder,
        ManageProductForm
    },
}
</script>
