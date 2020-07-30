<template>
  <step-page-wrapper
    headerText="今の勤務地のエリアを教えてください"
    footerText="あと３ステップ！"
    step="1"
    :progress="40"
    @back="back"
  >
    <div class="contents__form">
      <div class="contents__form-heading">勤務地</div>
      <select
        v-model="selectValue"
        name="now-work-area-id"
        class="select-form"
      >
        <option
          v-for="(area, i) in areas"
          :value="area.value"
          :key="`select-form-option_${i}`"
        >{{ area.name }}</option>
      </select>
    </div>

    <rounded-btn class="contents__btn" text="次へ" :disabled="!selectValue" @click="moveNext" />

    <div class="contents__skip">
      <a href="javascript:void(0)" @click.prevent="skip">スキップ</a>
    </div>
  </step-page-wrapper>
</template>

<script>
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'
import roundedBtn from '../../atoms/users-register/rounded-btn'

export default {
  components: {
    stepPageWrapper,
    roundedBtn
  },
  props: {
    areas: { type: Array, required: true }
  },
  data () {
    return {
      selectValue: ''
    }
  },
  methods: {
    back () {
      this.$emit('back')
    },
    moveNext () {
      this.$emit('moveNext')
    },
    skip () {
      this.$emit('moveNext')
    }
  }
}
</script>

<style lang="scss" scoped>
.contents {
  &__form {
    display: flex;
    margin: 135px 15% 0 15%;
    &-heading {
      flex-basis: 20%;
      margin: auto;
      font-size: 0.9rem;
      color: grey;
    }
    &::after {
      content: "";
      width: 10px;
      height: 10px;
      border-bottom: solid 2px #b4b3b3;
      border-right: solid 2px #b4b3b3;
      transform: rotate(-45deg);
      position: absolute;
      top: 62%;
      right: 19%;
      pointer-events: none;
    }
    .select-form {
      flex-basis: 80%;
      display: block;
      width: 100%;
      border-bottom: solid 1px;
      font-size: 1.2em;
      padding-bottom: 5px;
      margin: 0 10px;
    }
  }
  &__skip {
    text-align: center;
    margin-top: 20px;
    font-size: 0.9rem;
    a {
      text-decoration: none;
      color: grey;
    }
  }
  &__btn {
    display: block;
    margin: 40px auto 0 auto;
  }
}
</style>
