<template>
  <div>
    <careers-form
      ref="careersForm"
      v-model="careersInput"
      hidden-label
      @validate="setHasError"
    />
    <input type='hidden' name='careers' :value="careersInput">
    <div class="form_footer">
      <main-btn
        label="保存"
        type="submit"
        :disabled="hasError"
      ></main-btn>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import mainBtn from '../../atoms/main-btn'
import {
  parseCareers,
  stringifyCareers,
  careerDefaultValue
} from './careers-form/careers-constants'
import careersForm from './careers-form/careers-form'

export default {
  components: { careersForm, mainBtn },
  props: {
    careers: {
      type: Array,
      required: true
    }
  },
  data: () => ({
    careersInput: null,
    hasError: false
  }),
  computed: {
    careersValue: {
      get() {
        return parseCareers(this.careersInput)
      },
      set(careersValue) {
        this.careersInput = stringifyCareers(careersValue)
      }
    }
  },
  created() {
    this.careersInput = JSON.stringify(this.careers)
  },
  methods: {
    setHasError(hasError) {
      this.hasError = hasError
    }
  }
}
</script>

<style lang="scss" scoped>
.form_footer {
  margin: 2rem 0;
  text-align: center;
}
</style>
