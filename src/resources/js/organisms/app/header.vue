<template>
  <v-app-bar app flat color="white">
    <header-menus :menus="headerMenus" />
    <profile-menus
      :menus="profileMenus"
      :logout-url="logoutUrl"
    />
  </v-app-bar>
</template>

<script>
import headerMenus from '../../molecules/app/header/header-menus'
import profileMenus from '../../molecules/app/header/profile-menus'

export default {
  components: {
    headerMenus,
    profileMenus
  },
  props: {
    headerMenus: {
      type: Array,
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
  }
}
</script>
