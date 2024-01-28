<script setup>
import PerPageItem from "./PerPageItem.vue";
import {ref} from "vue";

const emit = defineEmits(['pushPerPage']);

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

function setPerPage(perPage) {
    perPageValues.value.forEach(item => {
        if (item.number == perPage) {
            item.active = true
        } else {
            item.active = false
        }
    })

    if (!perPageValues.value.filter((item) => item.active == true).length) {
        perPageValues.value.forEach(item => {
            if (item.number == 25) {
                item.active = true
            } else {
                item.active = false
            }
        })
    }
}

function changePerPage(perPage) {
    setPerPage(perPage)
    emit('pushPerPage', perPage);
}

</script>

<template>
    <div class="flex gap-2 items-center">
        <span>Per page:</span>
        <PerPageItem
            v-for="item in perPageValues"
            :item="item"
            @change-per-page="changePerPage"
        />
    </div>
</template>
