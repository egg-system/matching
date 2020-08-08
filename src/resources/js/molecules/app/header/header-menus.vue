<template>
  <div>
    <v-btn
      v-for="menu in menus"
      :key="menu.icon"
      :href="menu.url"
      icon
      color="white"
    >
      <main-icon :icon="menu.icon" />
    </v-btn>
  </div>
</template>

<script>
import mainIcon from '../../../atoms/main-icon'

export default {
  components: { mainIcon },
  props: {
    menus: {
      type: Array,
      required: true
    }
  }
}
</script>
