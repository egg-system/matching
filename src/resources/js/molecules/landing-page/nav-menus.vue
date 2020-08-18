<template>
  <div>
    <div @click="open">
      <nav-icon v-if="isEnabledLogin" />
    </div>
    <v-navigation-drawer v-model="isShown" width="15rem" right app temporary>
      <v-list nav class="landig-page-menu">
        <v-list-item
          v-for="menu in menus"
          :key="menu.url"
          :href="menu.url"
          class="my-3 mx-2"
        >
          <v-list-item-content>
            <v-list-item-title v-text="menu.name" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
import navIcon from '../../atoms/landing-page/nav-icon'

export default {
  components: { navIcon },
  props: {
    menus: {
      type: Array,
      required: true
    }
  },
  data: () => ({ isShown: false }),
  computed: {
    isEnabledLogin() {
      return this.$root.isEnabled('login')
    }
  },
  methods: {
    open() {
      this.isShown = true
    }
  }
}
</script>

<style lang="scss" scoped>
.landig-page-menu {
  .v-list-item__title {
    font-size: 1.2rem;
  }
}
</style>
