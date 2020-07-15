<template>
  <section>
    <v-row>
      <question-icon />
      <h3>{{ question }}</h3>
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
