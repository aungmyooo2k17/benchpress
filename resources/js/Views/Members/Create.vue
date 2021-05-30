<template>
    <app-layout>
        <manage-members-form :subscriptions="subscriptions"></manage-members-form>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import ManageMembersForm from './ManageMembersForm';

export default {
    components: {
        AppLayout,
        ManageMembersForm
    },

    props: {
        subscriptions: {
            type: Object,
            required: true,
            default: {}
        },
    }
}
</script>
