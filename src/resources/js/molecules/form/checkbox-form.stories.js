import CheckboxForm from './checkbox-form.vue'

export default { title: 'Form/CheckboxForm' };

export const base = () => ({
  components: { CheckboxForm },
  template: `
    <checkbox-form
      label="休日勤務可能"
      name="is_available_holiday"
      id="is_available_holiday"
      checked="1"
    ></checkbox-form>
  `
})
