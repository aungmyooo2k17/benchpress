<template>
    <app-layout>
        <div>
            <invite-form :team="$page.props.user.team" :roles="roles"></invite-form>

            <section-border></section-border>

            <members-list :members="members" :roles="roles"></members-list>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import InviteForm from './InviteForm';
import MembersList from './MembersList.vue';

export default {
    props: ['members', 'roles'],

    components: {
        AppLayout,
        InviteForm,
        SectionBorder,
        MembersList,
    },
}
</script>
