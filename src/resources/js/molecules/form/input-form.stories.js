import InputForm from './input-form.vue'

export default { title: 'Form/InputForm' };

export const base = () => ({
  components: { InputForm },
  template: `
    <input-form
      label="氏名"
      name="name"
      id="name"
      type="text"
      value="山田太郎"
      autocomplete="name"
      autofocus
    ></input-form>
  `
})

export const error = () => ({
  components: { InputForm },
  template: `
    <input-form
      label="氏名"
      name="name"
      id="name"
      type="text"
      value="山田太郎"
      autocomplete="name"
      autofocus
      error="エラー"
    ></input-form>
  `
})
