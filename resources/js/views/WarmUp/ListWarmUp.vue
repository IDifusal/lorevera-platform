<template>
    <div flex>
        <h2>List Equipment</h2>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="openDialogAdd()">Add</v-btn>
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
                    {{ props.item.name }}
                </td>
                <td>
                    <img
                        style="width: 80px; height: 80px; object-fit: contain"
                        :src="returnImagePath(props.item.featured_image_url)"
                        alt=""
                    />
                </td>
                <td>
                    <v-btn color="primary" text @click="editItem(props.item)">
                        Edit
                    </v-btn>
                    <v-btn
                        color="error"
                        text
                        @click="deleteItem(props.item.id)"
                    >
                        Delete
                    </v-btn>
                </td>
            </tr>
        </template>
    </v-data-table>

    <v-dialog v-model="dialogAdd" persistent width="500px">
        <v-card class="text-center pa-10">
            <v-card-title>Creating new Item</v-card-title>
            <div class="form-group">
                <label for="quantity">Name:</label>
                <v-text-field v-model="newItem.name" hide-details single-line />
                <label for="quantity">Image:</label>
                <UploadImage @cleanImg="clearImg" @changed="onFileChange" />
            </div>
        </v-card>
        <v-btn color="harper" @click="createNewItem()">Save Changes</v-btn>
        <v-btn color="primary" block @click="dialogAdd = false"
            >Close Dialog</v-btn
        >
    </v-dialog>

    <v-dialog v-model="dialogEdit" persistent width="500px">
        <v-card class="text-center pa-10">
            <v-card-title> Editting Item {{ editingItem.name }} </v-card-title>
            <div class="form-group">
                <label for="quantity">Name:</label>
                <v-text-field
                    v-model="editingItem.name"
                    hide-details
                    single-line
                    type="text"
                />
                <label for="quantity">Image:</label>
                <template v-if="editingItem.featured_image_url">
                    <img
                        style="width: 80px; height: 80px; object-fit: contain"
                        :src="returnImagePath(editingItem.featured_image_url)"
                        alt=""
                    />
                    <svg @click="removeImageEdit()" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="red" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg>
                </template>
                <template v-else>
                    <UploadImage @cleanImg="clearImg" @changed="onFileChange" :max="1" />
                </template>
            </div>
        </v-card>
        <v-btn color="harper" @click="requestEditProduct()">Save Changes</v-btn>
        <v-btn color="primary" block @click="dialogEdit = false"
            >Close Dialog</v-btn
        >
    </v-dialog>
</template>
<script setup>
import UploadImage from "../../components/UploadImage.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
const dialogAdd = ref(false);
const dialogEdit = ref(false);
const activeImageUpload = ref(null);
const newItem = ref({});
const editingItem = ref({});
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
        title: "Featured Image",
        value: "created_at",
    },
    {
        title: "Actions",
        value: "actions",
        sortable: false,
    },
]);

const returnImagePath = (imageName) => {
    const baseUrl = `${window.location.protocol}//${window.location.host}`;
    return `${baseUrl}/storage/${imageName}`;
};
const items = ref([]);

const onFileChange = (file) => {
    activeImageUpload.value = file[0];
};
const clearImg = () => {
    activeImageUpload.value = null;
};

const editItem = (item) => {
    editingItem.value = { ...item };
    dialogEdit.value = true;
};
const openDialogAdd = () => {
    dialogAdd.value = true;
};
const createNewItem = async () => {
    try {
        const formData = new FormData();
        formData.append("name", newItem.value.name);
        formData.append("image", activeImageUpload.value);
        const { data } = await axios.post("/api/web/store-equipment", formData);
        items.value.push(data.equipment);
        dialogAdd.value = false;

        newItem.value = {};
    } catch (error) {
        console.error(error);
    }
};
const deleteItem = async (id) => {
    try {
        await axios.delete(`/api/web/delete-equipment/${id}`);
        items.value = items.value.filter((item) => item.id !== id);
    } catch (error) {
        console.error(error);
    }
};
const removeImageEdit = () => {
    editingItem.value.featured_image_url = null;
};
const requestEditProduct = async () => {
    try {
        const formData = new FormData();
        formData.append("name", editingItem.value.name);
        if (!editingItem.value.featured_image_url && !activeImageUpload.value) {
            formData.append("remove_image", "true");
        }else{
            formData.append("remove_image", "false");
            formData.append("image", activeImageUpload.value);
        }
        const { data } = await axios.post(
            `/api/web/update-equipment/${editingItem.value.id}`,
            formData
        );
        const index = items.value.findIndex(
            (item) => item.id === editingItem.value.id
        );
        items.value[index] = data.equipment;
        dialogEdit.value = false;
        activeImageUpload.value = null;
        editingItem.value = {};
    } catch (error) {
        console.error(error);
    }
};
const refreshList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-equipment");
        items.value = data;
    } catch (error) {
        console.error(error);
    }
};
onMounted(async () => {
    await refreshList();
});
</script>
