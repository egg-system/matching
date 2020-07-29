<template>
  <step-page-wrapper
    headerText="今の職種を選択してください"
    headerSubText="複数選択可能"
    footerText="あと４ステップ！"
    step="1"
    :progress="30"
    @back="back"
  >
    <div class="contents__form">
      <template v-for="(occupation, i) in occupations">
        <div
          v-if="occupation.img"
          :key="`contents__form-container_${i}`"
          class="contents__form-container"
          :class="{ 'contents__form-container--selected': selectedValues.includes(occupation.value) }"
          @click="onClickOccupation(occupation.value)"
        >
          <img :src="occupation.img" :alt="occupation.name" class="contents__form-img">
          <p class="contents__form-text">{{ occupation.name }}</p>
        </div>
      </template>

      <input type="hidden" name="occupation_ids" :value="selectedValues">
    </div>

    <rounded-btn class="contents__btn" text="次へ" :disabled="!selectedValues.length" @click="onClickNext" />
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
    occupations: { type: Array, required: true }
  },
  data () {
    return {
      selectedValues: []
    }
  },
  methods: {
    back () {
      this.$emit('back')
    },
    onClickOccupation (value) {
      if (!this.selectedValues.includes(value)) {
        this.selectedValues.push(value)
      } else {
        this.selectedValues = this.selectedValues.filter(selectedValue => selectedValue !== value)
      }
    },
    onClickNext () {
      this.$emit('click')
    }
  }
}
</script>

<style lang="scss" scoped>
.contents__form {
  display: flex;
  text-align: center;
  margin-top: 45px;
  padding: 0 10%;
  &-img {
    max-width: 50%;
    margin: auto;
    border: solid 2px lightgrey;
  }
  &-container--selected .contents__form-img {
    border: solid 2px red;
  }
  &-text {
    font-size: 0.8rem;
    margin-top: 10px;
  }
}
.contents__btn {
  display: block;
  margin: 37px auto 0 auto;
}
</style>
