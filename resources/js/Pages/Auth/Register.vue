<script setup>
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SimpleLink from "../../Components/SimpleLink.vue";
import InputLabel from "../../Components/InputLabel.vue";
import router from "../../routes.js";

const user = {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
};

const submit = () => {
    axios.post('/api/register', {
        name: user.name,
        email: user.email,
        password: user.password,
        password_confirmation: user.password_confirmation
    })
        .then(res => {
            localStorage.setItem('token', res.data.token)
            router.push('/')
        })
        .catch(error => {
            console.log(error)
        })
};
</script>

<template>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name"/>

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="user.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email"/>

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="user.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password"/>

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="user.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password"/>

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="user.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <SimpleLink
                        href="/login"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </SimpleLink>

                    <PrimaryButton class="ml-4">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
