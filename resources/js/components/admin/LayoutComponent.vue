<template>
  <v-app id="inspire">
    <v-app id="inspire">
      <v-navigation-drawer v-model="drawer" app clipped class>
        <v-list dense>
          <v-list-item to="/admin/categories">
            <v-list-item-content>Категории</v-list-item-content>
          </v-list-item>
          <v-list-item to="/admin/subCategories">
            <v-list-item-content>Подкатегории</v-list-item-content>
          </v-list-item>
          <v-list-group>
            <template v-slot:activator>
              <v-list-item-title>Списки</v-list-item-title>
            </template>
            <v-list-item to="/admin/list/styles/Стили">
              <v-list-item-content>Стили</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/colors/Цвета">
              <v-list-item-content>Цвета</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/mixer_shapes/Формы сместителя">
              <v-list-item-content>Формы сместителя</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/controls/Управления">
              <v-list-item-content>Управления</v-list-item-content>
            </v-list-item>
          </v-list-group>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar app clipped-left>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Админка</v-toolbar-title>
      </v-app-bar>

      <v-main>
        <router-view></router-view>
      </v-main>
    </v-app>
  </v-app>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  props: {
    source: String,
  },

  data: () => ({
    drawer: null,
  }),

  created() {},
};
</script>
