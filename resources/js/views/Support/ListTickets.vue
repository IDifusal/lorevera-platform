<template>
    <h2>List Tickets</h2>
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
                    {{ props.item.user.name }}
                </td>
                <td>
                    {{ getFriendlyDate(props.item.created_at) }}
                </td>
                <td>
                    <v-textarea
                        :model-value="value"
                        rows="1"
                        no-resize
                        readonly
                        v-model="props.item.message"
                    ></v-textarea>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>

<script setup>
import { ref, onMounted } from "vue";
const items = ref([]);
const headers = ref([
    {
        title: "id",
        value: "id",
    },
    {
        title: "User Name",
        value: "user.name",
    },
    {
        title: "Creation Date",
        value: "creation",
    },
    {
        title: "Message",
        value: "message",
        sortable: false,
    },
]);
const getFriendlyDate = (isoDate) => {
    const date = new Date(isoDate);
    return `${date.toLocaleDateString()} at ${date.toLocaleTimeString()}`;
};
onMounted(async () => {
    const response = await axios.get("/api/web/list-tickets");
    items.value = response.data;
});
</script>

<style scoped></style>
