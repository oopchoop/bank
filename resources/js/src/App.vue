<template>
  <HeaderComponent></HeaderComponent>
  <router-view></router-view>
  <FooterComponent></FooterComponent>
</template>
<script lang="ts">
import Home from "./pages/Home.vue";
import HeaderComponent from "./components/HeaderComponent.vue";
import FooterComponent from "./components/FooterComponent.vue";

export default {
  setup() {},
  components: {
    Home,
    HeaderComponent,
    FooterComponent
  }
}
</script>

<style scoped>

</style>
