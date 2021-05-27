<template>
    <action-section>
        <template #title>
            Staff Members
        </template>

        <template #description>
            All of the people that are part of this team.
        </template>

        <template #content>
            <div class="space-y-6" v-if="team.members.length > 0">
                <card class="shadow-none" :has-action="false" v-for="member in team.members" :key="member.id">
                    <template #content>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="w-12 h-12 rounded-full" :src="member.profile_photo_url" :alt="member.name">

                                <div class="ml-4">
                                    <div class="text-sm font-semibold">{{ member.name }}</div>

                                    <div>
                                        <app-link class="text-xs" :href="member.email">{{ member.email }}</app-link>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <!-- Manage Team Member Role -->
                                <div class="ml-2" v-if="roles.length">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold text-emerald-800 bg-emerald-100">
                                        {{ displayableRole(member.role) }}
                                    </span>
                                </div>

                                <!-- Remove Team Member -->
                                <button v-if="$page.props.user.id !== member.id" class="cursor-pointer ml-6 text-sm text-red-500"
                                    @click="confirmStaffMemberRemoval(member)">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </template>
                </card>
            </div>

            <div v-else>
                <p class="text-sm text-gray-600">
                    No staff members added yet.
                </p>
            </div>

            <dialog-modal :show="staffMemberBeingRemoved" :hasActions="true" @close="staffMemberBeingRemoved = null">
                <template #title>
                    Remove Staff Member
                </template>

                <template #content>
                    <p class="text-sm text-gray-600">
                        Are you sure you would like to remove this person from the team?
                    </p>
                </template>

                <template #actions>
                    <app-button mode="secondary" @clicked="staffMemberBeingRemoved = null">
                        Cancel
                    </app-button>

                    <app-button mode="danger" class="ml-2" @clicked="removeStaffMember" :class="{ 'opacity-25': removeStaffMemberForm.processing }" :disabled="removeStaffMemberForm.processing">
                        Remove
                    </app-button>
                </template>
            </dialog-modal>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppTextarea from '@/Views/Components/Inputs/Textarea';
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputLabel from '@/Views/Components/Inputs/InputLabel';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppButton from '@/Views/Components/Buttons/Button';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';
import AppLink from '@/Views/Components/Base/Link';
import Card from '@/Views/Components/Cards/Card.vue';
import DialogModal from '@/Views/Components/Modals/DialogModal';

export default {
    props: ['team', 'roles'],

    components: {
        ActionSection,
        AppTextarea,
        AppInput,
        AppInputLabel,
        AppInputError,
        AppButton,
        ActionMessage,
        Card,
        AppLink,
        DialogModal,
    },

    data() {
        return {
            inviteStaffMemberForm: this.$inertia.form({
                email: null,
                role: null,
            }),

            removeStaffMemberForm: this.$inertia.form(),

            staffMemberBeingRemoved: null
        }
    },

    methods: {
        inviteStaffMemeber() {
            this.inviteStaffMemberForm.post(this.route('staff.store', this.team), {
                errorBag: 'inviteStaffMemeber',
                preserveScroll: true,
                onSuccess: () => this.inviteStaffMemeberForm.reset(),
            });
        },

        confirmStaffMemberRemoval(staffMember) {
            this.staffMemberBeingRemoved = staffMember
        },

        removeStaffMember() {
            this.removeStaffMemberForm.delete(route('staff.destroy', [this.team, this.staffMemberBeingRemoved]), {
                errorBag: 'removeStaffMember',
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (this.staffMemberBeingRemoved = null),
            })
        },

        displayableRole(role) {
            return this.roles.find(r => r.name === role).name
        },
    }
}
</script>
