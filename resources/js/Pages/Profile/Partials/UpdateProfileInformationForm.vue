<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const authUser = computed(() => page.props.auth.user)

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    avatar: "",
    country: "",
    city: "",
    postal_address: "",
    postal_code: "",
    facebook_link: "",
    x_link: "",
    linkedin_link: "",
    instagram_link: "",
    twitter_site: "",
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>



            <div v-if="user.assigned_role === 'author'">


            <div>
                <InputLabel for="avatar" value="Your Photo" />

                <input id="file-upload" name="avatar" type="file" @change="form.avatar = $event.target.files[0]" />

                <InputError class="mt-2" :message="form.errors.avatar" />
            </div>

            <div>
                <InputLabel for="country" value="Country" />

                <TextInput
                    id="country"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.country"
                    value="$props.user.profile.country"
                    autocomplete="country"
                />

                <InputError class="mt-2" :message="form.errors.country" />
            </div>

            <div>
                <InputLabel for="city" value="City" />

                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    autocomplete="city"
                />

                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div>
                <InputLabel for="postal_address" value="Postal Address" />

                <TextInput
                    id="postal_address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.postal_address"
                    autocomplete="postal_address"
                />

                <InputError class="mt-2" :message="form.errors.postal_address" />
            </div>

            <div>
                <InputLabel for="postal_code" value="Postal Code" />

                <TextInput
                    id="postal_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.postal_code"
                    autocomplete="postal_code"
                />

                <InputError class="mt-2" :message="form.errors.postal_code" />
            </div>

            <div>
                <InputLabel for="facebook_link" value="Facebook Link" />

                <TextInput
                    id="facebook_link"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.facebook_link"
                    autocomplete="facebook_link"
                />

                <InputError class="mt-2" :message="form.errors.facebook_link" />
            </div>

            <div>
                <InputLabel for="x_link" value="X Link" />

                <TextInput
                    id="x_link"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.x_link"
                    autocomplete="x_link"
                />

                <InputError class="mt-2" :message="form.errors.x_link" />
            </div>

            <div>
                <InputLabel for="linkedin_link" value="Linkedin Link" />

                <TextInput
                    id="linkedin_link"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.linkedin_link"
                    autocomplete="linkedin_link"
                />

                <InputError class="mt-2" :message="form.errors.linkedin_link" />
            </div>

            <div>
                <InputLabel for="instagram_link" value="Instagram Link" />

                <TextInput
                    id="instagram_link"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.instagram_link"
                    autocomplete="instagram_link"
                />

                <InputError class="mt-2" :message="form.errors.instagram_link" />
            </div>

            <div>
                <InputLabel for="twitter_site" value="Twitter Handler" />

                <TextInput
                    id="twitter_site"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.twitter_site"
                    autocomplete="twitter_site"
                />

                <InputError class="mt-2" :message="form.errors.twitter_site" />
            </div>

            <div>
                <InputLabel for="user_info" value="Author Information" />

                <TextInput
                    id="user_info"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.user_info"
                    autocomplete="user_info"
                />

                <InputError class="mt-2" :message="form.errors.user_info" />
            </div>

            </div>


            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
