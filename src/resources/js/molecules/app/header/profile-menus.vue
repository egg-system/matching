<template>
  <v-menu :offset-y="true">
    <template v-slot:activator="{ on }">
      <div
        class="nav-menu-items"
        :class="isActive ? 'active-nav-menu-item' : ''"
      >
        <v-btn depressed text block v-on="on">
          <image-icon :image="image" :is-active="isActive" />
        </v-btn>
      </div>
    </template>
    <profile-menu-list :menus="menus" :logout-url="logoutUrl" />
  </v-menu>
</template>

<script>
import imageIcon from '../../../atoms/app/header/image-icon'
import profileMenuList from './profile-menu-list'

export default {
  components: { imageIcon, profileMenuList },
  props: {
    image: {
      type: String,
      required: true
    },
    menus: {
      type: Array,
      required: true
    },
    logoutUrl: {
      type: String,
      required: true
    },
    isActive: {
      type: Boolean,
      required: true
    }
  }
}
</script>
