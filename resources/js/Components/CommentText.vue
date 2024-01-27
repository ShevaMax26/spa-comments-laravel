<script setup>
const { comment } = defineProps(['comment']);
</script>

<template>
    <div class="mt-3 mb-8">
        {{ comment.message }}
    </div>
</template>

<style scoped lang="scss">
.social-icons__item {
    &:hover {
        color: rgba(30, 144, 255, 0.6);
    }
}
</style>
