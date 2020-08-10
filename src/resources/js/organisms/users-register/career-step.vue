<template>
  <step-page-wrapper
    headerText="プロフィールを入力してください"
    headerSubText="プロフィールを充実させると<br>マッチングしやすくなります！"
    step="3"
    :progress="80"
    @back="back"
  >

    <div class="form-wrapper">
      <div class="form-header">経歴</div>

      <div class="career-form" v-for="(career, i) in careerValues" :key="`career-form_${i}`">
        <div class="career-form-gym-name">
          <div class="career-form-gym-name__heading">企業/ジム名</div>
          <input
            v-model="career.gymName"
            type="text"
            class="career-form-gym-name__input"
            placeholder="〇〇ジム、エニタイム〇〇店など"
          >
        </div>

        <div class="career-form-enrollment">
          <div class="career-form-enrollment-container">
            <div class="career-form-enrollment__heading">在籍期間</div>
            <div class="career-form-enrollment__input" :class="{ 'career-form-enrollment__input--danger': errors[i].enrollmentStart }">
              <input
                v-model="career.enrollmentStart"
                type="text"
                placeholder="開始日"
              >
              <span v-if="errors[i].enrollmentStart">{{ errors[i].enrollmentStart }}</span>
            </div>
            <div class="career-form-enrollment__tilda">〜</div>
            <div class="career-form-enrollment__input" :class="{ 'career-form-enrollment__input--danger': errors[i].enrollmentEnd }">
              <input
                v-model="career.enrollmentEnd"
                type="text"
                placeholder="完了日"
              >
              <span v-if="errors[i].enrollmentEnd">{{ errors[i].enrollmentEnd }}</span>
            </div>
          </div>
          <div class="career-form-enrollment-checkbox-wrapper">
            <input
              v-model="career.enrollmentOngoing"
              type="checkbox"
              :id="`ongoing_${i}`"
              class="career-form-enrollment-checkbox"
            >
            <label :for="`ongoing_${i}`">今も継続中</label>
          </div>
        </div>

        <div class="career-form-comment">
          <textarea
            v-model="career.comment"
            class="career-form-comment__textarea"
            placeholder="〇〇ジムのトレーナーとして２年間従事。笑顔と丁寧な接客を大事にしており、年間１００名の方の健康を支える指導・サポートを行ってきた、また後輩の育成も担当し、３名のトレーナーの育成をサポートした。"
          ></textarea>
        </div>

        <v-btn
          v-if="careerValues.length > 1"
          fab
          dark
          color="black"
          class="career-form-remove-btn"
          @click="removeCareerForm(i)"
        >×</v-btn>
      </div>

      <v-btn
        depressed
        tile
        class="form-add-btn"
        @click="addCareerForm"
      >＋経歴を追加</v-btn>
    </div>

    <main-btn
      class="next-btn"
      label="次へ"
      @click="moveNext"
      :disabled="isError"
    ></main-btn>

    <div class="skip-link">
      <a href="javascript:void(0)" @click.prevent="skip">スキップ</a>
    </div>

    <!-- DBのカラム名が"carrer"なので合わせる（多分typo） -->
    <input type="hidden" name="carrer" :value="careerValuesStr">
  </step-page-wrapper>
</template>

<script>
import stepPageWrapper from '../../molecules/users-register/step-page-wrapper'
import mainBtn from '../../atoms/users-register/main-btn'

const CAREER_DEFAULT_VALUE = {
  gymName: '',
  enrollmentStart: '',
  enrollmentEnd: '',
  enrollmentOngoing: false,
  comment: ''
}

export default {
  components: {
    stepPageWrapper,
    mainBtn
  },
  data () {
    return {
      careerValues: [{ ...CAREER_DEFAULT_VALUE }],
      errors: [{ ...CAREER_DEFAULT_VALUE }],
      isError: false
    }
  },
  computed: {
    careerValuesStr () {
      const formatted = this.careerValues.map(value => {
        return {
          gym_name: value.gymName,
          comment: value.comment,
          enrollment: {
            start: value.enrollmentStart,
            end: value.enrollmentEnd,
            ongoing: Number(value.enrollmentOngoing)
          }
        }
      })
      return JSON.stringify(formatted)
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
      this.careerValues = [{ ...CAREER_DEFAULT_VALUE }] // リセット
      this.$emit('moveNext')
    },
    addCareerForm () {
      this.careerValues.push({ ...CAREER_DEFAULT_VALUE })
      this.errors.push({ ...CAREER_DEFAULT_VALUE })
    },
    removeCareerForm (index) {
      this.careerValues.splice(index, 1)
      this.errors.splice(index, 1)
    },
    validateDate (value) {
      if (!value) return true
      if (!/[0-9]{4}\/[0-9]{2}/.test(value)) return false
      const year = value.slice(0, 4)
      const month = value.slice(5, 7)
      const now = new Date()
      if (parseInt(year) < now.getFullYear()) return true
      return parseInt(year) === now.getFullYear() && parseInt(month) <= now.getMonth() + 1
    }
  },
  watch: {
    careerValues: { 
      handler (newValue) {
        // バリデーション
        this.isError = false
        newValue.forEach((value, i) => {
          const _enrollmentStart = value.enrollmentStart
          this.errors[i].enrollmentStart = ''
          if (!this.validateDate(_enrollmentStart)) {
            this.errors[i].enrollmentStart = '\"〇〇〇〇/△△\"で過去の日付を入力してください'
            this.isError = true
          }

          const _enrollmentEnd = value.enrollmentEnd
          this.errors[i].enrollmentEnd = ''
          if (!this.validateDate(_enrollmentEnd)) {
            this.errors[i].enrollmentEnd = '\"〇〇〇〇/△△\"で過去の日付を入力してください'
            this.isError = true
          }
        })
      },
      deep: true
    }
  }
}
</script>

<style lang="scss" scoped>
.form-wrapper {
  margin: 0 5%;
  .form-header {
    color: grey;
    font-size: 0.9rem;
    margin-left: 3px;
  }
  .career-form {
    margin-top: 20px;
    padding: 7% 8% 7% 4%;
    background-color: seashell;
    font-size: 0.85rem;
    position: relative;
    &-gym-name {
      display: flex;
      &__heading {
        flex-basis: 30%;
      }
      &__input {
        flex-basis: 70%;
        display: block;
        width: 100%;
        border-bottom: solid 1px;
      }
    }
    &-enrollment {
      margin-top: 15px;
      &-container {
        display: flex;
        .career-form-enrollment__heading {
          flex-basis: 30%;
        }
        .career-form-enrollment__input {
          flex-basis: 28%;
          input {
            display: block;
            width: 100%;
            border-bottom: solid 1px;
          }
          span {
            font-size: 0.7rem;
            font-weight: bold;
            color: red;
          }
          &--danger input {
            border: solid 2px red;
          }
        }
        .career-form-enrollment__tilda {
          flex-basis: 14%;
          text-align: center;
        }
      }
      &-checkbox-wrapper {
        text-align: right;
        margin: 12px -10px 0 0px;
        font-size: 0.7rem;
        .career-form-enrollment-checkbox {
          display: none;
          &+label {
            display: none;
            cursor: pointer;
            display: inline-block;
            position: relative;
            padding-left: 30px;
            padding-right: 10px;
            &::before {
              content: "";
              position: absolute;
              display: block;
              box-sizing: border-box;
              width: 15px;
              height: 15px;
              left: 8px;
              border: 1px solid;
              border-color: gray;
              border-radius: 25%;
              background: white;
            }
          }
          &:checked+label::before {
            background-color: gray;
          }
          &:checked+label::after {
            content: "";
            position: absolute;
            display: block;
            box-sizing: border-box;
            width: 11px;
            height: 5px;
            margin-top: -4px;
            top: 50%;
            left: 10px;
            transform: rotate(-45deg);
            border-bottom: 2px solid;
            border-left: 2px solid;
            border-color: #FFF;
          }
        }
      }
    }
    &-comment {
      margin-top: 25px;
      &__textarea {
        display: block;
        width: 100%;
        height: 108px;
        resize: none;
        border: none;
        border-bottom: solid 1px;
        line-height: 1.9rem;
      }
    }
    &-remove-btn {
      width: 25px;
      height: 25px;
      font-size: 1.3rem;
      align-items: center;
      padding-bottom: 3px;
      position: absolute;
      right: 2%;
      top: -5%;
    }
  }
  .form-add-btn {
    margin-top: 20px;
    width: 40%;
    height: 45px;
    font-size: 0.85rem;
    font-weight: bold;
    padding-right: 35px;
    color: maroon;
    background-color: lavenderblush !important;
  }
}
.next-btn {
  display: block;
  margin: 32px auto 0 auto;
}
.skip-link {
  text-align: center;
  margin: 20px 0 80px 0;
  font-size: 0.9rem;
  a {
    text-decoration: none;
    color: grey;
  }
}
</style>
