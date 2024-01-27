<script setup>
import CommentText from "./CommentText.vue";
import CommentHeader from "./CommentHeader.vue";

const { comment } = defineProps(['comment']);
</script>

<template>
    <div class=" sm:w-[95%] md:w-[90%] lg:w-[80%] mx-auto">
        <CommentHeader :comment="comment"></CommentHeader>
        <CommentText :comment="comment"></CommentText>
    </div>
</template>
