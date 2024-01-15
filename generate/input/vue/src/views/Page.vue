<template>
    <div class="flex p-8 justify-center">
        page
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import router from '@/router'
import store from '../store';
import { useRoute } from "vue-router";

const route = useRoute()

const getCurrentPage = () => {

    if(!route?.params?.pageSlug) {
        
        router.push( {name: 'Home'} )
    }

    const pages = store.getters['pages/getPages']

    console.log(pages)
    
}

onMounted(() => {

    getCurrentPage()
})

</script>