import FormWrapper from './form-wrapper.vue'
import InputForm from './input-form.vue'

export default { title: 'Form/InputForm' };

export const base = () => ({
  components: { FormWrapper, InputForm },
  template: `<form-wrapper
    label="氏名"
    name="name"
  >
    <input-form
      name="name"
      id="name"
      type="text"
      value="山田太郎"
      autocomplete="name"
      autofocus
    ></input-form>
  </form-wrapper>`
})
