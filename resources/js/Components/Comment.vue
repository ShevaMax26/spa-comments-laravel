<script setup>
import CommentText from "./CommentText.vue";
import CommentHeader from "./CommentHeader.vue";

const { comment } = defineProps(['comment']);
</script>

<template>
    <div class="mx-auto">
        <CommentHeader :comment="comment"></CommentHeader>
        <CommentText :comment="comment"></CommentText>
    </div>
</template>
