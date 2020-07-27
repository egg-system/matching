<script>
import { mapMutations } from 'vuex'

export default {
  render: () => {},
  props: {
    releaseConfigs: {
      type: Object,
      required: true
    }
  },
  methods: {
    ...mapMutations('release', ['setConfigs'])
  },
  created() {
    this.setConfigs(this.releaseConfigs)
  }
}
</script>
