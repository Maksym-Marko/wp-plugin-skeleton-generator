<template>
    <div v-if="currentPage" :id="currentPage.id" class="p-8" v-html="currentPage.content.rendered"></div>
</template>

<script setup>
import { onMounted, computed, watch, ref } from 'vue';
import router from '@/router'
import store from '../store';
import { useRoute } from "vue-router";

const route = useRoute()

const pages = computed(() => store.getters['pages/getPages'])

const currentPage = ref(null)

const getCurrentPage = () => {

    if (!route?.params?.pageSlug) {

        router.push({ name: 'Home' })
    }

    const pages = store.getters['pages/getPages']

    if (Array.isArray(pages)) {

        for (let page of pages) {

            if (page.slug === route.params.pageSlug) {

                currentPage.value = page
                break;
            }
        }
    }
}

onMounted(() => {

    getCurrentPage()
})

watch(route, () => {

    getCurrentPage()
})

watch(pages, () => {

    getCurrentPage()
})

</script>