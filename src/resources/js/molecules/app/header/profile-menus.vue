<template>
  <v-menu>
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <profile-icon />
      </v-btn>
    </template>
  </v-menu>
</template>

<script>
import profileIcon from '../../../atoms/app/profile-icon'

export default {
  components: { profileIcon }
}
</script>
