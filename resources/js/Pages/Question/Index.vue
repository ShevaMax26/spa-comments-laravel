<script setup>
import Comment from "@/Components/Comment.vue"; //Замість "../Components/Comment.vue";
import ContentWrapper from "@/Components/ContentWrapper.vue";
import {onMounted, ref} from 'vue'
import SortableItems from "@/Components/SortableItems.vue";
import Pagination from "@/Components/Pagination.vue";
import PerPageItems from "@/Components/PerPageItems.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SimpleLink from "@/Components/SimpleLink.vue";
import useRoutes from "@/Сomposables/useRoutes.js";

const {route} = useRoutes();

const questions = ref([]);
const total = ref(0);
const currentPage = ref(1);
const currentPerPage = ref(24);
const sort = ref(null);
const direction = ref(null);

async function getQuestions() {
    try {
        replaceParamInUrl()
        const res = await axios.get(`/api/questions`, {
            params: {
                sort: sort.value,
                direction: direction.value,
                page: currentPage.value,
                perPage: currentPerPage.value,
            },
        });
        questions.value = res.data.questions;
        total.value = parseInt(res.data.total);
        currentPerPage.value = parseInt(res.data.perPage);
        currentPage.value = parseInt(res.data.currentPage);
    } catch (error) {
        console.error('Error fetching questions:', error);
    }
}


function changePerPage(perPage) {
    currentPage.value = 1;
    currentPerPage.value = perPage;
    getQuestions()
}

function showNewPage(page) {
    currentPage.value = page
    getQuestions()
}

function replaceParamInUrl() {
    const currentUrl = new URL(window.location.href);
    const params = currentUrl.searchParams;
    if (sort.value) {
        params.set('sort', sort.value);
    }
    if (direction.value) {
        params.set('direction', direction.value);
    }
    if (currentPage.value) {
        params.set('page', currentPage.value);
    }
    if (currentPerPage.value) {
        params.set('perPage', currentPerPage.value);
    }

    currentUrl.search = params.toString();
    const updatedUrl = currentUrl.toString();
    window.history.replaceState({}, '', updatedUrl);
}

onMounted(() => {
    getQuestions();
});

function applySortField(activeLabel) {
    sort.value = activeLabel.slug;
    direction.value = activeLabel.direction;
    getQuestions()
}

</script>

<template>
    <ContentWrapper>
        <div class="flex items-center justify-between">
            <SortableItems
                @sort-changed="applySortField"
            />
            <SimpleLink
                :href="route('create-question')"
            >
                <PrimaryButton>
                    Ask Question
                </PrimaryButton>
            </SimpleLink>
        </div>

        <div class="px-4 mx-auto max-w-screen-xl mb-6">
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                <Comment v-for="question in questions" :question="question" :key="question.id"/>
            </div>
        </div>

        <div class="flex justify-around">
            <Pagination :current-per-page="currentPerPage"
                        :total="total"
                        :current-page="currentPage"
                        @show-page="showNewPage"
            />
            <div class="flex gap-2">
                <PerPageItems @push-per-page="changePerPage"/>
            </div>
        </div>
    </ContentWrapper>
</template>


<style scoped>

</style>

