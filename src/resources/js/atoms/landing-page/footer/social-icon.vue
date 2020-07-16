<template>
  <v-btn
    :href="url"
    :ripple="false"
    :data-url="url"
    fab
    color="white"
    outlined
  >
    <v-icon color="#333" size="150">
      {{ icon }}
    </v-icon>
  </v-btn>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    },
    url: {
      type: String,
      required: true
    }
  }
}
</script>
