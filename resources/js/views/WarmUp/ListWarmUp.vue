<template>
    <div flex>
        <h2>List WarmUps</h2>
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
                    {{ props.item.name }}
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
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
const goToAdd = () => {
    router.push({ name: "warm-up-add" });
};
const dialogAdd = ref(false);
const dialogEdit = ref(false);

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


const editItem = (item) => {
    editingItem.value = { ...item };
    dialogEdit.value = true;
};
const deleteItem = async (id) => {
    try {
        await axios.delete(`/api/web/delete-equipment/${id}`);
        items.value = items.value.filter((item) => item.id !== id);
    } catch (error) {
        console.error(error);
    }
};
const refreshList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-warmup");
        items.value = data;
    } catch (error) {
        console.error(error);
    }
};
onMounted(async () => {
    await refreshList();
});
</script>
