export default {
  namespaced: true,
  state: {
    releaseConfigs: null
  },
  mutations: {
    setConfigs(state, configs) {
      state.releaseConfigs = configs
    }
  },
  getters: {
    isEnabled(state) {
      return (feature) => {
        if (feature in state.releaseConfigs) {
          return state.releaseConfigs[feature].is_enabled
        }

        throw `feature: ${feature} is undefined`
      }
    }
  }
}
