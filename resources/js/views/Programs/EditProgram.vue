<template>
  <v-main>
    <div class="d-flex justify-content-between">
      <h3>Editing Program {{ program.name }}</h3>
      <v-btn @click="saveProgram" color="primary"> Save </v-btn>
    </div>
    <v-form ref="form" id="create-form" v-model="valid">
      <h4>Name</h4>
      <v-text-field
        v-model="program.name"
        :rules="[rules.required]"
        class="field"
        required
        flat
      ></v-text-field>
      <v-row>
        <v-col class="cols-6">
          <h4>Featured Image</h4>
          <upload-image @cleanImg="clearImg" @changed="onFileChange" :max="1" />
        </v-col>
      </v-row>
      <v-row>
        <v-col class="cols-12">
          <h4>Description</h4>
          <wysiwyg v-model="program.description" />
        </v-col>
      </v-row>
      <v-row>
        <v-col class="cols-9">
          <h3>Warm Up</h3>
        </v-col>
        <v-col class="cols-3">
          <v-btn color="primary" @click="dialogAddWarm = true">
            Add Warm Up
            <v-icon> mdi-pencil </v-icon>
          </v-btn>
        </v-col>
      </v-row>
      <v-data-table
        :headers="headers"
        no-data-text="Add exercises"
        :items="program.warmup"
        hide-default-footer
        class="elevation-1"
      >
      </v-data-table>
      <div v-for="(item, index) in listWeeks" :key="index">
        <div class="h-10"></div>
        <v-row>
          <v-col cols="8" class="">
            <h3>Week {{ index + 1 }}</h3>
          </v-col>
          <v-col cols="4" class="flex">
            <v-btn color="primary" @click="dialogAddExersise(index)">
              Add Exercise
              <v-icon> mdi-pencil </v-icon>
            </v-btn>
            <v-btn color="error" @click="deleteWeek(index)">
              Delete Week
              <v-icon> mdi-pencil </v-icon>
            </v-btn>
          </v-col>
        </v-row>
        <v-data-table
          :headers="headers"
          no-data-text="Add exercises"
          :items="listWeeks[index]"
          hide-default-footer
          class="elevation-1"
        >
          <template v-slot:item="props">
            <tr>
              <td>
                {{ props.item.name }}
              </td>
              <td>
                {{ props.item.description }}
              </td>              
              <td>
                {{ props.item.time }}
              </td>   
              <td>
                {{ props.item.reps }}
              </td>                               
              <td>
                <v-btn color="orange" fab small dark>
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn color="red" fab small dark>
                  <v-icon>mdi-delete</v-icon>
                </v-btn>                
              </td>
            </tr>
          </template>
        </v-data-table>
      </div>
      <div class="h-10"></div>
      <v-btn color="primary" @click="addWeek">
        Add Week
        <v-icon> mdi-pencil </v-icon>
      </v-btn>
    </v-form>
    <v-dialog v-model="dialogAddWarm" persistent width="700" id="bg-white">
      <v-card>
        <v-form ref="formWarm" v-model="validWarm">
          <v-flex>
            <v-col class="cols-6">
              Name
              <v-text-field
                v-model="activeWarm.name"
                :rules="[rules.required]"
                class="field"
                required
                flat
              ></v-text-field>
            </v-col>
            <v-col class="cols-6">
              Description
              <wysiwyg v-model="activeWarm.description" />
            </v-col>
            <v-row class="pa-3">
              <v-col class="cols-6">
                Reps
                <v-text-field
                  v-model="activeWarm.reps"
                  :rules="[rules.required]"
                  class="field"
                  type="number"
                  required
                  flat
                ></v-text-field>
              </v-col>
              <v-col class="cols-6">
                Time
                <v-text-field
                  v-model="activeWarm.time"
                  :rules="[rules.required]"
                  class="field"
                  type="number"
                  required
                  flat
                ></v-text-field>
              </v-col>
            </v-row>
            <div class="pa-3">
              <upload-image
                @cleanImg="clearImgWarm"
                @changed="onFileChangeWarm"
                :max="1"
              />
            </div>
          </v-flex>
          <div class="pa-3 m-2">
            <v-btn @click="resetWarmForm"> Close </v-btn>
            <v-btn @click="saveWarmRow" color="primary"> Save </v-btn>
          </div>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogExersise" persistent width="700" id="bg-white">
      <v-card>
        <v-form ref="formEx" v-model="validWarm">
          <v-flex>
            <v-col class="cols-6">
              Name
              <v-text-field
                v-model="activeEx.name"
                :rules="[rules.required]"
                class="field"
                required
                flat
              ></v-text-field>
            </v-col>
            <v-col class="cols-6">
              Description
              <wysiwyg v-model="activeEx.description" />
            </v-col>
            <v-row class="pa-3">
              <v-col class="cols-6">
                Reps
                <v-text-field
                  v-model="activeEx.reps"
                  :rules="[rules.required]"
                  class="field"
                  type="number"
                  required
                  flat
                ></v-text-field>
              </v-col>
              <v-col class="cols-6">
                Time
                <v-text-field
                  v-model="activeEx.time"
                  :rules="[rules.required]"
                  class="field"
                  type="number"
                  required
                  flat
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row class="pa-3">
              <v-col cols="cols-6">
                Featured Image
                <upload-image
                  @cleanImg="clearImgWarm"
                  @changed="onFileChangeWarm"
                  :max="1"
                />
              </v-col>
              <v-col cols="cols-6">
                Video
                <v-text-field
                  v-model="activeEx.video"
                  class="field"
                  required
                  flat
                ></v-text-field>
              </v-col>
            </v-row>
          </v-flex>
          <div class="pa-3 m-2">
            <v-btn @click="resetExForm"> Close </v-btn>
            <v-btn @click="saveRowEx" color="primary"> Save </v-btn>
          </div>
        </v-form>
      </v-card>
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
  data() {
    return {
      error: "",
      valid: false,
      validWarm: false,
      dialogAddWarm: false,
      dialogExersise: false,
      activeWeek: undefined,
      valid: false,
      url: "",
      rules: {
        required: (value) => !!value || "Required Field",
      },
      activeWarm: {
        name: "",
        description: "",
        time: "",
        reps: "",
        image: "",
        time: "",
      },
      activeEx: {
        name: "",
        description: "",
        time: "",
        reps: "",
        image: "",
        time: "",
        week: "",
        video: "",
      },
      program: {
        name: "",
        image: "",
        description: "",
        items: "",
        warmup: [],
      },
      items: ["Dumbbells", "Dumbbells2", "Dumbbells3", "Dumbbells4"],
      headers: [
        {
          text: "Name",
          align: "start",
          value: "name",
        },
        { text: "Description", value: "description" },
        { text: "Time", value: "time" },
        { text: "Reps", value: "reps" },
      ],
      listWeeks: [],
    };
  },
  created() {
    this.getItem();
  },
  methods: {
    groupBy(xs, key) {
      return xs.reduce(function (rv, x) {
        (rv[x[key]] = rv[x[key]] || []).push(x);
        return rv;
      }, {});
    },
    createTables() {
      let result = this.groupBy(this.program.items, "weekId");
      for (const [key, value] of Object.entries(result)) {
        this.listWeeks.push(value);
      }
    },
    getItem() {
      try {
        axios
          .get("/programs/" + this.$route.params.id)
          .then(({ data }) => ((this.program = data), this.createTables()));
      } catch (error) {}
    },
    saveProgram() {
      if (this.$refs.form.validate()) {
        try {
          var myHeaders = new Headers();
          myHeaders.append("headers", "multipart/form-data");
          let data = new FormData();
          //transforming array of arrays into array of objects
          let items = [];
          this.listWeeks.forEach((x) => x.forEach((x) => items.push(x)));
          this.program.items = JSON.stringify(items);
          let values = Object.keys(this.program);
          values.forEach((x) => {
            data.append(x, this.program[x]);
          });
          console.log(data);
          axios
            .post("/programs/create", data, {
              headers: { "Content-Type": "multipart/form-data" },
            })
            .then((response) =>
              console.log("response CREATE PROGRAM", response)
            );
        } catch (error) {
          console.log(error);
        }
      } else {
        console.log("form error");
      }
    },
    deleteWeek(week) {
      this.listWeeks.splice(week, 1);
    },
    dialogAddExersise(week) {
      this.dialogExersise = true;
      this.activeWeek = week;
    },
    addWeek() {
      this.listWeeks.push([]);
    },
    saveWarmRow() {
      if (this.activeWarm.description == "") {
        this.$store.commit("SET_SNACKBAR", {
          show: true,
          text: "Description is empty",
        });
        return;
      } else {
        if (this.$refs.formWarm.validate()) {
          try {
            let data = { ...this.activeWarm };
            this.program.warmup.push(data);
            this.resetWarmForm();
          } catch (error) {
            console.log(error);
          }
        }
      }
    },
    saveRowEx() {
      if (this.activeEx.description == "") {
        this.$store.commit("SET_SNACKBAR", {
          show: true,
          text: "Description is empty",
        });
        return;
      } else {
        if (this.$refs.formEx.validate()) {
          try {
            this.activeEx.week = this.activeWeek;
            let data = { ...this.activeEx };
            this.listWeeks[this.activeWeek].push(data);
            this.resetExForm();
          } catch (error) {
            console.log(error);
          }
        }
      }
    },
    resetWarmForm() {
      this.dialogAddWarm = false;
      this.activeWarm.name = "";
      this.activeWarm.description = "";
      this.activeWarm.time = "";
      this.activeWarm.image = "";
      this.activeWarm.reps = "";
    },
    resetExForm() {
      this.dialogExersise = false;
      this.activeWeek = undefined;
      this.activeEx.name = "";
      this.activeEx.description = "";
      this.activeEx.time = "";
      this.activeEx.image = "";
      this.activeEx.reps = "";
      this.activeEx.week = "";
      this.activeEx.video = "";
    },
    clearImg() {
      this.program.image = "";
      this.url = "";
    },
    clearImgWarm() {
      this.activeWarm.image = "";
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
      this.program.image = file;
    },
    onFileChangeWarm() {
      const file = e.target.files[0];
      this.activeWarm.image = file;
    },
  },
};
</script>