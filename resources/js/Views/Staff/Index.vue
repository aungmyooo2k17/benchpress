<template>
    <app-layout>
        <div>
            <invite-form :team="team" :roles="roles"></invite-form>

            <section-border></section-border>

            <pending-invitations-list :team="team"></pending-invitations-list>

            <section-border></section-border>

            <members-list :team="team" :roles="roles"></members-list>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import InviteForm from './InviteForm';
import MembersList from './MembersList.vue';
import PendingInvitationsList from './PendingInvitationsList.vue';

export default {
    props: ['team', 'roles'],

    components: {
        AppLayout,
        InviteForm,
        SectionBorder,
        MembersList,
        PendingInvitationsList,
    },
}
</script>
