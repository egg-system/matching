<template>
  <section class="quesionns-wrapper">
    <h2>よくある質問</h2>
    <ul>
      <template v-for="(question, index) in questions">
        <li :key="question.question">
          <often-question :question="question.question" :answer="question.answer" />
        </li>
        <content-line :key="index" />
      </template>
    </ul>
  </section>
</template>

<script>
import contentLine from '../../atoms/landing-page/content-line'
import oftenQuestion from '../../molecules/landing-page/often-question'
import { questions } from './question-constants'

export default {
  components: { oftenQuestion, contentLine },
  data: () => ({ questions })
} 
</script>

<style lang="scss" scoped>
.quesionns-wrapper {
  margin: 200px 0;

  h2 {
    margin-bottom: 100px;
  }

  ul {
    list-style-type: none; 
  }
}
</style>
