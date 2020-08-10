<template>
  <section class="question-box">
    <v-row class="question-title">
      <v-col cols="2" align-self="center">
        <question-icon />
      </v-col>
      <v-col cols="10" align-self="center">
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
  margin: 3rem 0 2rem;

  p, h3 {
    text-align: left;
  }

  .question-title {
    /* pタグなどのwidth86%にあわせる */
    margin: 0 7%;

    h3 {
      font-size: 1.2rem;
    }

    .col {
      padding-top: 0;
      padding-bottom: 0;
    }
  }
}
</style>
