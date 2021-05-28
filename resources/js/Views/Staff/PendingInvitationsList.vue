<template>
    <action-section>
        <template #title>
            Pending Staff Invitations
        </template>

        <template #description>
            These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.
        </template>

        <template #content>
            <div v-if="invitations.length > 0" class="space-y-3">
                <card class="shadow-none" bg-color="bg-gray-100" :has-action="false" v-for="invitation in invitations" :key="invitation.id">
                    <template #content>
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600 font-medium">{{ invitation.email }}</div>

                            <div class="flex items-center">
                                <!-- Cancel Team Invitation -->
                                <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                    @click="cancelStaffInvitation(invitation)">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </template>
                </card>
            </div>

            <div v-else>
                <p class="text-sm text-gray-600">
                    No pending invites found.
                </p>
            </div>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppLink from '@/Views/Components/Base/Link';
import Card from '@/Views/Components/Cards/Card.vue';

export default {
    props: ['invitations'],

    components: {
        ActionSection,
        Card,
        AppLink,
    },

    data() {
        return {}
    },

    methods: {
        cancelStaffInvitation(invitation) {
            this.$inertia.delete(this.route('invitations.destroy', [this.team, invitation]), {
                preserveScroll: true
            });
        },
    }
}
</script>
