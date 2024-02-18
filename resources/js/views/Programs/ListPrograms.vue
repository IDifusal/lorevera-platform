<template>
  <v-main>
    <v-row class="py-5 px-3">
      <h2>List Programs</h2>
      <v-spacer> </v-spacer>
      <v-btn color="primary" to="/programs/create">
        Create Program
        <v-icon> mdi-pencil </v-icon>
      </v-btn>
    </v-row>
    <v-data-table
      loading-text="Loading ..."
      :headers="headers"
      :options="optionsTable"
      :items="items"
    >
    <template v-slot:item="props">
        <tr>
          <td>
            {{ props.item.id }}
          </td>
          <td>
            {{ props.item.name }}
          </td>
          <td>
            <v-btn
              color="orange"
              fab
              small
              dark
              :to="{ name: 'programs_edit', params: { id: props.item.id } }"
            >
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn
              color="red"
              fab
              small
              dark
              @click="deleteItem(props.item.id)"
            >
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </td>
        </tr>
      </template>
    </v-data-table>
  </v-main>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      items: [],
      headers: [
        { text: "Id", value: "id", sortable: true },
        { text: "Name", value: "name" },
        { text: "Actions", sortable: false },
      ],
      optionsTable: {
        itemsPerPage: 10,
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    getList() {
      try {
        axios.get("programs").then(({ data }) => (this.items = data));
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>