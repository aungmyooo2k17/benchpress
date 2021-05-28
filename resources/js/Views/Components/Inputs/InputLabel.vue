<template>
    <label class="block" :for="text ? text : null">
        <span class="text-gray-600 text-sm font-semibold flex items-center justify-between">
            <span v-text="text"></span>

            <span v-if="optional" class="ml-2 text-xs text-gray-500 font-normal" v-text="'optional'"></span>
        </span>

        <slot></slot>
    </label>
</template>

<script>
export default {
    props: {
        text: String,

        optional: {
            type: Boolean,
            default: false,
        }
    }
}
</script>
