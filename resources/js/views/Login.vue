<template>
  <div>
    <v-container class="login" fluid fill-height>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
          <v-card class="elevation-3">
            <v-toolbar dark color="primary">
              <v-toolbar-title>Lorevera Platform Login</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field
                  prepend-icon="mdi-account-edit"
                  class="login-field"
                  name="login"
                  label="Login"
                  type="text"
                  v-model="user.email"
                ></v-text-field>
                <v-text-field
                  id="password"
                  prepend-icon="mdi-lock"
                  name="password"
                  label="Password"
                  type="password"
                  v-model="user.password"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="login()">Login</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
      <v-snackbar v-model="snackbar">
        {{ error }}

        <template v-slot:action="{ attrs }">
          <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
            Close
          </v-btn>
        </template>
      </v-snackbar>
    </v-container>
  </div>
</template>
<script>
import axios from "axios";
import { mapMutations } from "vuex";
export default {
  data() {
    return {
      isLoading: false,
      snackbar: false,
      error: "",
      user: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    ...mapMutations("auth", ["SET_USER"]),
    login() {
      axios
        .post("/auth/login", this.user)
        .then((data) => {
          localStorage.setItem("token", data.data.token);
          axios.defaults.headers.common["Authorization"] =
            "Bearer " + data.token;
          this.$store.commit("SET_USER", data.data);
          this.$store.dispatch("FETCH_USER");
          this.$router.push("/");
        })
        .catch((e) => {
          this.error = e.response.data.message;
          this.snackbar = true;
          this.isLoading = false;
          this.user = {};
        });
    },
  },
};
</script>
<style scoped>
.login {
  width: 100vw;
  height: 100vh;
  position: absolute;
  background: white;
  top: 0px;
  z-index: 999999;
  display: flex;
  place-items: center;
  justify-content: center;
}
input#input-24 {
  border: none;
}
</style>
<style>
.login-field input {
  border: none;
}
</style>