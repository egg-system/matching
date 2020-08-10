<template>
  <footer class="footer-wrapper">
    <hr />
    <social-icons />
    <footer-menus :menus="menus" />
    <hr />
    <p>© EGG SYSTEM Inc. All Right Reserved.</p>
  </footer>
</template>

<script>
import socialIcons from '../../molecules/landing-page/footer/social-icons'
import footerMenus from '../../molecules/landing-page/footer/menus'

export default {
  components: { socialIcons, footerMenus },
  props: {
    menus: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.footer-wrapper {
  p {
    margin: 1rem 0 1.5rem;
    font-size: 0.8rem;
    width: 100%;
  }
}
</style>
