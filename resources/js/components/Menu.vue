<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <router-link :to="{name: 'home'}" class="navbar-brand">Laravel + JWT + Vue JS</router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto" v-if="!isLoggedIn">
        <li class="nav-item">
          <router-link :to="{ name : 'register' }" key="register" class="nav-link">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name : 'login' }" key="login" class="nav-link">Login</router-link>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="isLoggedIn">
        <li class="nav-item">
          <a class="nav-link" href="#" @click.prevent="handleLogout()">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isLoggedIn"])
  },
  data() {
    return {
      routes: {
        // LOGGED USER
        user: [{ name: "Dashboard", path: "dashboard" }],
        // LOGGED ADMIN
        admin: [{ name: "Dashboard", path: "admin.dashboard" }]
      }
    };
  },
  methods: {
    handleLogout() {
      this.$store
        .dispatch("logout")
        .then(() => this.$router.push("/"))
        .catch(err => console.log(err));
    }
  },
  mounted() {
    //
  }
};
</script>

<style>
.navbar {
  margin-bottom: 30px;
}
</style>
