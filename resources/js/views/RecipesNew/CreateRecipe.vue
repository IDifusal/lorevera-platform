<template>
  <v-main>
    <h3>Creating Nutrition Plan: {{ recipe.name }}</h3>
    <h4>Name</h4>
    <v-form ref="form" id="create-form" v-model="valid">
      <v-text-field
        v-model="recipe.name"
        :rules="[rules.required]"
        class="field"
        required
        flat
      ></v-text-field>
      <h4 class="pb-4">Details</h4>
      <v-row>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Cook Time
            <v-text-field
              v-model="recipe.cook_time"
              :rules="[rules.required]"
              class="field"
              required
              type="number"
              flat
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Preparation Time
            <v-text-field
              v-model="recipe.preparation_time"
              :rules="[rules.required]"
              class="field"
              required
              type="number"
              flat
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Image
              <upload-image
                @cleanImg="clearImg"
                @changed="onFileChange"
                :max="1"
              />
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Calories
            <v-text-field
              v-model="recipe.calories"
              :rules="[rules.required]"
              class="field"
              required
              type="number"
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Fat
            <v-text-field
              v-model="recipe.fat"
              :rules="[rules.required]"
              class="field"
              type="number"
              required
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Carbs
            <v-text-field
              v-model="recipe.carbs"
              :rules="[rules.required]"
              class="field"
              required
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Proteim
            <v-text-field
              v-model="recipe.protein"
              :rules="[rules.required]"
              type="number"
              class="field"
              required
            ></v-text-field>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="6">
          <h4 class="py-4">Ingredients</h4>
          <wysiwyg v-model="recipe.ingredients" />
        </v-col>
        <v-col cols="6">
          <h4 class="py-4">Instructions</h4>
          <wysiwyg v-model="recipe.instructions" required />
        </v-col>
      </v-row>
      <div class="lang-divider"></div>
      <h3>Spanish</h3>
      <h4>Nombre</h4>
      <input
        type="text"
        class="field"
        name="name"
        id="name"
        v-model="recipe.nameEs"
      />
      <v-row>
        <v-col cols="6">
          <h4 class="pb-4">Ingredientes</h4>
          <wysiwyg v-model="recipe.ingredientsEs" />
        </v-col>
        <v-col cols="6">
          <h4 class="pb-4">Instrucciones</h4>
          <wysiwyg v-model="recipe.instructionsEs" />
        </v-col>
      </v-row>
      <v-btn
        elevation="2"
        x-large
        class="mt-4"
        color="primary"
        @click="createFood()"
      >
        Save
        <v-icon>mdi-content-save</v-icon>
      </v-btn>
    </v-form>
    <v-dialog v-model="dialog" width="600">
      <img :src="url" class="full-preview" />
    </v-dialog>
  </v-main>
</template>
<script>
import axios from "axios";
import UploadImage from "../../components/UploadImage.vue";

export default {
  components:{
    UploadImage
  },
  data() {
    return {
      error: "",
      url: null,
      valid: false,
      dialog: false,
      rules: {
        required: (value) => !!value || "Required Field",
      },
      recipe: {
        name: "",
        nameEs: "",
        instructions: "",
        instructionsEs: "",
        preparation_time: "",
        cook_time: "",
        calories: "",
        fat: "",
        carbs: "",
        protein: "",
        categorie: "",
        ingredients: "",
        ingredientsEs: "",
        image: "",
      },
    };
  },
  methods: {
    clearImg() {
      this.recipe.image = null;
    },
    onFileChange(e) {
      this.recipe.image = e[0];
    },
    createFood() {
      if (this.$refs.form.validate()) {
        try {
          var myHeaders = new Headers();
          myHeaders.append("headers", "multipart/form-data");
          let data = new FormData();
          let values = Object.keys(this.recipe);
          values.forEach((x) => {
            data.append(x, this.recipe[x]);
          });
          axios
            .post("/recipe/create", data, {
              headers: { "Content-Type": "multipart/form-data" },
            })
            .then(
              this.$router.push("/recipes"),
              this.$store.commit("SET_SNACKBAR", {
                show: true,
                text: "Recipe created successfully",
              })
            );
        } catch (error) {
          console.log(error);
        }
      }
    },
  },
};
</script>
<style>
/* -wysiwyg/dist/vueWysiwyg.css */
.img-preview {
  width: 50px;
  height: 50px;
  object-fit: cover;
}
.closeImg {
  position: absolute;
  top: 0;
}
</style>