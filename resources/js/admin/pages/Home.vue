<template>
  <div class="home">
    <span>{{ msg }}</span>
  </div>
</template>

<script>
export default {

  name: 'home',

  data () {
    return {
      msg: 'Welcome to Admin App'
    }
  },
  mounted() {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
