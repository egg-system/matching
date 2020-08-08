<template>
  <v-app-bar app flat color="white">
    <header-menus :menus="headerMenus" />
    <profile-menus />
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
    }
  }
}
</script>
