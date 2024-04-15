<template>
    <v-main>
        <v-row class="mb-4">
            <v-col cols="3">
                <h2>Nutrition Plans</h2>
            </v-col>
            <v-spacer> </v-spacer>
            <v-col cols="3">
                <v-btn color="primary" to="/recipes/create">
                    Create Recipe
                    <v-icon> mdi-pencil </v-icon>
                </v-btn>
            </v-col>
        </v-row>
        <v-spacer></v-spacer>
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
                        <img
                            @click="activeImg(props.item.photo)"
                            width="30px"
                            :src="props.item.photo"
                            alt=""
                        />
                    </td>
                    <td>
                        <v-btn
                            color="orange"
                            fab
                            small
                            dark
                            :to="{
                                name: 'recipe_plan_edit',
                                params: { id: props.item.id },
                            }"
                        >
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn
                            color="red"
                            fab
                            small
                            dark
                            @click="deleteRecipe(props.item.id)"
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </td>
                </tr>
            </template>
        </v-data-table>
        <v-dialog v-model="dialog" width="500">
            <img width="30px" :src="img" alt="" />
        </v-dialog>
        <v-snackbar v-model="snackbar">
            {{ text }}

            <template v-slot:action="{ attrs }">
                <v-btn
                    color="pink"
                    text
                    v-bind="attrs"
                    @click="snackbar = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </v-main>
</template>
<script>
import axios from "axios";
export default {
    created() {
        this.getRecipes();
    },
    data() {
        return {
            snackbar: false,
            dialog: false,
            img: "",
            items: [],
            text: "",
            headers: [
                { text: "Id", value: "id", sortable: true },
                { text: "Name", value: "name" },
                { text: "Photo", value: "photo" },
                { text: "Actions", value: "actions" },
            ],
            optionsTable: {
                itemsPerPage: 10,
            },
        };
    },
    methods: {
        activeImg(img) {
            this.img = img;
            this.dialog = true;
        },
        getRecipes() {
            try {
                axios.get("/web/list-recipes").then(({ data }) => (this.items = data));
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
