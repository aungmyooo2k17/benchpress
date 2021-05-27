<template>
    <inertia-link @click="$emit('clicked')" :href="href" class="text-emerald-500 no-underline hover:text-emerald-600 hover:no-underline focus:text-emerald-600 focus:no-underline active:text-gray-600 active:no-underline transition ease-in-out duration-150"><slot></slot></inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: {
            required: true,
            type: String
        }
    }
}
</script>
