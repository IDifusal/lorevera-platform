<template>
  <div flex>
      <h2>List Days</h2>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="goToAdd()">Add</v-btn>
  </div>
  <v-data-table
      :headers="headers"
      :items="items"
      :items-per-page="100"
      class="elevation-1 pt-5"
  >
      <template v-slot:item="props">
          <tr>
              <td>
                  {{ props.item.id }}
              </td>
              <td>
                  {{ props.item.title }}
              </td>
              <td>
                  <v-btn color="primary" text @click="editItem(props.item)">
                      Edit
                  </v-btn>
                  <v-btn
                      color="error"
                      text
                      @click="deleteItemDialog(props.item.id)"
                  >
                      Delete
                  </v-btn>
              </td>
          </tr>
      </template>
  </v-data-table>
  <v-dialog
    v-model="removeItem.dialog"
    max-width="400"
    persistent
  >

    <v-card
      text="Are you sure you want to delete this item?"
      title="This will delete the item permanently."
    >
      <template v-slot:actions>
        <v-spacer></v-spacer>

        <v-btn @click="removeItem.dialog = false">
          Cancel
        </v-btn>

        <v-btn color="lorevera" @click="deleteItem()">
          Confirm
        </v-btn>
      </template>
    </v-card>
  </v-dialog>       
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
const goToAdd = () => {
  router.push({ name: "cardio-add-day" });
};
const removeItem =ref({
  dialog : false,
  itemid:null
})
const headers = ref([
  {
      title: "id",
      value: "id",
  },
  {
      title: "Name",
      align: "start",
      sortable: false,
      value: "title",
  },
  {
      title: "Actions",
      value: "actions",
      sortable: false,
  },
]);

const items = ref([]);


const editItem = (item) => {
  router.push({ name: "days-edit", params: { id: item.id,item:item } });
};
const deleteItemDialog = (id) => {
  console.log("delete item", id);
  removeItem.value.dialog = true;
  removeItem.value.itemid = id;
};

const deleteItem = async () => {
  const id = removeItem.value.itemid;        
  try {
      await axios.delete(`/api/web/delete-day/${id}`);
      items.value = items.value.filter((item) => item.id !== id);
      removeItem.value.dialog = false;
      removeItem.value.itemid = null;           
  } catch (error) {
      console.error(error);
  }

};
const refreshList = async () => {
  try {
      const { data } = await axios.get("/api/web/list-days-cardio");
      console.log("DATAS",data);
      items.value = data;
  } catch (error) {
      console.error(error);
  }
};
onMounted(async () => {
  await refreshList();
});
</script>
