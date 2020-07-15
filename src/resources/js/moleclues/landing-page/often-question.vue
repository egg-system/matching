<template>
  <section class="question-box">
    <v-row class="question-title">
      <v-col cols="1" align-self="center">
        <question-icon />
      </v-col>
      <v-col align-self="center">
        <h3>{{ question }}</h3>
      </v-col>
    </v-row>
    <p>{{ answer }}</p>
  </section>
</template>

<script>
import questionIcon from '../../atoms/landing-page/question-icon'

export default {
  components: { questionIcon },
  props: {
    question: {
      type: String,
      required: true
    },
    answer: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.question-box {
  margin: 100px 0;

  .question-title {
    /* pタグなどのwidth90%にあわせる */
    margin: 0 5%;

    h3 {
      padding-left: 10px;
      font-size: 40px;
    }
  }
}
</style>
