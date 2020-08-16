<template>
  <v-list-item link selectable @click="submit">
    <v-list-item-title>
      <form ref="logout" method="post" :action="logoutUrl">
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
  },
  methods: {
    submit() {
      this.$refs.logout.submit()
    }
  }
}
</script>
