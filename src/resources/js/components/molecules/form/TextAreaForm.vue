<template>
    <div class="formItem">
        <label class="formItem__label" :for="name">{{ label }}</label>
        <textarea
            :id="textareaId"
            class="formItem__textarea"
            :class="{ 'formItem__textarea--danger': error }" 
            :name="name"
            :value="value"
            :placeholder="placeholder"
        ></textarea>
        <span v-if="error" class="formItem__text--danger" role="alert">
            <strong>{{ error }}</strong>
        </span>
    </div>
</template>

<script>
export default {
    props: {
        label: { type: String, required: true },
        textareaId: { type: String, default: '' },
        name: { type: String, required: true },
        value: { type: String, required: true },
        placeholder: { type: String, default: '' },
        error: { type: String, default: '' }
    }
}
</script>

<style scoped>
.formItem {
    margin: 0 5% 50px 5%;
}
.formItem__label {
    display: block;
    font-weight: bold;
    font-size: 15px;
    margin-bottom: 50px;
}
.formItem__textarea {
    display: block;
    width: 100%;
    height: 100px;
    resize: none;
    border: none;
    border-bottom: solid 1px;
    font-size: 18px;
}
.formItem__textarea--danger {
    border: solid 2px red;
}
.formItem__text--danger {
    display: block;
    color: red;
    margin-top: 10px;
}
</style>
