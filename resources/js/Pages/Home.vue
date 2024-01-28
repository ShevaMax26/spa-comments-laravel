<script setup>
import Comment from "../Components/Comment.vue";
import ContentWrapper from "../Components/ContentWrapper.vue";
import {onMounted, ref} from 'vue'
import CommentSortableLine from "../Components/CommentSortableLine.vue";
import Pagination from "../Components/Pagination.vue";
import PerPageItems from "../Components/PerPageItems.vue";

const comments = ref([]);
const total = ref(0);
const currentPage = ref(1);
const currentPerPage = ref(25);

async function getComments(page, perPage) {
    try {
        page = page ?? currentPage.value
        perPage = perPage ?? currentPerPage.value
        replaceParamInUrl('page', page)
        replaceParamInUrl('perPage', perPage)
        const urlParams = new URLSearchParams(window.location.search);
        setPerPage(parseInt(urlParams.get('perPage')));
        urlParams.set('perPage', perPage);
        urlParams.set('page', page);
        const res = await axios.get(`/api/comments?${urlParams}`);
        comments.value = res.data.comments;
        total.value = parseInt(res.data.total);
        currentPerPage.value = parseInt(res.data.perPage);
        currentPage.value = parseInt(res.data.currentPage);

    } catch (error) {
        console.error('Error fetching comments:', error);
    }
}

function changePerPage(perPage) {
    getComments(1, perPage)
}
function showNewPage(page) {
    getComments(page, currentPerPage.value)
}

function replaceParamInUrl(paramName, value) {
    const currentUrl = new URL(window.location.href);
    const queryParams = currentUrl.searchParams;
    queryParams.set(paramName, value);
    currentUrl.search = queryParams.toString();
    const updatedUrl = currentUrl.toString();
    window.history.replaceState({}, '', updatedUrl);
}

function setPerPage(perPage) {
    perPageValues.value = perPageValues.value.map(function (item) {
        if (item.number == perPage) {
            currentPerPage.value = perPage;
            item.active = true;
        } else {
            item.active = false;
        }
        return item;
    });

    if (!perPageValues.value.filter((item) => item.active == true).length) {
        perPageValues.value = perPageValues.value.map(function (item) {
            if (item.number == 25) {
                currentPerPage.value = 25;
                item.active = true;
            } else {
                item.active = false;
            }
            return item;
        });
    }
}

const perPageValues = ref([
    {
        number: 5,
        active: false,
    },
    {
        number: 10,
        active: false,
    },
    {
        number: 15,
        active: false,
    },
    {
        number: 25,
        active: false,
    },
    {
        number: 50,
        active: false,
    },
]);

onMounted(() => {
    getComments(currentPage.value, currentPerPage.value);
});

</script>

<template>
    <ContentWrapper>
        <CommentSortableLine/>
        <Comment v-for="comment in comments" :comment="comment" :key="comment.id"/>
        <div class="flex justify-around">
            <Pagination :current-per-page="currentPerPage"
                        :total="total"
                        :current-page="currentPage"
                        @show-page="showNewPage"
            />
            <div class="flex gap-2">
                <PerPageItems :items="perPageValues" @push-per-page="changePerPage"/>
            </div>
        </div>
    </ContentWrapper>
</template>


<style scoped>

</style>
