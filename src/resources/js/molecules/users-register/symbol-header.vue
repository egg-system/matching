<template>
  <div class="symbol-header">
    <a href="javascript:void(0)" @click="back" class="back-link"></a>
    <img src="/images/users-register/symbol.png" class="symbol-image" alt="シンボル" />
  </div>
</template>

<script>
export default {
  methods: {
    back () {
      this.$emit('back')
    }
  }
}
</script>

<style lang="scss">
.symbol-header {
  display: inline-flex;
  .back-link {
    content: "";
    width: 15px;
    height: 15px;
    border-bottom: solid 4px black;
    border-right: solid 4px black;
    transform: rotate(135deg);
    position: absolute;
    margin-top: 15px;
    margin-left: 20px;
    border-radius: 3px;
  }
  .symbol-image {
    width: 40px;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
  }
}
</style>
