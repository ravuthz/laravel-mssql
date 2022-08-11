<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">Login</div>
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
              <p v-if="error == 'login_error'">Validation Errors.</p>
              <p v-else>Error, unable to connect with these credentials.</p>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="user@example.com"
                  v-model="user.email"
                  required
                >
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  v-model="user.password"
                  required
                >
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user: {
        email: "ravuthz@gmail.com",
        password: "123123"
      },
      error: "",
      success: false,
      has_error: false
    };
  },
  mounted() {
    //
  },
  methods: {
    login() {
      this.$store
        .dispatch("login", this.user)
        .then(() => this.$router.push("/dashboard"))
        .catch(err => console.log(err));

      // get the redirect object
      //   var redirect = this.$auth.redirect();
      var app = this;
      //   this.$auth.login({
      //     data: {
      //       email: app.email,
      //       password: app.password
      //     },
      //     success: function() {
      //       // handle redirection
      //       app.success = true;
      //       const redirectTo = "dashboard";
      //       this.$router.push({ name: redirectTo });
      //     },
      //     error: function() {
      //       app.has_error = true;
      //       app.error = res.response.data.error;
      //     },
      //     rememberMe: true,
      //     fetchUser: true
      //   });
    }
  }
};
</script>
