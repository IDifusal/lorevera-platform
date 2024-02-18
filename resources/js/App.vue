<template>
    <v-app>
        <v-navigation-drawer
            color="lorevera"
            v-model="drawer"
            app
        >
                <v-btn
                    elevation="0"
                    color="lorevera"
                    icon
                    @click.stop="drawer = !drawer"
                >
                    <v-icon>{{
                        drawer
                            ? "mdi-arrow-expand-left"
                            : "mdi-arrow-expand-right"
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
                            ></v-list-item>
                        </template>
                    </v-list-item>
                </v-list>
        </v-navigation-drawer>

        <v-app-bar app >
            <v-app-bar-nav-icon
                v-if="!drawer"
                @click="toggleSidebar"
            ></v-app-bar-nav-icon>
            <v-app-bar-title>Fitvera App Dashboard</v-app-bar-title>
            <v-spacer></v-spacer>
        </v-app-bar>

        <v-main>
            <v-container fluid class="pt-15 pt-md-0">
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
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
        name: "Home",
        icon: "mdi-view-dashboard",
        link: "/",
        permitions: false,
    },
    {
        name: "Products",
        icon: "mdi-apps-box",
        link: "/products",
        permitions: false,
        childs: [
            {
                name: "Request Product",
                link: "/products",
            },
            {
                name: "My Requests",
                link: "/requests/my-requests",
            },
            {
                name: "Requests",
                link: "/requests/pending-requests",
            },
        ],
    },
    {
        name: "Reports",
        icon: "mdi-file-chart",
        link: "/",
        permitions: true,
        childs: [
            {
                name: "Report By Product",
                link: "/reports/product-report",
            },
            {
                name: "Report By User",
                link: "/reports/user-report",
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
.v-navigation-drawer__content {
    display: flex;
    flex-direction: column;
}
main.v-main {
    background-color: white;
    margin-top: 1%;
}
</style>
