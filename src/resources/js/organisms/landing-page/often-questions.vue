<template>
  <section>
    <h2>よくある質問</h2>
    <ol>
      <template v-for="(question, index) in questions">
        <li :key="question.question">
          <often-question :question="question.question" :answer="question.answer" />
        </li>
        <content-line :key="index" />
      </template>
    </ol>
  </section>
</template>

<script>
import contentLine from '../../atoms/landing-page/content-line'
import oftenQuestion from '../../moleclues/landing-page/often-question'
import { questions } from './question-constants'

export default {
  components: { oftenQuestion, contentLine },
  data: () => ({ questions })
} 
</script>
