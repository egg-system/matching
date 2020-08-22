<template>
  <step-page-wrapper
    headerText="今の勤務地のエリアを教えてください"
    step="1"
    :progress="40"
    @back="back"
  >
    <div class="now-work-area-form" ref="nowWorkAreaForm">
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
          :disabled="area.disabled"
        >{{ area.name }}</option>
      </select>
    </div>

    <main-btn class="next-btn" label="次へ" :disabled="!selectValue" @click="moveNext" />

    <div class="skip-link">
      <a href="javascript:void(0)" @click.prevent="skip">スキップ</a>
    </div>

    <p class="small-text" ref="smallText">あと２ステップ！</p>
  </step-page-wrapper>
</template>

<script>
import ResizeObserver from 'resize-observer-polyfill'
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'
import mainBtn from '../../atoms/main-btn'

export default {
  components: {
    stepPageWrapper,
    mainBtn
  },
  props: {
    areas: { type: Array, required: true }
  },
  data () {
    return {
      selectValue: '',
      observer: null
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
  mounted () {
    this.observer = new ResizeObserver(entries => {
      entries.forEach(({ contentRect }) => {
        const { width, height } = contentRect
        if (width > 0) {
          const smallTextOffsetTop = this.$refs.smallText.offsetTop
          const margin = window.innerHeight > 800 ? '230px' : '115px'
          this.$refs.smallText.style['margin-top'] = `calc(100vh - ${smallTextOffsetTop}px - ${margin})`
        } else {
          this.$refs.smallText.style['margin-top'] = 'auto'
        }
      })
    })
    this.observer.observe(this.$refs.nowWorkAreaForm)
  },
  beforeDestroy () {
    this.observer.disconnect(this.$refs.nowWorkAreaForm)
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
    cursor: pointer;
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
