<template>
    <action-section>
        <template #title>
            Invite Staff Member
        </template>

        <template #description>
            Add a new staff member to your team, allowing them to collaborate with you.
        </template>

        <template #content>
            <div class="mt-3 max-w-xl">
                <p class="text-sm text-gray-600">
                    Please provide the email address of the person you would like to invite to this team.
                </p>
            </div>

            <form class="mt-6" @submit.prevent="inviteStaffMemeber">
                <div class="lg:grid lg:grid-cols-12 gap-6">
                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input type="email" v-model="inviteStaffMemberForm.email" :error="inviteStaffMemberForm.errors.email" label="Email address" placeholder="john.doe@example.com"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input-label text="Role"></app-input-label>

                        <div class="mt-1">
                            <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                                <button type="button" class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-emerald-300 focus:ring focus:ring-emerald-200"
                                    :class="{'border-t border-gray-200 rounded-t-none': i > 0, 'rounded-b-none': i != Object.keys(roles).length - 1}"
                                    @click="inviteStaffMemberForm.role_id = role.id"
                                    v-for="(role, i) in roles"
                                    :key="role.id">
                                    <div :class="{'opacity-50': inviteStaffMemberForm.role_id && inviteStaffMemberForm.role_id != role.id}">
                                        <!-- Role Name -->
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-600" :class="{'font-semibold': inviteStaffMemberForm.role_id == role.id}"> {{ role.name }}</div>

                                            <svg v-if="inviteStaffMemberForm.role_id == role.id" class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>

                                        <!-- Role Description -->
                                        <div class="mt-2 text-xs text-gray-600">
                                            {{ role.description }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <action-message :on="inviteStaffMemberForm.recentlySuccessful" class="mr-4">
                        Invited. <span class="ml-1">&check;</span>
                    </action-message>

                    <app-button type="submit" mode="primary" :class="{ 'opacity-25': inviteStaffMemberForm.processing }" :loading="inviteStaffMemberForm.processing">
                        Invite <span class="ml-1">&rarr;</span>
                    </app-button>
                </div>
            </form>
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

export default {
    props: ['team', 'roles'],

    components: {
        ActionSection,
        AppTextarea,
        AppInput,
        AppInputLabel,
        AppInputError,
        AppButton,
        ActionMessage
    },

    data() {
        return {
            inviteStaffMemberForm: this.$inertia.form({
                email: null,
                role_id: null,
            }),
        }
    },

    methods: {
        inviteStaffMemeber() {
            this.inviteStaffMemberForm.post(this.route('invitations.store', this.team), {
                errorBag: 'inviteStaffMemeber',
                preserveScroll: true,
                onSuccess: () => this.inviteStaffMemberForm.reset(),
            });
        },
    }
}
</script>
