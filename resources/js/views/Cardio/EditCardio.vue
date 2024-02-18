<template>
  <v-main>
    <h3>Creating Cardio: {{ cardio.name }}</h3>
    <v-form ref="form" v-model="valid">
      <v-text-field
        v-model="cardio.name"
        :rules="[rules.required]"
        class="field"
        required
        flat
      >
      </v-text-field>
    </v-form>
    <v-row>
      <v-col class="cols-6">
        <h4>Category</h4>
        <v-select
          v-model="cardio.category"
          :rules="[rules.required]"
          :items="caterogies"
          attach
        ></v-select>
      </v-col>
      <v-col class="cols-6">
        <h4>Image</h4>
        <div v-if=" typeof cardio.image == 'string' && cardio.image.includes('aws')">
          <img :src="cardio.image" width="150" class="mt-3" />
          <v-icon @click="clearImg"> mdi-window-close </v-icon>
        </div>
        <div v-else>
          <upload-image @cleanImg="clearImg" @changed="onFileChange" :max="1" />
        </div>
      </v-col>
    </v-row>
    <h4 class="mb-3">Description</h4>
    <wysiwyg v-model="cardio.instructions" />
    <div class="lang-divider"></div>
    <h3>Spanish</h3>
    <div class="cols-6">
      <h4 class="mt-3">Titulo</h4>
      <v-text-field v-model="cardio.nameEs" class="field" required flat>
      </v-text-field>
    </div>
    <h4 class="mb-3">Descripcion</h4>
    <wysiwyg v-model="cardio.instructionsEs" />
    <v-btn
      elevation="2"
      x-large
      class="mt-4"
      color="primary"
      @click="updateItem()"
    >
      Save
      <v-icon>mdi-content-save</v-icon>
    </v-btn>
  </v-main>
</template>
<script>
import UploadImage from "../../components/UploadImage.vue";
import axios from "axios";
export default {
  components: {
    UploadImage,
  },
  data() {
    return {
      rules: {
        required: (value) => !!value || "Required Field",
      },
      valid: false,
      caterogies: ["Hit", "Running", "Stretch"],
      cardio: {
        name: "",
        nameEs: "",
        category: "",
        instructions: "",
        instructionsEs: "",
        image: '',
      },
    };
  },
  created() {
    this.getItem();
  },
  methods: {
    checkImg(){
      console.log(typeof this.cardio.image,'hi')
      if(typeof this.cardio.image == 'string'){
        return false
      }else{
        return true
      }
    },    
    getItem() {
      try {
        axios
          .get("/cardio/" + this.$route.params.id)
          .then(({ data }) => (this.cardio = data));
      } catch (error) {}
    },
    onFileChange(e) {
      this.cardio.image = e[0];
    },
    clearImg() {
      this.cardio.image = null;
    },
    updateItem() {
      if (this.cardio.description == "") {
        this.$store.commit("SET_SNACKBAR", {
          show: true,
          text: "Description is empty",
        });
        return;
      } else {
        if (this.$refs.form.validate()) {
          try {
            let data = new FormData();
            let values = Object.keys(this.cardio);
            values.forEach((x) => {
              data.append(x, this.cardio[x]);
            });
            axios
              .post("/cardio/edit", data, {
                headers: { "Content-Type": "multipart/form-data" },
              })
              .then(
                this.$router.push("/cardio"),
                this.$store.commit("SET_SNACKBAR", {
                  show: true,
                  text: "Cardio edited successfully",
                })
              );
          } catch (error) {
            console.log(error);
          }
        }
      }
    },
  },
};
</script>