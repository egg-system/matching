<template>
  <div class="offer-btn">
    <main-btn
      :label="label"
      :disabled="submitting || disabled"
      :hint="hint"
      @click="doOffer"
    />
    <form ref="offerForm" :action="route" method="post">
      <input type='hidden' name='_token' :value="token" />
      <input type='hidden' name='trainer_login_id' :value="trainerId" />
      <input type='hidden' name='gym_login_id' :value="gymId" />
      <input type='hidden' name='offer_state_id' :value="offerStateId" />
    </form>
  </div>
</template>

<script>
import mainBtn from '../../../atoms/main-btn'
export default {
  components: { mainBtn },
  props: {
    label: {
      type: String,
      required: true
    },
    route: {
      type: String,
      required: true
    },
    trainerId: {
      type: String,
      required: true
    },
    gymId: {
      type: String,
      required: true
    },
    offerStateId: {
      type: String,
      requred: true
    },
    disabled: {
      type: Boolean,
      default: false
    },
    hint: {
      type: String,
      default: ''
    }
  },
  data: () => ({
    submitting: false
  }),
  computed: {
    token() {
      return this.$root.$data.token
    }
  },
  methods: {
    doOffer() {
      this.submitting = true
      this.$refs.offerForm.submit()
    }
  }
}
</script>

<style lang="scss" scoped>
  .offer-btn {
    button {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 2rem;
      margin: auto;
    }
  }
</style>
