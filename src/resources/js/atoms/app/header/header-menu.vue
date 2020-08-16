<template>
  <div
    class="nav-menu-items"
    :class="menu.isActive ? 'active-nav-menu-item' : ''"
  >
    <v-btn depressed text block :href="menu.url" class="pa-6">
      <image-icon :image="menu.image" :is-active="menu.isActive" />
    </v-btn>
  </div>
</template>

<script>
import imageIcon from '../../../atoms/app/header/image-icon'

export default {
  components: { imageIcon },
  props: {
    menu: {
      type: Object,
      required: true
    }
  }
}
</script>
