<script setup>
import Comment from "../Components/Comment.vue";
import ContentWrapper from "../Components/ContentWrapper.vue";
import {ref, onMounted} from 'vue'
import CommentSortableLine from "../Components/CommentSortableLine.vue";


const comments = ref([]);

async function getComments() {
    try {
        const res = await axios.get('/api/comments');
        comments.value = res.data.data;
        console.log(comments.value);
    } catch (error) {
        console.error('Error fetching comments:', error);
    }
}

onMounted(() => {
    getComments();
});
</script>

<template>
    <ContentWrapper>
        <CommentSortableLine></CommentSortableLine>
        <Comment v-for="comment in comments" :comment="comment" :key="comment.id"></Comment>
    </ContentWrapper>
</template>


<style scoped>

</style>
