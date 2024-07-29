<script setup>
const props = defineProps(['position', 'smallestPosition', 'biggestPosition']);
console.log(props)
</script>

<template>
    <div :class="{'text-gray-400': props.position === props.smallestPosition}">
        <button @click.stop="$emit('moveUp')" :disabled="props.position === props.smallestPosition">▲</button>
    </div>
    <div :class="{'text-gray-400': props.position === props.biggestPosition}">
        <button @click.stop="$emit('moveDown')" :disabled="props.position === props.biggestPosition">▼</button>
    </div>
</template>

<style scoped>

</style>
