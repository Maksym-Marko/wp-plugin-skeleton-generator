<template>
    <div style="min-height: 100vh;"
        class="entry-content variations-design-container wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained"
        v-html="currentPage?.post_content"></div>
</template>

<script setup>
import { onMounted, computed, watch, ref } from 'vue'
import router from '@/router'
import store from '../store'
import { useRoute } from "vue-router"

const route = useRoute()

const pages = computed(() => store.getters['pages/getPages'])

const currentPage = ref(null)

const getCurrentPage = (computed = false) => {

    if (!route?.params?.pageSlug) {

        router.push({ name: 'home' })
    }

    const pages = store.getters['pages/getPages']

    if (Array.isArray(pages)) {

        for (let page of pages) {

            if (page.post_name === route.params.pageSlug) {

                currentPage.value = page
                break
            }
        }
    }

    if (computed) {

        if (!currentPage.value) {

            router.push({ name: 'notFound' })
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

    getCurrentPage(true)
})

</script>