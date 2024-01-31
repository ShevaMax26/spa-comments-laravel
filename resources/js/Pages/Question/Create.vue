<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useAuth from "@/Сomposables/useAuth";
import useRoutes from "@/Сomposables/useRoutes";
import {onMounted, ref} from "vue";

const {isAuthenticated, login, getBearerToken} = useAuth();
const {redirectTo, route} = useRoutes();

const form = ref({
    message: '',
    title: '',
    image: null,
    text_file: null,
    errors: {
        title: '',
        text: '',
        image: '',
        text_file: '',
    }
});

onMounted(() => {
    if (!isAuthenticated()) {
        redirectTo('login')
    }
});

const handleImageChange = (event) => {
    form.value.image = event.target.files[0];
};

const handleFileChange = (event) => {
    form.value.text_file = event.target.files[0];
};

const submit = () => {
    axios.post('/api/questions', form.value, {
            headers: {
                'Content-Type': 'multipart/form-data', // Для відправки FormData встановіть правильний заголовок
                Authorization: `Bearer ${getBearerToken()}`, // Додаємо токен авторизації
            },
        }
    )
        .then(res => {
            redirectTo('home')
        })
        .catch(error => {
            if (error.response && error.response.status === 401) {
                redirectTo('login');
            }
            console.log(error)
        })
};
</script>

<template>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label for="title"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Name
                    </label>
                    <input type="text"
                           v-model="form.title"
                           name="title"
                           id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           placeholder="Type title here..."
                           required="">
                </div>
                <div class="mb-6">
                    <label
                        for="message"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >Ask something:</label>
                    <textarea
                        v-model="form.text"
                        id="message"
                        rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your thoughts here..."
                    ></textarea>
                </div>

                <div class="mb-6">
                    <label for="image"
                           class="block mb-2 text-sm font-medium text-gray-900"
                    >Image:</label>
                    <input type="file"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                           accept="image/*"
                           @change="handleImageChange"
                           id="image">
                </div>

                <div>
                    <label for="file"
                           class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        File (.txt):
                    </label>
                    <input type="file"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                           accept=".txt"
                           @change="handleFileChange"
                           id="file"
                    >
                </div>


                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
