<template>
    <div>
        Creating a day
        <label for="name">Title:</label>
        <v-text-field
            v-model="newItem.title"
            hide-details
            single-line
            :rules="[(v) => !!v || 'Name is required']"
        />
        <label for="quantity">Description:</label>
        <editor-content :editor="editor" />        
        <label for="quantity">Image:</label>
        <UploadImage @cleanImg="clearImg" @changed="onFileChange" />
        <v-row>
            <v-col cols="4">
                <label for="">Select Equipment</label>
                <v-select
                    v-model="selectedEquipment"
                    :items="equipment"
                    item-value="id"
                    multiple
                    chips
                ></v-select>
            </v-col>
            <v-col cols="4">
                <label for="">Select Warm Up</label>
                <v-select
                    v-model="selectedWarmUp"
                    :items="warmUp"
                    multiple
                    item-value="id"
                    chips
                ></v-select>
            </v-col>
            <v-col cols="4">
                <label for="">Select Workouts</label>
                <v-select
                    v-model="selectedWorkout"
                    :items="workout"
                    multiple
                    item-value="id"
                    chips
                ></v-select>
            </v-col>            
        </v-row>
        <v-btn class="mt-10" color="lorevera" @click="createNewItem"
            >Save Changes</v-btn
        >
    </div>
</template>
<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import UploadImage from "../../../components/UploadImage.vue";
import StarterKit from "@tiptap/starter-kit";
import { useRouter } from "vue-router";
import { ref, onMounted } from "vue";
const router = useRouter();
const equipment = ref([]);
const warmUp = ref([]);
const workout = ref([]);
const activeImageUpload = ref(null);
const onFileChange = (file) => {
    activeImageUpload.value = file[0];
};
const clearImg = () => {
    activeImageUpload.value = null;
};
const editor = useEditor({
    content: "<p>Content <strong> add here</strong></p>",
    extensions: [StarterKit],
});

const newItem = ref({});
const selectedEquipment = ref([]);
const selectedWarmUp = ref([]);
const selectedWorkout = ref([]);
const getEquipmentList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-equipment");
        for (let i = 0; i < data.length; i++) {
            data[i].title = data[i].name;
        }
        equipment.value = data;
    } catch (error) {
        console.error(error);
    }
};
const getWarmUpList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-warmup");
        for (let i = 0; i < data.length; i++) {
            data[i].title = data[i].name;
        }
        warmUp.value = data;
    } catch (error) {
        console.error(error);
    }
};
const getWorkOutList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-workout");
        for (let i = 0; i < data.length; i++) {
            data[i].title = data[i].name;
        }
        workout.value = data;
    } catch (error) {
        console.error(error);
    }
};
const createNewItem = async () => {
    if (!newItem.value.title) {
        alert("Title is required");
        return;
    }
    const formData = new FormData();
    formData.append("title", newItem.value.title);
    formData.append("content", editor.value.getHTML());
    formData.append("equipment", JSON.stringify(selectedEquipment.value));
    formData.append("warmUp", JSON.stringify(selectedWarmUp.value));
    formData.append("workout", JSON.stringify(selectedWorkout.value));
    if (activeImageUpload.value) {
        formData.append("image", activeImageUpload.value);
    }    
    try {
        const response = await axios.post("/api/web/store-day", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log(response);
        router.push({ name: "days" });
    } catch (error) {
        console.error(error);
    }
};
onMounted(async () => {
    await getEquipmentList();
    await getWarmUpList();
    await getWorkOutList();
});
</script>
