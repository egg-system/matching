<template>
  <header>
    <div class="nav-menu-wrapper">
      <nav-menu :menus="menus" class="mx-7 my-8" />
    </div>
  </header>
</template>

<script>
import navMenu from '../../molecules/landing-page/nav-menus'

export default {
  components: { navMenu },
  props: {
    menus: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>
.nav-menu-wrapper {
  display: flex;
  justify-content: flex-end;
}
</style>
