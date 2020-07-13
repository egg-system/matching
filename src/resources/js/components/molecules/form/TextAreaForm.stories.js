import FormWrapper from './FormWrapper.vue'
import TextAreaForm from './TextAreaForm.vue'

export default { title: 'Form/TextAreaForm' };

export const base = () => ({
  components: { FormWrapper, TextAreaForm },
  template: `<form-wrapper
    label="自己紹介"
    name="pr_comment"
  >
    <text-area-form
      name="pr_comment"
      id="pr_comment"
      placeholder="自己紹介を入れて企業にアピールしよう"
    ></text-area-form>
  </form-wrapper>`
})
