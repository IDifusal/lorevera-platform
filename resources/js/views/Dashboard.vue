<template>
    <h2>Dashboard</h2>
    <p>Hola {{ name }}</p>
    <v-row>
      <v-col cols="3">
        <v-card
          dark
          rounded
          to="/users"
          class="pa-3 d-flex flex-column justify-center align-center"
        >
          <h3>Total Users</h3>
          {{ data.users }}
        </v-card>
      </v-col>
      <v-col cols="3">
        <v-card
          rounded
          dark
          to="/sales"
          class="pa-3 d-flex flex-column justify-center align-center"
        >
          <h3>Total Sales</h3>
          0
        </v-card>
      </v-col>
      <v-col cols="3">
        <v-card
          rounded
          dark
          to="/recipes"
          class="pa-3 d-flex flex-column justify-center align-center"
        >
          <h3>Total Recipes</h3>
          {{ data.recipes }}
        </v-card>
      </v-col>
      <v-col cols="3">
        <v-card
          rounded
          dark
          to="/routines"
          class="pa-3 d-flex flex-column justify-center align-center"
        >
          <h3>Total Routines</h3>
          0
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <v-card class="mt-15 mx-auto">
          <v-sheet
            class="v-sheet--offset mx-auto"
            color="primary"
            elevation="6"
            max-width="calc(100% - 32px)"
          >
            <v-sparkline
              :labels="labels"
              :value="value"
              color="white"
              line-width="2"
              padding="16"
            ></v-sparkline>
          </v-sheet>

          <v-card-text class="pt-0">
            <div class="text-h6 font-weight-light mb-2">User Registrations</div>
            <div class="subheading font-weight-light grey--text">
              Last Campaign Performance
            </div>
            <v-divider class="my-2"></v-divider>
            <v-icon class="mr-2" small> mdi-clock </v-icon>
            <span class="text-caption grey--text font-weight-light"
              >last registration 26 minutes ago</span
            >
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="6">
        <v-card class="mt-15 mx-auto">
          <v-sheet
            class="v-sheet--offset mx-auto"
            color="primary"
            elevation="6"
            max-width="calc(100% - 32px)"
          >
            <v-sparkline
              :labels="labels"
              :value="value"
              color="white"
              line-width="2"
              padding="16"
            ></v-sparkline>
          </v-sheet>

          <v-card-text class="pt-0">
            <div class="text-h6 font-weight-light mb-2">Sales</div>
            <div class="subheading font-weight-light grey--text">
              Last Campaign Performance
            </div>
            <v-divider class="my-2"></v-divider>
            <v-icon class="mr-2" small> mdi-clock </v-icon>
            <span class="text-caption grey--text font-weight-light"
              >last registration 45 minutes ago</span
            >
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      data: {},
      labels: ["12am", "3am", "6am", "9am", "12pm", "3pm", "6pm", "9pm"],
      value: [200, 675, 410, 390, 310, 460, 250, 240],
    };
  },
  methods: {
    getInfo() {
      try {
        axios.get("/dashboard").then(({ data }) => (this.data = data));
      } catch (error) {
        console.log(error);
      }
    },    
  },
  created() {
    this.getInfo();
  },
};
</script>
<style>
.v-sheet--offset {
  top: -24px;
  position: relative;
}
</style>
