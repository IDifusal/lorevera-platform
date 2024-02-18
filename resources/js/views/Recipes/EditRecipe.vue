<template>
  <v-main>
    <h3>Editing Recipe: {{ recipe.name }}</h3>
    <h4>Name</h4>
    {{ recipe.plan }}
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
          <v-card class="pa-2 div-premium" height="100%" outlined>
            Premium <br />
            <input
              type="checkbox"
              name="premium"
              id="premium"
              true-value="1"
              false-value="0"
              v-model="recipe.premium"
            />
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Cook Time
            <v-text-field
              v-model="recipe.cook_time"
              :rules="[rules.required]"
              class="field"
              required
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
              flat
            ></v-text-field>
          </v-card>
        </v-col>
        <v-col cols="3">
          <v-card class="pa-2" outlined>
            Image
            <div
              v-if="
                typeof this.recipe.photo == 'string'  && recipe.photo.includes('aws')
              "
            >
              <img :src="recipe.photo" width="150" class="mt-3" />
              <v-icon @click="clearImgOld"> mdi-window-close </v-icon>
            </div>
            <div v-else>
              <upload-image
                @cleanImg="clearImg"
                @changed="onFileChange"
                :max="1"
              />
            </div>
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
              class="field"
              required
            ></v-text-field>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="6">
          <v-card class="pa-2" outlined>
            Plan<br />
            <select name="plan" id="plan" v-model="recipe.plan" class="field">
              <option value="Meat Plan">Meat Plan</option>
              <option value="Vegetarian Plan">Vegetarian Plan</option>
            </select>
          </v-card>
        </v-col>
        <v-col cols="6">
          <v-card class="pa-2" outlined>
            Category<br />
            <select
              name="categorue"
              id="categorie"
              v-model="recipe.categorie"
              class="field"
            >
              <option value="Breakfast">Breakfast</option>
              <option value="Launch">Launch</option>
            </select>
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
          <wysiwyg v-model="recipe.instructions" />
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
        @click="updateFood"
        color="primary"
      >
        Save
        <v-icon>mdi-content-save</v-icon>
      </v-btn>
    </v-form>
    <v-dialog v-model="dialog" width="600">
      <img :src="recipe.photo" class="full-preview" />
    </v-dialog>
  </v-main>
</template>
<script>
import axios from "axios";
import UploadImage from "../../components/UploadImage.vue";

export default {
  components: {
    UploadImage,
  },
  computed:{
    checkImg(){
    return typeof this.recipe.image 
    }
},
  data() {
    return {
      error: "",
      dialog: false,
      rules: {
        required: (value) => !!value || "Required Field.",
      },
      valid: false,
      url: "",
      recipe: {
        id: "",
        name: "",
        nameEs: "",
        photo: "",
        instructions: "",
        instructionsEs: "",
        preparation_time: "",
        cook_time: "",
        calories: "",
        fat: "",
        carbs: "",
        protein: "",
        premium: "",
        plan: "",
        categorie: "",
        ingredients: "",
        ingredientsEs: "",
      },
    };
  },
  created() {
    this.getRecipe();
  },
  methods: {
    clearImg() {
      this.recipe.image = null;
    },    
    clearImgOld() {
      this.recipe.photo = null;
    },
    onFileChange(e) {
      this.recipe.image = e[0];
    },
    clearImage() {
      this.recipe.photo = "";
    },
    getRecipe() {
      axios.get("/recipe/" + this.$route.params.id).then((response) => {
        this.recipe = response.data;
      });
    },
    updateFood() {
      if (this.recipe.id == "") {
        this.error = "error";
        return;
      } else {
        try {
          let data = new FormData();
          let values = Object.keys(this.recipe);
          values.forEach((x) => {
            data.append(x, this.recipe[x]);
          });
          axios
            .post("/recipe/edit", data, {
              headers: { "Content-Type": "multipart/form-data" },
            })
            .then(()=>{
              this.$router.push("/recipes"),
              this.$store.commit("SET_SNACKBAR", {
                show: true,
                text: "Recipe edited successfully",
              })}
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
/* @import "~vue-wysiwyg/dist/vueWysiwyg.css"; */
.pa-2.div-premium {
  display: flex;
  place-items: center;
  justify-content: center;
  flex-direction: column;
}
</style>