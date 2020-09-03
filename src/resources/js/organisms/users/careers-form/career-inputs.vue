<template>
  <div>
    <div class="career-form-gym-name">
      <div class="career-form-gym-name__heading">企業/ジム名</div>
      <input
        v-model="gymName"
        type="text"
        class="career-form-gym-name__input"
        placeholder="〇〇ジム、エニタイム〇〇店など"
      >
    </div>

    <div class="career-form-enrollment">
      <div class="career-form-enrollment-container">
        <div class="career-form-enrollment__heading">
          在籍期間
        </div>
        <div
          class="career-form-enrollment__input"
          :class="{
            'career-form-enrollment__input--danger': !!startAtError
          }"
        >
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <input
                v-model="startAt"
                type="text"
                placeholder="開始日"
                v-on="on"
              >
              <span v-if="!!startAtError">
                {{ startAtError }}
              </span>
            </template>
            <v-date-picker
              v-model="startAtDate"
              type="month"
              no-title
              scrollable
              locale="ja"
            >
              <v-spacer />
              <v-btn text color="primary" class="mx-4" @click="startAtDate = null">
                クリア
              </v-btn>
            </v-date-picker>
          </v-menu>
        </div>
        <div class="career-form-enrollment__tilda">〜</div>
        <div
          class="career-form-enrollment__input"
          :class="{
            'career-form-enrollment__input--danger': !!endAtError
          }"
        >
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <input
                v-model="endAt"
                type="text"
                placeholder="完了日"
                v-on="on"
              >
              <span v-if="!!endAtError">
                {{ endAtError }}
              </span>
            </template>
            <v-date-picker
              v-model="endAtDate"
              type="month"
              no-title
              scrollable
              locale="ja"
            >
              <v-spacer />
              <v-btn text color="primary" class="mx-4" @click="endAtDate = null">
                クリア
              </v-btn>
            </v-date-picker>
          </v-menu>
        </div>
      </div>
      <div class="career-form-enrollment-checkbox-wrapper">
        <input
          v-model="inOffice"
          type="checkbox"
          :id="`ongoing_${index}`"
          class="career-form-enrollment-checkbox"
        >
        <label :for="`ongoing_${index}`">今も継続中</label>
      </div>
    </div>
    <div class="career-form-comment">
      <textarea
        v-model="description"
        class="career-form-comment__textarea"
        placeholder="〇〇ジムのトレーナーとして２年間従事。笑顔と丁寧な接客を大事にしており、年間１００名の方の健康を支える指導・サポートを行ってきた。"
      ></textarea>
    </div>
  </div>
</template>

<script>
import { validateCareer, validateDate } from './careers-constants.js'

export default {
  props: {
    value: {
      type: Array,
      required: true
    },
    index: {
      type: Number,
      required: true
    }
  },
  computed: {
    career: {
      get() {
        return this.value[this.index]
      },
      set(career) {
        const careers = [...this.value]
        careers[this.index] = career
        this.$emit('input', careers)
      }
    },
    inOffice: {
      get() {
        return this.career.inOffice
      },
      set(inOffice) {
        const career = { ...this.career }
        career.inOffice = inOffice
        this.career = career
      }
    },
    gymName: {
      get() {
        return this.career.gymName
      },
      set(gymName) {
        const career = { ...this.career }
        career.gymName = gymName
        this.career = career
      }
    },
    startAtDate: {
      get() {
        return this.startAt ? this.startAt.replace('/', '-') : null
      },
      set(date) {
        this.startAt = date ? date.replace('-', '/') : null
      }
    },
    startAt: {
      get() {
        return this.career.startAt
      },
      set(startAt) {
        const career = { ...this.career }
        career.startAt = startAt
        this.career = career
      }
    },
    endAt: {
      get() {
        return this.career.endAt
      },
      set(endAt) {
        const career = { ...this.career }
        career.endAt = endAt
        this.career = career
      }
    },
    endAtDate: {
      get() {
        return this.endAt ? this.endAt.replace('/', '-') : null
      },
      set(date) {
        this.endAt = date ? date.replace('-', '/') : null
      }
    },
    description: {
      get() {
        return this.career.description
      },
      set(description) {
        const career = { ...this.career }
        career.description = description
        this.career = career
      }
    },
    startAtError() {
      return validateDate(this.startAt)
    },
    endAtError() {
      return validateDate(this.endAt)
    },
    hasError() {
      return !validateCareer(this.career)
    }
  },
  watch: {
    career() {
      this.$emit('validate')
    }
  },
  methods: {
    validateDate
  }
}
</script>

<style lang="scss" scoped>
@import './careers-form.scss';
</style>
