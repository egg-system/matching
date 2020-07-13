import FormWrapper from './FormWrapper.vue'
import SelectForm from './SelectForm.vue'

export default { title: 'Form/SelectForm' };

export const base = () => ({
  components: { FormWrapper, SelectForm },
  data () {
    return {
      occupations: [
        { name: '-- 選択してください --', value: '' },
        { name: 'パーソナル', value: '1' },
        { name: 'ボクシング', value: '2' },
        { name: 'フィットネス', value: '3' }
      ]
    }
  },
  template: `<form-wrapper
    label="業種"
    name="occupation_id"
    subtext="業種"
  >
    <select-form
      name="occupation_id"
      id="occupation"
      :options="occupations"
    ></select-form>
  </form-wrapper>`
})
