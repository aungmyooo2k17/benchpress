<template>
    <app-layout>
        <manage-product></manage-product>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ManageProductForm from './ManageProductForm';

export default {
    components: {
        AppLayout,
        SectionBorder,
        ManageProductForm
    },
}
</script>
