<template>
    <div>
        <form @submit.prevent="">
            <action-section>
                <template #title>
                    Membership Information
                </template>

                <template #description>
                    Update your account's profile information and email address.
                </template>

                <template #content>
                    <form @submit.prevent="updateMemberInformation">
                        <div class="lg:grid lg:grid-cols-12 gap-6">
                            <div class="col-span-12">
                                <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview">

                                <div class="flex items-center">
                                    <div v-show="! photoPreview">
                                        <img :src="member.profile_photo_url || '/img/person.svg'" :alt="member.name" class="rounded-xl h-20 w-20 object-cover">
                                    </div>

                                    <div class="mt-2" v-show="photoPreview">
                                        <span class="block rounded-full w-20 h-20"
                                            :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                        </span>
                                    </div>

                                    <div class="ml-4">
                                        <div class="flex items-center">
                                            <app-button type="button" mode="secondary" @click.prevent="selectNewPhoto">
                                                Change
                                            </app-button>

                                            <app-button class="ml-4" type="button" mode="secondary" @click.prevent="deletePhoto" v-if="member.profile_photo_path">
                                                Remove
                                            </app-button>
                                        </div>

                                        <app-input-error :message="form.errors.photo" class="mt-2"></app-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-8">
                                <app-input type="text" v-model="form.name" :error="form.errors.name" label="Full name" placeholder="Johnathan Doeford"></app-input>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-6">
                                <app-input type="text" v-model="form.username" :error="form.errors.username" label="Username" placeholder="JohnDoe"></app-input>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-6">
                                <app-input type="email" v-model="form.email" :error="form.errors.email" label="Email address" placeholder="john.doe@example.com"></app-input>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-6">
                                <app-input type="tel" v-model="form.phone" :error="form.errors.phone" label="Phone number" placeholder="07xxxxxxxx"></app-input>
                            </div>
                        </div>
                    </form>
                </template>
            </action-section>

            <section-border></section-border>

            <action-section>
                <template #title>
                    Address Information
                </template>

                <template #description>
                    Update your address and location information to match your business.
                </template>

                <template #content>
                    <div class="lg:grid lg:grid-cols-12 gap-6">
                        <div class="lg:mt-0 md:col-span-8">
                            <app-input type="text" v-model="form.line1" :error="form.errors.line1" label="Street" placeholder="2975 Driftwood Road"></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 md:col-span-6">
                            <app-input type="text" v-model="form.city" :error="form.errors.city" label="City" placeholder="San Jose"></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 md:col-span-6">
                            <app-input type="text" v-model="form.state" :error="form.errors.state" label="State/Province" placeholder="California"></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 md:col-span-6">
                            <app-input type="text" v-model="form.postal_code" :error="form.errors.postal_code" label="Postcode" placeholder="95127"></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 md:col-span-6">
                            <app-input type="text" v-model="form.country" :error="form.errors.country" label="Country" placeholder="United States"></app-input>
                        </div>
                    </div>
                </template>
            </action-section>

            <section-border></section-border>

            <action-section>
                <template #title>
                    Subscription Information
                </template>

                <template #description>
                    Products are what you sell to customers. They can be either physical goods or subscription plans.
                </template>

                <template #content>
                    <div class="mt-1 lg:grid lg:grid-cols-12 gap-6">
                        <div v-if="noMember()" class="lg:col-span-8">
                            <app-input-label text="Card information">
                                <div id="card-element"></div>
                            </app-input-label>

                            <app-input-error :message="cardErrorMessage"></app-input-error>
                        </div>

                        <div class="mt-6 lg:mt-0 col-span-full">
                            <app-input-label text="Subscription">
                                <div class="mt-1">
                                    <div class="relative z-0 border border-blueGray-200 rounded-lg cursor-pointer">
                                        <button type="button" class="relative px-4 py-3 block w-full rounded-lg focus:z-10 focus:outline-none focus:border-emerald-300 focus:ring focus:ring-emerald-200"
                                            :class="{'border-t border-blueGray-200 rounded-t-none': i > 0, 'rounded-b-none': i != Object.keys(subscriptions).length - 1}"
                                            @click="form.subscription_id = subscription.id"
                                            v-for="(subscription, i) in subscriptions"
                                            :key="subscription.id">
                                            <div class="flex items-start justify-between" :class="{'opacity-50': form.subscription_id && form.subscription_id != subscription.id}">
                                                <div>
                                                    <div class="text-left">
                                                        <div class="flex items-center">
                                                            <div class="text-blueGray-800" :class="{'font-semibold': form.subscription_id == subscription.id}"> {{ subscription.name }}</div>

                                                            <svg v-if="form.subscription_id == subscription.id" class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        </div>

                                                        <div class="mt-1 max-w-sm">
                                                            <p class="text-xs text-gray-500">
                                                                {{ subscription.description }}
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="text-right text-sm">
                                                    <span class="font-semibold text-blueGray-800">{{ subscription.amount }}</span> / {{ subscription.billing_period }}
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </app-input-label>

                            <app-input-error :message="form.errors.subscription_id"></app-input-error>
                        </div>
                    </div>
                </template>
            </action-section>

            <section-border></section-border>

            <div class="flex items-center justify-end mt-6">
                <action-message :on="form.recentlySuccessful" class="mr-4">
                    Changes saved. <span class="ml-1">&check;</span>
                </action-message>

                <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                    Save details <span class="ml-1">&rarr;</span>
                </app-button>
            </div>
        </form>
    </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import ActionSection from '@/Views/Components/Sections/ActionSection';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppInputLabel from '@/Views/Components/Inputs/InputLabel';
import AppButton from '@/Views/Components/Buttons/Button';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';

export default {
    components: {
        ActionSection,
        AppInput,
        AppInputLabel,
        AppInputError,
        AppButton,
        ActionMessage,
        SectionBorder
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
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: this.noMember() ? 'POST' : 'PUT',
                name: this.member.name,
                username: this.member.username,
                email: this.member.email,
                phone: this.member.phone,
                team_id: this.member.team_id || this.$page.props.user.team.id,
                line1: this.noMember() ? null : this.member.address.line1,
                city: this.noMember() ? null : this.member.address.city,
                state: this.noMember() ? null : this.member.address.state,
                country: this.noMember() ? null : this.member.address.country,
                postal_code: this.noMember() ? null : this.member.address.postal_code,
                subscription_id: this.member.subscription_id || 0,
                photo: null
            }),

            photoPreview: null,
            stripe: null,
            cardElement: null,
            cardErrorMessage: null,
        }
    },

    created() {
        if (this.noMember()) {
            this.initializeStripe();
        }
    },

    methods: {
        noMember() {
            return this.member &&
                Object.keys(this.member).length === 0 &&
                this.member.constructor === Object;
        },

        async initializeStripe() {
            this.stripe = await loadStripe(this.config('billing.services.stripe.key'));
            const elements = this.stripe.elements();

            this.cardElement = elements.create('card', {
                classes: {
                    'base': 'form-input px-4 py-2 mt-1 block w-full rounded-lg bg-white border border-blueGray-200 placeholder-blueGray-400 transition ease-in-out duration-150 font-sans leading-normal text-base',
                    'focus': 'outline-none border-blue-500 ring ring-blue-500 ring-opacity-50'
                },

                style: {
                    base: {
                        color: '#4B5563',
                        fontFamily: 'Inter, Roboto, Open Sans, Segoe UI, sans-serif',
                        fontSize: '16px',
                        lineHeight: '24px',
                        fontSmoothing: 'antialiased',
                    }
                },

                hidePostalCode: true
            });

            this.cardElement.addEventListener('change', (event) => {
                this.cardErrorMessage = event.error ? event.error.message : null;
            });

            this.cardElement.mount('#card-element');
        }
    }
}
</script>
