<template>
  <header>
    <div class="nav-menu-wrapper">
      <nav-menu class="mx-14 my-16" />
    </div>
  </header>
</template>

<script>
import navMenu from '../../moleclues/landing-page/nav-menus'

export default {
  components: { navMenu }
}
</script>

<style scoped>
.nav-menu-wrapper {
  display: flex;
  justify-content: flex-end;
}
</style>
