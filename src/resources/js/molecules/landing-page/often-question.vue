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

  p, h3 {
    text-align: left;
  }

  .question-title {
    /* pタグなどのwidth86%にあわせる */
    margin: 0 7%;

    h3 {
      padding-left: 10px;
      font-size: 50px;
    }
  }
}
</style>
