<template>
    <div flex>
        <h2>List Nutrition Meal Plan</h2>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="addItem.dialog = true">Add</v-btn>
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
                    {{ props.item.ingredients }}
                </td>
                <td>
                    {{ props.item.goal }}
                </td>
                <td>
                    <v-btn color="primary" text @click="handleEditItem(props.item)">
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

    <v-dialog v-model="removeItem.dialog" max-width="400" persistent>
        <v-card
            text="Are you sure you want to delete this item?"
            title="This will delete the item permanently."
        >
            <template v-slot:actions>
                <v-spacer></v-spacer>

                <v-btn @click="removeItem.dialog = false"> Cancel </v-btn>

                <v-btn color="lorevera" @click="deleteItem()"> Confirm </v-btn>
            </template>
        </v-card>
    </v-dialog>
    <v-dialog v-model="addItem.dialog" max-width="400" persistent>
        <v-card>
            <v-card-title> Add Item </v-card-title>
            <v-card-text>
                <v-row>
                    <v-text-field
                        v-model="addItem.fat"
                        label="Fat"
                        variant="outlined"
                        type="number"
                    ></v-text-field>

                    <v-text-field
                        v-model="addItem.protein"
                        label="Protein"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-text-field
                        v-model="addItem.carbs"
                        label="Carbs"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                    <v-text-field
                        v-model="addItem.calories"
                        label="Calories"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Ingredients"
                        variant="outlined"
                        v-model="addItem.ingredients"
                    ></v-textarea>
                </v-row>
                <v-row>
                    <v-select
                        label="Select Goal"
                        variant="outlined"
                        v-model="addItem.goal"
                        :items="[
                            'Lose Weight',
                            'Gain Weight',
                        ]"
                    >
                    </v-select>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="addItem.dialog = false">Cancel</v-btn>
                <v-btn @click="storeNewItem()" variant="tonal" color="lorevera"
                    >Save</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="dialogEditItem" max-width="400" persistent>
        <v-card>
            <v-card-title> Add Item </v-card-title>
            <v-card-text>
                <v-row>
                    <v-text-field
                        v-model="editItem.fat"
                        label="Fat"
                        variant="outlined"
                        type="number"
                    ></v-text-field>

                    <v-text-field
                        v-model="editItem.protein"
                        label="Protein"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-text-field
                        v-model="editItem.carbs"
                        label="Carbs"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                    <v-text-field
                        v-model="editItem.calories"
                        label="Calories"
                        variant="outlined"
                        type="number"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Ingredients"
                        variant="outlined"
                        v-model="editItem.ingredients"
                    ></v-textarea>
                </v-row>
                <v-row>
                    <v-select
                        label="Select Goal"
                        variant="outlined"
                        v-model="editItem.goal"
                        :items="[
                            'Lose Weight',
                            'Gain Weight',
                        ]"
                    >
                    </v-select>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="dialogEditItem = false">Cancel</v-btn>
                <v-btn @click="updateItem()" variant="tonal" color="lorevera"
                    >Save</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>    
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const headers = ref([
    {
        title: "id",
        value: "id",
    },
    {
        title: "Ingredients",
        value: "ingredients",
    },
    {
        title: "Goal",
        value: "Goal",
    },    
    {
        title: "Actions",
        value: "actions",
        sortable: false,
    },
]);

const removeItem = ref({
    dialog: false,
    itemid: null,
});
const addItem = ref({
    dialog: false,
    fat: null,
    protein: null,
    carbs: null,
    calories: null,
    ingredients: null,
    goal: null,
});
const dialogEditItem = ref(false);
const editItem = ref({});
const items = ref([]);

const handleEditItem = (itemId) => {
    console.log("edit item", itemId);
    dialogEditItem.value = true;
    editItem.value = itemId;
};
const deleteItemDialog = (id) => {
    console.log("delete item", id);
    removeItem.value.dialog = true;
    removeItem.value.itemid = id;
};
const updateItem = async () => {
    try {
        const { data } = await axios.post(`/api/web/update-recipe/${editItem.value.id}`, {
            fat: editItem.value.fat,
            protein: editItem.value.protein,
            carbs: editItem.value.carbs,
            calories: editItem.value.calories,
            ingredients: editItem.value.ingredients,
            plan: "meat_plan",
            goal: editItem.value.goal == "Lose Weight" ? "loss_weight" : "gain_muscle",
        });
        items.value = items.value.map((item) => {
            if (item.id === data.id) {
                return data;
            }
            return item;
        });
    } catch (error) {
        console.error(error);
    }
    dialogEditItem.value = false;
};
const storeNewItem = async () => {
    try {
        const { data } = await axios.post("/api/web/store-recipe", {
            fat: addItem.value.fat,
            protein: addItem.value.protein,
            carbs: addItem.value.carbs,
            calories: addItem.value.calories,
            ingredients: addItem.value.ingredients,
            plan: "meat_plan",
            goal: addItem.value.goal == "Lose Weight" ? "loss_weight" : "gain_muscle",
        });
        items.value.push(data);
        addItem.value.fat = null;
        addItem.value.protein = null;
        addItem.value.carbs = null;
        addItem.value.calories = null;
        addItem.value.ingredients = null;
        addItem.value.goal = null;
    } catch (error) {
        console.error(error);
    }
    addItem.value.dialog = false;
};

const deleteItem = async () => {
    const id = removeItem.value.itemid;
    try {
        await axios.delete(`/api/web/delete-recipe/${id}`);
        items.value = items.value.filter((item) => item.id !== id);
    } catch (error) {
        console.error(error);
    }
    removeItem.value.dialog = false;
    removeItem.value.itemid = null;
};
const refreshList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-recipes-meat");
        items.value = data;
    } catch (error) {
        console.error(error);
    }
};
onMounted(async () => {
    await refreshList();
});
</script>
