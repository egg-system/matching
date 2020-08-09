<template>
  <v-list>
    <v-list-item
      v-for="menu in menuList"
      :key="menu.name"
      :href="menu.url"
      link
      selectable
    >
      <v-list-item-title>{{ menu.name }}</v-list-item-title>
    </v-list-item>
    <logout-list-item :logout-url="logoutUrl" />
  </v-list>
</template>

<script>
import logoutListItem from '../../../atoms/app/logout-list-item'

export default {
  components: { logoutListItem },
  props: {
    menus: {
      type: Array,
      required: true
    },
    logoutUrl: {
      type: String,
      required: true
    }
  },
  computed: {
    menuList() {
      return this.menus.filter((menu) => {
        if ('isShown' in menu) {
          return menu.isShown
        }

        return true
      })
    }
  }
}
</script>
