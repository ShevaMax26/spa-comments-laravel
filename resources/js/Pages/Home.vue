<script setup>
import Comment from "../Components/Comment.vue";
import ContentWrapper from "../Components/ContentWrapper.vue";
import {onMounted, ref} from 'vue'
import SortableItems from "../Components/SortableItems.vue";
import Pagination from "../Components/Pagination.vue";
import PerPageItems from "../Components/PerPageItems.vue";

const comments = ref([]);
const total = ref(0);
const currentPage = ref(1);
const currentPerPage = ref(25);
const sort = ref(null);
const direction = ref(null);
async function getComments() {
    try {
        replaceParamInUrl()
        const res = await axios.get(`/api/comments`, {
            params: {
                sort: sort.value,
                direction: direction.value,
                page: currentPage.value,
                perPage: currentPerPage.value,
            }
        });
        comments.value = res.data.comments;
        total.value = parseInt(res.data.total);
        currentPerPage.value = parseInt(res.data.perPage);
        currentPage.value = parseInt(res.data.currentPage);

    } catch (error) {
        console.error('Error fetching comments:', error);
    }
}

function changePerPage(perPage) {
    currentPage.value = 1;
    currentPerPage.value = perPage;
    getComments()
}
function showNewPage(page) {
    currentPage.value = page
    getComments()
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
    getComments();
});

function applySortField(activeLabel) {
    sort.value = activeLabel.slug;
    direction.value = activeLabel.direction;
    getComments()
}

</script>

<template>
    <ContentWrapper>
        <SortableItems
            @sort-changed="applySortField"
        />
        <Comment v-for="comment in comments" :comment="comment" :key="comment.id"/>
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

