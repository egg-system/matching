<template>
  <div class="form-wrapper">
    <div v-if="!hiddenLabel" class="form-header">
      経歴
    </div>
    <div
      v-for="(career, index) in careers"
      :key="`career-form_${index}`"
      class="career-form"
    >
      <career-inputs
        v-model="careers"
        :index="index"
        ref='careerInputs'
        @validate="validate"
      />
      <v-btn
        fab
        x-small
        dark
        color="black"
        class="career-form-remove-btn"
        @click="removeCareerForm(index)"
      >
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </div>
    <v-btn
      depressed
      tile
      class="form-add-btn"
      @click="addCareerForm"
    >＋経歴を追加</v-btn>
  </div>
</template>

<script>
import {
  careerDefaultValue,
  stringifyCareers,
  parseCareers
} from './careers-constants.js'
import careerInputs from './career-inputs.vue'

export default {
  components: { careerInputs },
  props: {
    value: {
      type: String,
      required: true
    },
    // 編集画面のための暫定対応
    hiddenLabel: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    careers: {
      get() {
        if (!this.value) {
          return null
        }

        return parseCareers(this.value)
      },
      set(careers) {
        const careersValue = stringifyCareers(careers)
        this.$emit('input', careersValue)
      }
    }
  },
  methods: {
    validate() {
      const hasInputError = this.$refs.careerInputs.some(input => {
        return input.hasError
      })

      const hasNoDirtyError = this.careers.some(career => {
        return JSON.stringify(career) === JSON.stringify(careerDefaultValue)
      })

      const hasError = hasNoDirtyError || hasInputError
      this.$emit('validate', hasError)
    },
    addCareerForm() {
      const careers = [...this.careers]
      careers.push({ ...careerDefaultValue })
      this.careers = careers
    },
    removeCareerForm(index) {
      const careers = [...this.careers]
      careers.splice(index, 1)
      this.careers = careers
    }
  }
}
</script>

<style lang="scss" scoped>
@import './careers-form.scss';
</style>
