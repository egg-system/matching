<template>
  <div @click="transitionDetail" class="historyBox">
    <div class="historyItem">
      <div class="icon">
        <img :src="photo" :alt="name">
      </div>
      <div class="name">{{ name }}</div>
    </div>
    <div class="comment">{{ comment }}</div>
  </div>
</template>

<script>
export default {
  props: {
    transition: {
      type: String,
      required: true
    },
    photo: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    comment: {
      type: String,
      required: true
    },
  },
  methods: {
    transitionDetail () {
      window.location = this.transition;
    }
  }
}
</script>
