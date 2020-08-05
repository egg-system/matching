<template>
  <step-page-wrapper
    headerText="今の勤務地のエリアを教えてください"
    step="1"
    :progress="40"
    @back="back"
  >
    <div class="now-work-area-form">
      <div class="now-work-area-form__heading">勤務地</div>
      <select
        v-model="selectValue"
        name="now_work_area_id"
        class="now-work-area-form__select"
      >
        <option
          v-for="(area, i) in areas"
          :value="area.value"
          :key="`now-work-area-form__select_${i}`"
        >{{ area.name }}</option>
      </select>
    </div>

    <rounded-btn class="next-btn" text="次へ" :disabled="!selectValue" @click="moveNext" />

    <div class="skip-link">
      <a href="javascript:void(0)" @click.prevent="skip">スキップ</a>
    </div>

    <p class="small-text" ref="smallText">あと３ステップ！</p>
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
    isShown: { type: Boolean, default: false },
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
      this.selectValue = '' // リセット
      this.$emit('moveNext')
    }
  },
  watch: {
    isShown (newValue) {
      if (newValue) {
        const smallTextOffsetTop = this.$refs.smallText.offsetTop
        this.$refs.smallText.style['margin-top'] = `calc(100vh - ${smallTextOffsetTop}px - 115px)`
      } else {
        this.$refs.smallText.style['margin-top'] = 'auto'
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.now-work-area-form {
  display: flex;
  margin: 135px 20% 0 13%;
  &__heading {
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
    pointer-events: none;
    margin-top: 14px;
  }
  &__select {
    flex-basis: 80%;
    display: block;
    width: 100%;
    border-bottom: solid 1px;
    font-size: 1.2em;
    padding-bottom: 5px;
    margin-right: -15px;
  }
}
.next-btn {
  display: block;
  margin: 40px auto 0 auto;
}
.skip-link {
  text-align: center;
  margin-top: 20px;
  font-size: 0.9rem;
  a {
    text-decoration: none;
    color: grey;
  }
}
.small-text {
  font-size: 0.8rem;
  text-align: center;
}
</style>
