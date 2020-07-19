<template>
  <div>
    <div @click="open">
      <nav-icon v-if="false" />
    </div>
    <v-navigation-drawer v-model="isShown" right app temporary>
      <v-list nav>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>テスト</v-list-item-title>
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
  data: () => ({ isShown: false }),
  methods: {
    open() {
      this.isShown = true
    }
  }
}
</script>

<style scoped>
.landing-page-nav-menu {
  display: inline;
}
</style>
