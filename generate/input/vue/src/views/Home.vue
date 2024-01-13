<template>
    <div class="flex p-8 justify-center">
        <input type="text" class="rounded border-2 border-gray-200" />
    </div>
</template>

<!-- https://youtu.be/cfiN8lCA3RM?si=MGszGzCSS5z8vEQD -->

<script setup>
import { computed } from 'vue';
import store from '../store';

const meals = computed(() => store.state.meals)
</script>