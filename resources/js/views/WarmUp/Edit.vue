<template>
    <h2>Editing Workout {{ newItem.name }}</h2>
    <div class="form-group">
        <v-form ref="form" fast-fail @submit.prevent="editItem()">
            <label for="quantity">Name:</label>
            <v-text-field
                v-model="newItem.name"
                hide-details
                single-line
                :rules="[(v) => !!v || 'Item is required']"
            />
            <v-row align="start" no-gutters ga>
                <v-col class="mr-5">
                    <label for="quantity">Reps:</label>
                    <v-text-field
                        v-model="newItem.reps"
                        hide-details
                        single-line
                        :rules="[(v) => !!v || 'Reps is required']"
                        type="number"
                    />
                </v-col>
                <v-col>
                    <label for="quantity">Sets:</label>
                    <v-text-field
                        v-model="newItem.sets"
                        hide-details
                        single-line
                        :rules="[(v) => !!v || 'Item is required']"
                        type="number"
                    />
                </v-col>
            </v-row>
            <label for="Content">Content:</label>
            <editor-content :editor="editor" />
            <v-row>
                <v-col>
                    <label for="quantity">Image:</label>
                    <img
                        v-if="newItem.image_url"
                        :src=" '/storage/'+newItem.image_url"
                        alt=""
                        style="width: 80px; height: 80px; object-fit: contain"
                    />
                    <UploadImage v-else @cleanImg="clearImg" @changed="onFileChange" />
                </v-col>
                <v-col>
                    <label for="video">Video:</label><br>
                    <video v-if="newItem.video_url" width="350" controls>
                        <source :src=" '/storage/'+newItem.video_url" type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>
                    <UploadVideo v-else
                        @cleanImg="clearVideo"
                        @changed="onVideoChange"
                    />
                </v-col>
            </v-row>
            <v-btn class="mt-10" color="lorevera" type="submit"
                >Save Changes</v-btn
            >
        </v-form>
    </div>
</template>
<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();


import UploadVideo from "../../components/UploadVideo.vue";
import UploadImage from "../../components/UploadImage.vue";

const newItem = ref({});
const activeImageUpload = ref(null);
const activeVideoUpload = ref(null);
const onVideoChange = (file) => {
    console.log(file);
    activeVideoUpload.value = file[0];
};
const clearVideo = () => {
    activeVideoUpload.value = null;
};
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

const editItem = async () => {

    const id = window.location.pathname.split("/").pop();    
    if (!newItem.value.name || !newItem.value.reps || !newItem.value.sets) {
        return;
    }
        
    const formData = new FormData();
    formData.append("name", newItem.value.name);
    formData.append("reps", newItem.value.reps);
    formData.append("sets", newItem.value.sets);
    formData.append("content", editor.value.getHTML());
    if (activeImageUpload.value) {
        formData.append("image", activeImageUpload.value);
    }
    if (activeVideoUpload.value) {
        formData.append("video", activeVideoUpload.value);
    }
    try {
        const response = await axios.post(`/api/web/update-warmup/${id}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log(response);
        router.push({ name: "warm-up-list" });
    } catch (error) {
        console.log(error);
    }
};
onMounted(async () => {
    console.log("mounted");
    const id = window.location.pathname.split("/").pop();
    try {
        const { data } = await axios.get(`/api/web/list-warmup/${id}`);
        newItem.value = data;
        editor.value.commands.setContent(data.description);
    } catch (error) {
        console.log(error);
    }
});
</script>
