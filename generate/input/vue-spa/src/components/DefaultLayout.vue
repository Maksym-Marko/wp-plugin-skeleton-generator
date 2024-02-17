<template>
  <Header />

  <router-view />

  <Footer />

  <FlashMessage />
</template>

<script setup>
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
import FlashMessage from '@/components/FlashMessage.vue'
</script>