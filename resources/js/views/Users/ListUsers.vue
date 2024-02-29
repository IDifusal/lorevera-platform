<template>
    <h2>List Users</h2>
    <v-spacer></v-spacer>
    <v-data-table
        :headers="headers"
        :items="users"
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
                    {{ props.item.created_at }}
                </td>
                <td>
                    {{ props.item.phone }}
                </td>
                <td>
                    {{ props.item.email }}
                </td>
                <td>
                  <v-btn
                        color="lorevera"
                        text
                        @click="editUser(props.item)"
                    >
                        Details
                    </v-btn>                  
                    <v-btn
                        color="primary"
                        text
                        @click="editUser(props.item)"
                    >
                        Edit
                    </v-btn>
                    <v-btn
                        color="error"
                        text
                        @click="deleteUser(props.item)"
                    >
                        Delete
                    </v-btn>
                </td>
            </tr>
        </template>
    </v-data-table>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            headers: [
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
                { title: "Register Date", value: "created_at" },
                { title: "Phone", value: "phone" },
                { title: "Email", value: "email" },
                { title: "Actions", value: "actions", sortable: false },
            ],
            users: [],
        };
    },
    created() {
        try {
            axios
                .get("/api/web/list-users")
                .then(({ data }) => (this.users = data.users));
        } catch (error) {
            console.table(error);
        }
    },
};
</script>
