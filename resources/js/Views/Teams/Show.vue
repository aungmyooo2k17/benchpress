<template>
    <app-layout>
        <div>
            <update-team-information-form :team="$page.props.user.team"></update-team-information-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import UpdateTeamInformationForm from './UpdateTeamInformationForm';

export default {
    components: {
        AppLayout,
        UpdateTeamInformationForm,
    },
}
</script>
