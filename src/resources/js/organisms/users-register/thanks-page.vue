<template>
  <div class="thanks-page">
    <v-img src="/images/users-register/finish_background.jpg">
      <div class="thanks-page-main">
        <div class="thanks-page-main__description">
          <h2>お疲れ様でした！</h2>
          <p>
            復業の準備がこれで整いました！<br>
            早速気になったジムにエントリーしてみましょう！
          </p>
        </div>

        <div class="thanks-page-main__image">
          <img src="/images/users-register/finish_background.png" alt="ジムで運動する人々" />
        </div>

        <rounded-btn class="entry-btn" text="早速、ジムに応募する" @click="entry" />
      </div>
    </v-img>
  </div>
</template>

<script>
import roundedBtn from '../../atoms/users-register/rounded-btn'

export default {
  components: { roundedBtn },
  methods: {
    entry () {
      this.$emit('entry')
    }
  }
}
</script>

<style lang="scss" scoped>
.thanks-page {
  &-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    &__description {
      margin: 0 3% 0 7%;
      h2 {
        font-size: 1.5rem;
        margin-top: 80px;
      }
      p {
        font-weight: bold;
        line-height: 1.8rem;
        font-size: 0.85rem;
        margin-top: 18px;
      }
    }
    &__image {
      width: 89%;
    }
    .entry-btn {
      margin-top: 10px;
      font-size: 1.1rem;
    }
  }
}
</style>
