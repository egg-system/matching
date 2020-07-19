import RangeInputForm from './range-input-form.vue'

export default { title: 'Form/RangeInputForm' };

export const base = () => ({
  components: { RangeInputForm },
  template: `
    <range-input-form
      label="希望単価"
      label-for="price"
      from-id="price"
      from-name="price[min]"
      from-type="number"
      from-value="10000"
      to-name="price[max]"
      to-id="price"
      to-type="number"
      to-value="20000"
    ></range-input-form>
  `
})

export const error = () => ({
  components: { RangeInputForm },
  template: `
    <range-input-form
      label="希望単価"
      label-for="price"
      from-id="price"
      from-name="price[min]"
      from-type="number"
      from-value="10000"
      from-error="最小金額のエラー"
      to-name="price[max]"
      to-id="price"
      to-type="number"
      to-value="20000"
      to-error="最大金額のエラー"
    ></range-input-form>
  `
})
