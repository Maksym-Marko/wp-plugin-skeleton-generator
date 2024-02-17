<template>
    <div style="min-height: 100vh;"
        class="entry-content variations-design-container wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained"
        v-html="homePage?.post_content"></div>
</template>

<script setup>
import { onMounted, computed, watch, ref } from 'vue'
import store from '../store'
import { useRoute } from "vue-router"

const route = useRoute()

const pages = computed(() => store.getters['pages/getPages'])

const homePage = ref(null)

const getHomePage = () => {

    const pages = store.getters['pages/getPages']

    if (Array.isArray(pages)) {

        for (let page of pages) {

            if (page.post_name === import.meta.env.VITE_HOME_SLUG) {

                homePage.value = page
                break
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