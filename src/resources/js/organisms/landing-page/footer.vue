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
import socialIcons from '../../moleclues/landing-page/footer/social-icons'
import footerMenus from '../../moleclues/landing-page/footer/menus'

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
    margin: 35px 0 60px;
    font-size: 30px;
    width: 100%;
  }
}
</style>
