<template>
  <PageComponent title="Dashboard">
    Content goes here
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue"
import store from "../store";
console.log('token', store.state.user.token)
</script>

<style scoped>

</style>