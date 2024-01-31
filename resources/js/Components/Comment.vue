<script setup>
import SimpleLink from "@/Components/SimpleLink.vue";
import useRoutes from "@/Сomposables/useRoutes.js";

const {route} = useRoutes();

const {question} = defineProps(['question']);
</script>

<template>
    <article class="max-w-xs flex flex-col justify-between">
        <div class="flex flex-col gap-2">
            <SimpleLink :href="route('show-question', {
                    id: question.id
                })"
                        class="mb-2"
            >
                <img :src="question.image ?? '/img/front/question.jpeg'"
                     class="rounded-lg"
                     width="240"
                     height="320"
                     title="ask"
                     alt="Image 1">
            </SimpleLink>
            <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900">
                <SimpleLink :href="route('show-question', {
                    id: question.id
                })">
                    {{ question.title ? strLimit(question.title, 45) : '' }}
                </SimpleLink>
            </h2>
        </div>


        <p class="mb-4 text-gray-500">
            {{ strLimit(question.text, 65) }}
        </p>

        <SimpleLink :href="route('show-question', {
                    id: question.id
                })">
                <span class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600">
                Read more
            </span>
        </SimpleLink>
    </article>
</template>
