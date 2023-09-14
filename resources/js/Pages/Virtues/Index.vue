<template>
    <jet-action-section>
        <template #title>
            Your Virtues
        </template>
        <template #description>
            List of virtues.
        </template>
        <template #content>
            <ul>
                <li v-for="virtue in virtues" :key="virtue.id">
                    {{ virtue.data }}
                </li>
            </ul>
        </template>
    </jet-action-section>
</template>

<script>
export default {
    props: {
        virtues: {
            type: Array,
            required: true,
        }
    }
}
</script>
