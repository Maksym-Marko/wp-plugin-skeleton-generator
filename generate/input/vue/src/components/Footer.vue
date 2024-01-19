<template>
    <footer class="bg-white rounded-lg m-4 dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl py-7 p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 by <a href="https://markomaksym.com.ua/"
                    class="hover:underline">Maksym Marko</a>. Free to use.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li
                    v-for="item in navigation"
                    
                >
                    <router-link
                        :to="item.route"
                        class="hover:underline me-4 md:me-6"
                        @click="scrollTop"
                    >
                        {{ item.label }}
                    </router-link>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue'
import store from '@/store'

const navigation = computed(() => store.getters['navigation/getFooterMenu'])

const scrollTop = () => {
    window.scrollTo(0, 0);
}
</script>