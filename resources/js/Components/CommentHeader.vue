<script setup>
import CommentAction from "./CommentAction.vue";
</script>
<template>
        <div class="flex gap-3 items-center bg-zinc-200 p-2">
            <div class="text-[30px] mr-1">
                <i class="fa-regular fa-face-smile"></i>
            </div>
            <div class="font-extrabold text-[18px]">Maxym</div>
            <div class="text-[16px]">22.05.23 в 22:30</div>
            <div class="flex gap-2 ml-1">
                <CommentAction><i class="fa-solid fa-hashtag"></i></CommentAction>
                <CommentAction><i class="fa-regular fa-bookmark"></i></CommentAction>
                <CommentAction><i class="fa-regular fa-circle-up"></i></CommentAction>
            </div>
        </div>
</template>
<style scoped lang="scss">
.social-icons__item {
    &:hover {
        color: rgba(30, 144, 255, 0.6);
    }
}
</style>
