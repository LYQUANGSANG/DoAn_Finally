<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import HeaderVue from './components/Header.vue';
import FooterVue from './components/Footer.vue';

</script>

<template>
  <div style="float: left;">
    <HeaderVue class="headerVue"></HeaderVue>

    <div class="content">
      <RouterView />
    </div>
    <FooterVue class="footer"></FooterVue>
  </div>
</template>

<style scoped>
.content {
  margin-top: 54px;
  width: 98.9vw;
}

.header {
  position: sticky;
  top: 0;
}
</style>
