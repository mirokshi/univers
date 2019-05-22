<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title>Univers</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="avatar">
        </v-avatar>
    </v-toolbar>
</template>

<script>
export default {
  name: 'Toolbar',
  data () {
    return {
      // userAvatar: window.laravel_user.gravatar
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
<style scoped>
</style>
