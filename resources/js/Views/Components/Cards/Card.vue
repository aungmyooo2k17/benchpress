<template>
    <div class="shadow overflow-hidden rounded-xl">
        <div class="px-4 py-5 sm:px-6" :class="bgColor">
            <slot name="content"></slot>
        </div>

        <div v-show="hasActions" class="flex items-center justify-end px-4 py-5 bg-blueGray-100 text-right sm:px-6">
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        hasActions: {
            type: Boolean,
            default: false
        },

        bgColor: {
            type: String,
            default: 'bg-white'
        }
    }
}
</script>

