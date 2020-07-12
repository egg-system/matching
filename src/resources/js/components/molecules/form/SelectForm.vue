<template>
    <select
        :id="id"
        :name="name"
        class="selectForm"
        :class="{ 'selectForm--danger': error }" 
    >
        <option
          v-for="(option, i) in options"
          :value="option.value"
          :key="`select_${i}`"
          :selected="String(option.value) === selected"
        >{{ option.name }}</option>
    </select>
</template>

<script>
export default {
    props: {
        name: { type: String, required: true },
        id: { type: String, default: '' },
        options: { type: Array, required: true },
        selected: { type: String, default: '' },
        error: { type: String, default: '' }
    }
}
</script>

<style scoped>
.selectForm {
    display: block;
    width: 100%;
    border: none;
    border-bottom: solid 1px;
    font-size: 1.3rem;
    padding-bottom: 5px;
}
.selectForm--danger {
    border: solid 2px red;
}
</style>
