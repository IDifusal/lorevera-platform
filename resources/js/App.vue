<template>
    <v-layout class="rounded rounded-md">
        <v-navigation-drawer color="lorevera" v-model="drawer" app>
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
                    :to="item.link"
                    @click="toggleSubItems(item)"
                >
                    <div class="d-flex">
                        <v-icon size="large" :icon="item.icon"></v-icon>
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
  
      <v-app-bar app>
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
import { ref } from "vue";
const drawer = ref(true);

const itemsMenu = [
    {
        name: "Dashboard",
        icon: "mdi-view-dashboard",
        link: "/",
    },
    {
        name: "Users",
        icon: "mdi-apps-box",
        link: "/users/list-users",
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
