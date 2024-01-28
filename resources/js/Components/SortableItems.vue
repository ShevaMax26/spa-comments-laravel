<script setup>
import SortableItem from "./SortableItem.vue";
import {ref} from "vue";

const emit = defineEmits(['sortChanged']);

const sortableLabels = ref([
    {
        name: 'User Name',
        direction: 'asc',
        active: false,
        slug: 'name'
    },
    {
        name: 'Email',
        direction: 'asc',
        active: false,
        slug: 'email'
    },
    {
        name: 'Date',
        direction: 'desc',
        active: true,
        slug: 'created_at'
    }
]);

function changeActiveLabel(labelSlug) {
    sortableLabels.value.forEach(label => {
        if (label.slug == labelSlug) {
            label.active = true
            if (label.direction == 'asc') {
                label.direction = 'desc'
            } else {
                label.direction = 'asc'
            }

            pushActiveLabel(label);
        } else {
            label.active = false
        }
    })
}

function pushActiveLabel(activeLabelSlug) {
    emit('sortChanged', activeLabelSlug);
}

</script>
<template>
    <div class="flex gap-3 items-center justify-around bg-zinc-200 p-2 sm:w-[75%] md:w-[70%] lg:w-[60%] mx-auto">
        <SortableItem
            v-for="label in sortableLabels"
            :name="label.name"
            :direction="label.direction"
            :active="label.active"
            :slug="label.slug"
            @click-sort-label="changeActiveLabel"
        />
    </div>
</template>
