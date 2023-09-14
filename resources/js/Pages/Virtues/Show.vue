<template>
    <jet-action-section>
        <template #title>
            Virtue Details
        </template>
        <template #description>
            View the details of the selected virtue.
        </template>
        <template #content>
            <div>
                <p>{{ virtue.data }}</p>
                <!-- Add more details or actions as needed -->
            </div>
        </template>
    </jet-action-section>
</template>

<script>
export default {
    props: {
        virtue: Object
    }
}
</script>
