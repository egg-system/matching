<template>
  <div class="start-page-wrapper">
    <div class="contents">
      <v-img src="/images/users-register/top_background.jpg">
        <div class="contents__header">
          <v-img src="/images/users-register/top_logo.jpg" max-width="48%" />
        </div>

        <div class="contents__container">
          <div class="contents__description">
            <h2>
              さぁ、<br>
              新しいジムとの出会いへ！
            </h2>

            <p>
              BorderlessGYMはジムトレーナーの方の<br>
              複業・副業をサポートするマッチングプラット<br>
              フォームです。
            </p>
            <p>
              プロフィールを入力することでジムにエントリー<br>
              することができるようになります。
            </p>
            <p>
              思わずあなたに声をかけたくなるような<br>
              魅力的なプロフィールを作成していきましょう！
            </p>
          </div>

          <rounded-btn class="contents__btn" text="はじめる" @click="moveNext" />
        </div>
      </v-img>
    </div>
  </div>
</template>

<script>
import roundedBtn from '../../atoms/users-register/rounded-btn'

export default {
  components: { roundedBtn },
  methods: {
    moveNext () {
      this.$emit('moveNext')
    }
  }
}
</script>

<style lang="scss" scoped>
.contents__header {
  padding: 10px 0 0 10px;
}
.contents__container {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}
.contents__description {
  margin: 0 1% 30px 7%;
  h2 {
    font-size: 1.8rem;
    margin-top: 80px;
    margin-bottom: 25px;
  }
  p {
    font-weight: bold;
    line-height: 1.8rem;
    font-size: 0.85rem;
    padding: 10px;
    margin: auto;
  }
  @media screen and (min-width: 768px) {
    h2 {
      font-size: 3rem;
    }
    p {
      line-height: 4rem;
      font-size: 1.5rem;
    }
  }
}
</style>
