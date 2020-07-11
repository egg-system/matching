<template>
    <div class="formWrapper">
        <label class="formLabel" :for="name">{{ label }}</label>
        
        <!-- サブテキストあり -->
        <template v-if="subtext">
            <div class="formContainer">
                <div class="formContainer__subtext">{{ subtext }}</div>
                <div class="formContainer__form">
                    <slot />
                </div>
            </div>
        </template>

        <!-- 範囲系 -->
        <template v-else-if="type === 'range'">
            <div class="rangeFormContainer">
                <div class="rangeFormContainer__form">
                    <slot name="from" />
                </div>
                <div class="rangeFormContainer__tilda">〜</div>
                <div class="rangeFormContainer__form">
                    <slot name="to" />
                </div>
            </div>
        </template>

        <template v-else>
            <slot />
        </template>
        
        <span v-if="error" class="alertText" role="alert">
            <strong>{{ error }}</strong>
        </span>
    </div>
</template>

<script>
export default {
    props: {
        label: { type: String, required: true },
        name: { type: String, required: true },
        subtext: { type: String, default: '' },
        type: { type: String, default: '' },
        error: { type: String, default: '' }
    }
}
</script>

<style scoped>
.formWrapper {
    margin: 0 5% 50px 5%;
}
.formLabel {
    display: block;
    font-weight: bold;
    font-size: 15px;
    margin-bottom: 30px;
}
.formContainer {
    display: flex;
}
.formContainer__subtext {
    flex-basis: 40%;
}
.formContainer__form {
    flex-basis: 60%;
}
.rangeFormContainer {
    display: flex;
}
.rangeFormContainer__tilda {
    flex-basis: 20%;
    text-align: center;
    font-size: 18px;
}
.rangeFormContainer__form {
    flex-basis: 40%;
}
.alertText {
    display: block;
    color: red;
    margin-top: 10px;
}
</style>
