<template>
  <div class="steps-footer">
    <v-progress-linear
      :value="progress"
      :background-opacity="0"
      color="rgba(180, 0, 90, 1)"
    ></v-progress-linear>

    <ol class="steps">
      <step-item number="1" text="今の仕事について" :current="parseInt(step, 10) >= 1" />
      <step-item number="2" text="働き方について" :current="parseInt(step, 10) >= 2" />
      <step-item number="3" text="プロフィール入力" :current="parseInt(step, 10) >= 3" />
    </ol>
  </div>
</template>

<script>
import stepItem from '../../atoms/users-register/step-item'

export default {
  components: {
    stepItem
  },
  props: {
    step: { type: String, default: '1' },
    progress: { type: Number, default: 10 }
  }
}
</script>

<style lang="scss" scoped>
.steps-footer {
  padding: 10px 0;
  background: white;
  .v-progress-linear__determinate {
    border-radius: 20px;
  }
  .steps {
    display: flex;
    justify-content: space-around;
    padding: 0 5%;
    margin-top: 5px;
  }
}
</style>
