<template>
  <v-main>
    <h2>List Users</h2>
    <v-spacer></v-spacer>
    <v-data-table
      :headers="headers"
      :items="users"
      :items-per-page="5"
      class="elevation-1 pt-5"
    ></v-data-table>
  </v-main>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      headers: [
        {
          text: "id",
          value: "id",
        },
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Register Date", value: "created_at" },
        { text: "Phone", value: "phone" },
        { text: "Email", value: "email" },
      ],
      users: [],
    };
  },
  created() {
    try {
      axios.get("/users").then(({ data }) => (this.users = data));
    } catch (error) {
      console.table(error);
    }
  },
};
</script>