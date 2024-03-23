<template>
    <v-layout class="rounded rounded-md">
        <v-navigation-drawer color="lorevera" v-model="drawer" app v-if="isUserLoggedIn">
            <v-btn
                elevation="0"
                color="lorevera"
                icon
                @click.stop="drawer = !drawer"
            >
                <v-icon>{{
                    drawer ? "mdi-arrow-expand-left" : "mdi-arrow-expand-right"
                }}</v-icon>
            </v-btn>

            <v-list dense nav>
                <v-list-item
                    v-for="item in itemsMenu"
                    :key="item.name"
                    :value="item.link"
                    :to="item.link ?? null"
                    @click="toggleSubItems(item)"
                >
                    <div class="d-flex">
                        <v-icon size="large" :icon="item.icon" class="mr-2"></v-icon>
                        {{ item.name }}
                    </div>
                    <template v-if="item.childs">
                        <v-list-item
                            v-for="child in item.childs"
                            :key="child.name"
                            :title="child.name"
                            :to="child.link"
                            class="ml-3"
                        ></v-list-item>
                    </template>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
  
      <v-app-bar app v-if="isUserLoggedIn">
            <v-app-bar-nav-icon
                v-if="!drawer"
                @click="toggleSidebar"
            ></v-app-bar-nav-icon>
            <v-app-bar-title>Fitvera App Dashboard</v-app-bar-title>
            <v-spacer></v-spacer>
        </v-app-bar>
  
      <v-main class="ma-5">
                <router-view></router-view>
      </v-main>
    </v-layout>
  </template>

<style>
main.v-main {
    background-color: white;
}
</style>

<script setup>
import { ref,computed } from "vue";
const drawer = ref(true);
import { useUserStore } from "../js/store/user.store"; 
const userStore = useUserStore();
userStore.fetchUser();
const isUserLoggedIn = computed(() => userStore.isUserLoggedIn);
const itemsMenu = [
    {
        name: "Dashboard",
        icon: "mdi-view-dashboard",
        link: "/",
    },
    {
        name: "Users",
        icon: "mdi-account-group",
        link: null,
        permitions: false,
        childs: [
            {
                name: "List of users",
                link: "/users/list-users",
            },
            {
                name: "Report of users",
                link: "/users/report-users",
            },
        ],
    },
    {
        name:"Programs",
        icon: "mdi-package-variant-closed",
        link: "/packages",
        childs: [
            {
                name: "List of programs",
                link: "/packages/list-packages",
            },
            {
                name:"Days",
                link: "/packages/days",
            },            
            {
                name: "Warm Up",
                link: "/packages/warm-up",
            },            
            {
                name: "Workouts",
                link: "/packages/workout",
            },
            {
                name:"Equipment",
                link: "/packages/equipment",
            }
        ],
    },
    {
        name: "Support Center",
        icon: "mdi-headset",
        link: "/support/tickets",
        childs: [
            {
                name: "Unresolved Tickets",
                link: "/support/tickets",
            },
            {
                name: "Resolved Tickets",
                link: "/support/old-tickets",
            },
        ],
    },
];

const toggleSidebar = () => {
    drawer.value = !drawer.value;
};

const toggleSubItems = (item) => {
    if (item.childs) {
        item.opened = !item.opened;
    }
};
</script>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
label{
    font-weight: bold;
        display: block;
        margin-top: 20px;
}
</style>