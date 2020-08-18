<template>
  <v-app-bar app flat color="white">
    <header-menu
      v-for="menu in headerMenus"
      :key="menu.url"
      :menu="menu"
    />
    <profile-menus
      :image="profileImage"
      :menus="profileMenus"
      :logout-url="logoutUrl"
      :is-active="isProfileActive"
    />
  </v-app-bar>
</template>

<script>
import profileMenus from '../../molecules/app/header/profile-menus'
import headerMenu from '../../atoms/app/header/header-menu'

export default {
  components: {
    headerMenu,
    profileMenus
  },
  props: {
    headerMenus: {
      type: Array,
      required: true
    },
    profileImage: {
      type: String,
      required: true
    },
    profileMenus: {
      type: Array,
      required: true
    },
    logoutUrl: {
      type: String,
      required: true
    }
  },
  computed: {
    isProfileActive() {
      return this.headerMenus.every(menu => !menu.isActive)
    }
  }
}
</script>
