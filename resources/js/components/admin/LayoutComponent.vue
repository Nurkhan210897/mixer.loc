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
          <v-list-item to="/admin/products">
            <v-list-item-content>Продукты</v-list-item-content>
          </v-list-item>
          <v-list-item to="/admin/sliders">
            <v-list-item-content>Карусель</v-list-item-content>
          </v-list-item>
          <v-list-item to="/admin/directory_types/Типы справочников">
            <v-list-item-content>Типы справочников</v-list-item-content>
          </v-list-item>
          <v-list-group>
            <template v-slot:activator>
              <v-list-item-title>Справочники</v-list-item-title>
            </template>
            <v-list-item
              :to="'/admin/directory/'+item.name+'/'+item.id"
              v-for="(item,i) in directoryTypes"
              :key="i"
            >
              <v-list-item-content>{{item.name}}</v-list-item-content>
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
  props: ["directoryTypes"],
  mounted() {},
  data: () => ({
    drawer: null,
  }),

  created() {},
};
</script>
