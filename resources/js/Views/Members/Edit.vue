<template>
    <app-layout>
        <manage-members-form :member="member" :subscriptions="subscriptions"></manage-members-form>
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

        member: {
            type: Object,
            required: false,
            default: {}
        },
    }
}
</script>
