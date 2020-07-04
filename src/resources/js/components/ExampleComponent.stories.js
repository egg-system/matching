import Vue from 'vue';
import ExampleComponent from './ExampleComponent.vue'

export default { title: 'ExampleComponent' };

export const asAComponent = () => ({
    components: { ExampleComponent },
    template: '<example-component />'
})
