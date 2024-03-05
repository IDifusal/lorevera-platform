<template>
    <h2>List Users</h2>
    <v-spacer></v-spacer>
    <v-data-table
        :headers="headers"
        :items="items"
        :items-per-page="5"
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
                    {{ props.item.featured_image_url }}
                </td>
                <td>
                    <v-btn color="primary" text @click="editItem(props.item.id)">
                        Edit
                    </v-btn>
                    <v-btn color="error" text @click="deleteItem(props.item.id)">
                        Delete
                    </v-btn>
                </td>
            </tr>
        </template>
    </v-data-table>

    <v-dialog v-model="dialogEdit" persistent width="500px">
        <v-card class="text-center pa-10">
            <v-card-title> Editing Request {{ activeItem.id }} </v-card-title>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <v-text-field
                    v-model="modifiedProduct.quantity"
                    hide-details
                    single-line
                    type="number"
                />
            </div>
        </v-card>
        <v-btn color="harper" @click="requestEditProduct()">Save Changes</v-btn>
        <v-btn color="primary" block @click="dialogEdit = false"
            >Close Dialog</v-btn
        >
    </v-dialog>    
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from "axios";

const dialogEdit = ref(false);
const headers = ref([
    {
        title: "id",
        value: "id",
    },
    {
        title: "Name",
        align: "start",
        sortable: false,
        value: "name",
    },
    { 
        title: "Register Date",
        value: "created_at" 
    }
]);

const items = ref([]);

onMounted(async () => {
    try {
        const { data } = await axios.get("/api/web/list-users");
        items.value = data.users;
    } catch (error) {
        console.error(error);
    }
});
</script>
