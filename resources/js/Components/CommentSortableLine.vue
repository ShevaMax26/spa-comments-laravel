<script setup>
import SortableIcons from "./SortableIcons.vue";
</script>
<template>
        <div class="flex gap-3 items-center justify-around bg-zinc-200 p-2 sm:w-[75%] md:w-[70%] lg:w-[60%] mx-auto">
            <div>
                User Name
                <SortableIcons></SortableIcons>
            </div>
            <div>
                E-mail
                <SortableIcons></SortableIcons>
            </div>
            <div>
                Date
                <SortableIcons></SortableIcons>
            </div>
        </div>
</template>
