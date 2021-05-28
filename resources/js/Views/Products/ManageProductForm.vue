<template>
    <div>
        <form @submit.prevent="updateProfileInformation">
            <action-section>
                <template #title>
                    Product Information
                </template>

                <template #description>
                    Products are what you sell to customers. They can be either physical goods or subscription plans.
                </template>

                <template #content>
                    <div>
                        <div class="lg:grid lg:grid-cols-12 gap-6">
                            <div class="col-span-12">
                                <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview">

                                <div class="flex items-center">
                                    <div v-show="! photoPreview">
                                        <img :src="productPhotoUrl" :alt="product.name" class="rounded-xl h-32 w-32 object-cover">
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

                                            <app-button class="ml-4" type="button" mode="secondary" @click.prevent="deletePhoto" v-if="product.profile_photo_path">
                                                Remove
                                            </app-button>
                                        </div>

                                        <app-input-error :message="form.errors.photo" class="mt-2"></app-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-8">
                                <app-input type="text" v-model="form.name" :error="form.errors.name" label="Name" placeholder="Kardio Work"></app-input>
                            </div>

                            <div class="col-span-full lg:grid lg:grid-cols-12 gap-6">
                                <div class="mt-6 lg:mt-0 md:col-span-4">
                                    <app-input type="text" v-model="form.height" :error="form.errors.height" label="Height (m)" :label-optional="true" placeholder="12"></app-input>
                                </div>

                                <div class="mt-6 lg:mt-0 md:col-span-4">
                                    <app-input type="text" v-model="form.width" :error="form.errors.width" label="Width (m)" :label-optional="true" placeholder="12"></app-input>
                                </div>

                                <div class="mt-6 lg:mt-0 md:col-span-4">
                                    <app-input type="text" v-model="form.length" :error="form.errors.length" label="Length (m)" :label-optional="true" placeholder="12"></app-input>
                                </div>
                            </div>

                            <div class="mt-6 lg:mt-0 col-span-full">
                                <app-textarea v-model="form.description" :error="form.errors.description" label="Description" placeholder="Tell us a little about your business"></app-textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </action-section>

            <section-border></section-border>

            <action-section>
                <template #title>
                    Pricing Information
                </template>

                <template #description>
                    Prices define the unit cost, currency, and (optional) billing cycle for both recurring and one-time purchases of products.
                </template>

                <template #content>
                    <div>
                        <div class="lg:grid lg:grid-cols-12 gap-6">
                            <div class="mt-6 lg:mt-0 md:col-span-8">
                                <app-input type="text" v-model="form.price" :error="form.errors.price" label="Price (USD)" placeholder="0.00"></app-input>
                            </div>

                            <div class="mt-6 lg:mt-0 md:col-span-6">
                                <app-input-label text="Payment type">
                                    <div class="mt-2 flex items-center space-x-3">
                                        <button type="button" class="text-sm border border-gray-200 px-4 py-2 inline-flex rounded-lg focus:z-10 focus:outline-none focus:border-emerald-300 focus:ring focus:ring-emerald-200"
                                        :class="{ 'ring ring-emerald-200' : form.payment_type === type.id }"
                                        @click="form.payment_type = type.id"
                                        v-for="(type, id) in payment_types"
                                        :key="id">{{ type.name }}</button>
                                    </div>
                                </app-input-label>

                                <app-input-error :message="form.errors.payment_type"></app-input-error>
                            </div>

                            <div v-if="form.payment_type === 'recurring'" class="mt-6 lg:mt-0 md:col-span-8">
                                <app-input-label text="Billing period">
                                    <select v-model="form.billing_period" class="form-select px-4 py-2 mt-1 block w-full rounded-lg bg-white border border-gray-200 focus:outline-none focus:border-emerald-500 focus:ring focus:ring-emerald-500 focus:ring-opacity-50 placeholder-gray-400 transition ease-in-out duration-150">
                                        <option v-for="(period, index) in billing_periods" :key="index" :value="period">{{ period }}</option>
                                    </select>
                                </app-input-label>

                                <app-input-error :message="form.errors.billing_period"></app-input-error>
                            </div>
                        </div>
                    </div>
                </template>
            </action-section>

            <section-border></section-border>

            <div class="flex items-center justify-end mt-6">
                <action-message :on="form.recentlySuccessful" class="mr-4">
                    Saved. <span class="ml-1">&check;</span>
                </action-message>

                <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                    Save product <span class="ml-1">&rarr;</span>
                </app-button>
            </div>
        </form>
    </div>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import AppTextarea from '@/Views/Components/Inputs/Textarea';
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppInputLabel from '@/Views/Components/Inputs/InputLabel';
import AppButton from '@/Views/Components/Buttons/Button';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';

export default {
    components: {
        ActionSection,
        AppTextarea,
        AppInput,
        AppInputLabel,
        AppInputError,
        AppButton,
        ActionMessage,
        SectionBorder
    },

    props: {
        product: {
            type: Object,
            required: false,
            default: {}
        },
    },

    computed: {
        productPhotoUrl() {
            if (! this.product.profile_photo_url) {
                return `${location.protocol}//${location.host}/img/product.svg`;
            }

            return this.product.profile_photo_url
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: this.product ? 'PUT' : 'POST',
                name: this.product.name,
                description: this.product.description,
                price: null,
                billing_period: this.product.billing_period || 'Monthly',
                payment_type: this.product.payment_type || 'onetime',
                height: this.product.height,
                width: this.product.width,
                length: this.product.length,
                photo: null
            }),

            photoPreview: null,

            payment_types: [
                {
                    'name': 'One time',
                    'id': 'onetime',
                    'default': true
                },
                {
                    'name': 'Recurring',
                    'id': 'recurring',
                    'default': false
                },
            ],

            billing_periods: [
                'Daily',
                'Weekly',
                'Monthly',
                'Yearly',
            ]
        }
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(this.route('teams.update', { team: this.team }), {
                errorBag: 'updateTeamInformation',
                preserveScroll: true,
                onSuccess: () => (this.clearPhotoFileInput()),
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const photo = this.$refs.photo.files[0];

            if (! photo) return;

            const reader = new FileReader();

            reader.onload = event => this.photoPreview = event.target.result;

            reader.readAsDataURL(photo);
        },

        deletePhoto() {
            this.$inertia.delete(this.route('team-photo.destroy'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.photoPreview = null;
                    this.clearPhotoFileInput();
                }
            });
        },

        clearPhotoFileInput() {
            if (this.$refs.photo?.value) {
                this.$refs.photo.value = null;
            }
        },

        getFirstPaymentType() {
            return this.payment_types[0].id;
        }
    }
}
</script>
