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

      <div class="career-form">
        <div class="career-form-gym-name">
          <div class="career-form-gym-name__heading">企業/ジム名</div>
          <input
            type="text"
            class="career-form-gym-name__input"
            name="gym_name"
            placeholder="〇〇ジム、エニタイム〇〇店など"
          >
        </div>

        <div class="career-form-enrollment">
          <div class="career-form-enrollment-container">
            <div class="career-form-enrollment__heading">在籍期間</div>
            <input
              type="text"
              class="career-form-enrollment__input"
              name="enrollment[start]"
              placeholder="開始日"
            >
            <div class="career-form-enrollment__tilda">〜</div>
            <input
              type="text"
              class="career-form-enrollment__input"
              name="enrollment[end]"
              placeholder="完了日"
            >
          </div>
          <div class="career-form-enrollment-checkbox-wrapper">
            <input type="checkbox" id="ongoing" name="enrollment[ongoing]" class="career-form-enrollment-checkbox">
            <label for="ongoing">今も継続中</label>
          </div>
        </div>

        <div class="career-form-comment">
          <textarea
            class="career-form-comment__textarea"
            name="comment"
            placeholder="〇〇ジムのトレーナーとして２年間従事。笑顔と丁寧な接客を大事にしており、年間１００名の方の健康を支える指導・サポートを行ってきた、また後輩の育成も担当し、３名のトレーナーの育成をサポートした。"
          ></textarea>
        </div>

        <v-btn
          fab
          dark
          color="black"
          class="career-form-remove-btn"
          @click="removeCareerForm"
        >×</v-btn>
      </div>

      <v-btn
        depressed
        tile
        class="form-add-btn"
        @click="addCareerForm"
      >＋経歴を追加</v-btn>
    </div>

    <rounded-btn
      class="next-btn"
      text="次へ"
      @click="moveNext"
    ></rounded-btn>

    <div class="skip-link">
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
  methods: {
    back () {
      this.$emit('back')
    },
    moveNext () {
      this.$emit('moveNext')
    },
    skip () {
      this.$emit('moveNext')
    },
    addCareerForm () {}
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
          display: block;
          width: 100%;
          border-bottom: solid 1px;
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
      right: 7%;
      top: 26%;
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
