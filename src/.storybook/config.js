import { configure } from '@storybook/vue'
configure(require.context('./../resources/js', true, /.stories.js$/), module)
