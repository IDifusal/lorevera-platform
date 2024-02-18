<template>
  <v-main>
    <v-row class="py-5 px-3">
      <h2>List Cardio</h2>
      <v-spacer> </v-spacer>
      <v-btn color="primary" to="/cardio/create">
        Create cardio
        <v-icon> mdi-pencil </v-icon>
      </v-btn>
    </v-row>
    <v-data-table
      :headers="headers"
      :items="items"
      :items-per-page="5"
      :options="optionsTable"
      class="elevation-1 pt-5"
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
            {{ props.item.category }}
          </td>
          <td>
            <img v-if="props.item.image != 'null'" :src="props.item.image" width="100" />
          </td>
          <td>
            <v-btn
              color="orange"
              fab
              small
              dark
              :to="{ name: 'cardio_edit', params: { id: props.item.id } }"
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
        { text: "Category", value: "category" },
        { text: "Image", sortable: false },
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
        axios.get("cardio").then(({ data }) => (this.items = data));
      } catch (error) {
        console.log(error);
      }
    },
    editItem(item) {
      this.$router.push(`/cardio/edit/${item.id}`);
    },
    deleteItem(item) {
      this.$swal({
        title: "Are you sure?",
        text: "Yes, Delete Cardio!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.value) {
          try {
            axios.get("/cardio/delete/" + item).then(() => {
              let index = this.items.findIndex((item) => item.id == item);
              this.items.splice(index,1)
                this.$store.commit("SET_SNACKBAR", {
                  show: true,
                  text: "Cardio deleted successfully",
                })              
            });
          } catch (error) {
            console.log(error);
          }
        }
      });
    },
  },
};
</script>