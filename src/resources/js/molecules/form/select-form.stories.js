import SelectForm from './select-form.vue'

export default { title: 'Form/SelectForm' };

const occupations = [
  { name: '-- 選択してください --', value: '' },
  { name: 'パーソナル', value: '1' },
  { name: 'ボクシング', value: '2' },
  { name: 'フィットネス', value: '3' }
]

export const base = () => ({
  components: { SelectForm },
  data () {
    return { occupations }
  },
  template: `
    <select-form
      label="業種"
      sublabel="業種"
      name="occupation_id"
      id="occupation"
      :options="occupations"
    ></select-form>
  `
})

export const error = () => ({
  components: { SelectForm },
  data () {
    return { occupations }
  },
  template: `
    <select-form
      label="業種"
      sublabel="業種"
      name="occupation_id"
      id="occupation"
      :options="occupations"
      error="エラー"
    ></select-form>
  `
})
