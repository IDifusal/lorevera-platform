<template>
  <div>
    <v-app-bar elevation="4" class="primary header">
      <router-link to="/"> Lorevera Platform </router-link>
    </v-app-bar>
    <v-navigation-drawer
      class="deepgrey lighten-2"
      dark
      permanent
      fixed
      clipped
      app
      hide-overlay
    >
      <div class="spacer-nav"></div>
      <v-list>
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
          :class="item.link == actualRoute ? 'active ' : ''"
          :to="item.link"
        >
          <v-list-item-icon>
            <v-icon :color="actualRoute == item.link ? 'black' : 'white'">{{
              item.icon
            }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title
              :class="actualRoute == item.link ? 'black--text' : 'text--white'"
            >
              {{ item.title }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <template v-slot:append>
        <div class="pa-2" @click="closeSesion()">
          <v-btn block> Logout </v-btn>
        </div>
      </template>
    </v-navigation-drawer>
        <v-snackbar
      v-model="showSnackBar.show"
    >
      {{ showSnackBar.text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="pink"
          text
          v-bind="attrs"
          @click="closeSnackbar"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  data() {
    return {
      drawer: true,
      items: [
        { title: "Users", icon: "mdi-account-check", link: "/users" },
        { title: "Sales", icon: "mdi-sale", link: "/sales" },
        {
          title: "Nutrition",
          icon: "mdi-file-presentation-box",
          link: "/recipes",
        },
        {
          title: "Programs",
          icon: "mdi-weight-kilogram",
          link: "/programs",
        },  
        {
          title: "Recipes",
          icon: "mdi-file-presentation-box",
          link: "/recipesNew",
        },        
        {
          title: "Technical Support",
          icon: "mdi-headset",
          link: "/support",
        },
      ],
    };
  },
  methods: {
    closeSesion() {
      this.$store.commit("LOGOUT");
    },
    closeSnackbar(){
      this.$store.commit("SET_SNACKBAR",{show:false,text:''})
    }
  },
  computed: {
    actualRoute() {
      return this.$route.path;
    },
    showSnackBar(){
      return this.$store.getters.getSnackBar
    }
  },
};
</script>
<style scoped>
a {
  color: white !important;
  text-decoration: none;
}
.navbar {
  padding: 30px 10px;
}
.header {
  z-index: 99;
}
.spacer-nav {
  height: 70px;
}
.v-list-item.v-list-item--link.theme--dark.active {
  background: white;
}
.v-list-item.v-list-item--link.theme--dark.active a {
  color: black !important;
}
</style>