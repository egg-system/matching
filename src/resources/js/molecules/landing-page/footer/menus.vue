<template>
  <v-list class="footer-menu-wrapper">
    <v-list-item
      v-for="menu in menus"
      :key="menu.name"
      :href="menu.url"
    >
      <v-list-item-content v-text="menu.name" />
    </v-list-item>
  </v-list>
</template>

<script>
export default {
  props: {
    menus: {
      type: Array,
      required: true
    }
  },
  methods: {
    redirect(url) {
      window.location = url
    }
  }
}
</script>

<style lang="scss" scoped>
.footer-menu-wrapper {
  .v-list-item__content {
    justify-content: center;
    font-size: 1rem;
  }
}
</style>
