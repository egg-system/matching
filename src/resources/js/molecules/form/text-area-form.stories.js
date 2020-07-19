import TextAreaForm from './text-area-form.vue'

export default { title: 'Form/TextAreaForm' };

export const base = () => ({
  components: { TextAreaForm },
  template: `
    <text-area-form
      label="自己紹介"
      name="pr_comment"
      id="pr_comment"
      placeholder="自己紹介を入れて企業にアピールしよう"
    ></text-area-form>
  `
})

export const error = () => ({
  components: { TextAreaForm },
  template: `
    <text-area-form
      label="自己紹介"
      name="pr_comment"
      id="pr_comment"
      placeholder="自己紹介を入れて企業にアピールしよう"
      error="エラー"
    ></text-area-form>
  `
})
