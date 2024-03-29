<script setup>
import useAuth from "@/Сomposables/useAuth";
import useRoutes from "@/Сomposables/useRoutes";
import {onMounted, ref} from "vue";

const {isAuthenticated, login, getBearerToken} = useAuth();
const {redirectTo, route, currentRouteParams} = useRoutes();

const question = ref({
    id: {
        type: Number,
        default: null,
    },
    title: '',
    text: '',
    comments_count: {
        type: Number,
        default: 0,
    },
    image: null,
    text_file: null,
    created_at: {
        type: Date
    },
    user: {
        type: Object,
        default: null,
    },
    children: {
        type: Array,
        default: [],
    },
    errors: {
        text: '',
        image: '',
        text_file: '',
    }
});

const setQuestion = (item) => {
    question.value.id = item.id;
    question.value.title = item.title;
    question.value.text = item.text;
    question.value.image = item.image;
    question.value.text_file = item.text_file;
    question.value.comments_count = item.comments_count;
    question.value.created_at = item.created_at;
    question.value.children = item.children;
    question.value.user = item.user;
}

async function getQuestion() {
    try {
        const res = await axios.get(`/api/questions/${currentRouteParams('id')}`);
        setQuestion(res.data.data)
        console.log(res.data.data)
    } catch (error) {
        console.error('Error fetching comments:', error);
        if (error.response && error.response.status === 401) {
            redirectTo('login');
        }
    }
}

onMounted(() => {
    getQuestion()
});

</script>

<template>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                 src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900">{{
                                        question.user.name
                                    }}</a>
                                <p class="text-base text-gray-500">{{ question.user.email }}</p>
                                <p class="text-base text-gray-500">{{ question.created_at.toLocaleString() }}</p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                        {{ question.title }}
                    </h1>
                </header>
                <div>
                    {{ question.text }}
                </div>
                <figure v-if="question.image">
                    <img :src="question.image" alt="">
                </figure>


                <section class="not-format">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Discussion ({{ question.comments_count }})</h2>
                    </div>
                    <form class="mb-6">
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                            <label for="question" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0"
                                      placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200">
                            Post comment
                        </button>
                    </form>
                    <article class="p-6 mb-6 text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                    alt="Michael Gough">Michael Gough</p>
                                <p class="text-sm text-gray-600">
                                    <time pubdate datetime="2022-02-08"
                                          title="February 8th, 2022">Feb. 8, 2022
                                    </time>
                                </p>
                            </div>
                            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                    type="button">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                                <span class="sr-only">Comment settings</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownComment1"
                                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p>Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
                            instruments for the UX designers. The knowledge of the design tools are as important as the
                            creation of the design strategy.</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                    class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Reply
                            </button>
                        </div>
                    </article>
                    <article class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="Jese Leos">Jese Leos</p>
                                <p class="text-sm text-gray-600">
                                    <time pubdate datetime="2022-02-12"
                                          title="February 12th, 2022">Feb. 12, 2022
                                    </time>
                                </p>
                            </div>
                            <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                    type="button">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                                <span class="sr-only">Comment settings</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownComment2"
                                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p>Much appreciated! Glad you liked it ☺️</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                    class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Reply
                            </button>
                        </div>
                    </article>
                    <article class="p-6 mb-6 text-base bg-white border-t border-gray-200">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                                    alt="Bonnie Green">Bonnie Green</p>
                                <p class="text-sm text-gray-600">
                                    <time pubdate datetime="2022-03-12"
                                          title="March 12th, 2022">Mar. 12, 2022
                                    </time>
                                </p>
                            </div>
                            <button id="dropdownComment3Button" data-dropdown-toggle="dropdownComment3"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                    type="button">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                                <span class="sr-only">Comment settings</span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownComment3"
                                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p>The article covers the essentials, challenges, myths and stages the UX designer should
                            consider while creating the design strategy.</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                    class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Reply
                            </button>
                        </div>
                    </article>
                    <article class="p-6 text-base bg-white border-t border-gray-200">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                    alt="Helene Engels">Helene Engels</p>
                                <p class="text-sm text-gray-600">
                                    <time pubdate datetime="2022-06-23"
                                          title="June 23rd, 2022">Jun. 23, 2022
                                    </time>
                                </p>
                            </div>
                            <button id="dropdownComment4Button" data-dropdown-toggle="dropdownComment4"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                    type="button">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownComment4"
                                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p>Thanks for sharing this. I do came from the Backend development and explored some of the
                            tools to design my Side Projects.</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                    class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Reply
                            </button>
                        </div>
                    </article>
                </section>
            </article>
        </div>
    </main>

    <aside aria-label="Related Asks" class="py-8 lg:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900">Related questions</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png"
                             class="mb-5 rounded-lg" alt="Image 1">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                        <a href="#">Our first office</a>
                    </h2>
                    <p class="mb-4 text-gray-500">Over the past year, Volosoft has undergone many changes! After months
                        of preparation.</p>
                    <a href="#"
                       class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600">
                        Read in 2 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png"
                             class="mb-5 rounded-lg" alt="Image 2">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                        <a href="#">Enterprise design tips</a>
                    </h2>
                    <p class="mb-4  text-gray-500">Over the past year, Volosoft has undergone many changes! After months
                        of preparation.</p>
                    <a href="#"
                       class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600">
                        Read in 12 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png"
                             class="mb-5 rounded-lg" alt="Image 3">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                        <a href="#">We partnered with Google</a>
                    </h2>
                    <p class="mb-4  text-gray-500">Over the past year, Volosoft has undergone many changes! After months
                        of preparation.</p>
                    <a href="#"
                       class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600">
                        Read in 8 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png"
                             class="mb-5 rounded-lg" alt="Image 4">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                        <a href="#">Our first project with React</a>
                    </h2>
                    <p class="mb-4  text-gray-500">Over the past year, Volosoft has undergone many changes! After months
                        of preparation.</p>
                    <a href="#"
                       class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600">
                        Read in 4 minutes
                    </a>
                </article>
            </div>
        </div>
    </aside>
</template>
