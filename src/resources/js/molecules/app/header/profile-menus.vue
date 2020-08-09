<template>
  <v-menu :offset-y="true">
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <profile-icon />
      </v-btn>
    </template>
    <profile-menu-list :menus="menus" :logout-url="logoutUrl" />
  </v-menu>
</template>

<script>
import profileIcon from '../../../atoms/app/profile-icon'
import profileMenuList from './profile-menu-list'

export default {
  components: { profileIcon, profileMenuList },
  props: {
    menus: {
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
