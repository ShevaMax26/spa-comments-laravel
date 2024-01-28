<script setup>
import PerPageItem from "./PerPageItem.vue";

const emit = defineEmits(['pushPerPage']);
const props = defineProps({
    items: {
        type: Array,
        default: [],
    },
});

function changePerPage(perPage) {
    emit('pushPerPage', perPage);
}

</script>

<template>
    <div class="flex gap-2 items-center">
        <span>Per page:</span>
        <PerPageItem
            v-for="item in props.items"
            :item="item"
            @change-per-page="changePerPage"
        />
    </div>
</template>
