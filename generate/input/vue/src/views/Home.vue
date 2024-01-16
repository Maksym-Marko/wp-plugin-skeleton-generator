<template>
    <div v-if="homePage" :id="homePage.id" class="p-8" v-html="homePage.content.rendered"></div>
</template>

<script setup>
import { onMounted, computed, watch, ref } from 'vue';
import store from '../store';
import { useRoute } from "vue-router";

const route = useRoute()

const pages = computed(() => store.getters['pages/getPages'])

const homePage = ref(null)

const getHomePage = () => {

    const pages = store.getters['pages/getPages']

    if (Array.isArray(pages)) {

        for (let page of pages) {

            if (page.slug === import.meta.env.VITE_HOME_SLUG) {

                homePage.value = page
                break;
            }
        }
    }
}

onMounted(() => {

    getHomePage()
})

watch(route, () => {

    getHomePage()
})

watch(pages, () => {

    getHomePage()
})

</script>