<template>
  <v-list-item link selectable>
    <v-list-item-title>
      <form method="post" :action="logoutUrl">
        <input type="hidden" name="_token" :value="token">
        <input type="submit" value="ログアウト">
      </form>
    </v-list-item-title>
  </v-list-item>
</template>

<script>
export default {
  props: {
    logoutUrl: {
      type: String,
      required: true
    }
  },
  computed: {
    token() {
      return this.$root.$data.token
    }
  }
}
</script>
