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
            <v-list-item to="/admin/list/installations/Установки">
              <v-list-item-content>Установки</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/shapes/Формы">
              <v-list-item-content>Формы</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/surfaces/Поверхности">
              <v-list-item-content>Поверхности</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/bowl_locations/Рассположения чаш">
              <v-list-item-content>Рассположения чаш</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/destinations/Предназначения">
              <v-list-item-content>Предназначения</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/mounting_types/Типы монтажа">
              <v-list-item-content>Типы монтажа</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/handle_types/Одноручный-Двуручный">
              <v-list-item-content>Одноручный/Двуручный</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/styles/Стили">
              <v-list-item-content>Стили</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/pouring_outs/Изливы">
              <v-list-item-content>Изливы</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/distances/Типы расстояния">
              <v-list-item-content>Типы расстояния</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/fastener_types/Типы крепежа">
              <v-list-item-content>Типы крепежа</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/release_types/Типы выпуска">
              <v-list-item-content>Типы выпуска</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/water_supplies/Подводы воды">
              <v-list-item-content>Подводы воды</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/seats/Сиденья">
              <v-list-item-content>Сиденья</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/materials/Материалы">
              <v-list-item-content>Материалы</v-list-item-content>
            </v-list-item>
            <v-list-item to="/admin/list/flushes/Смывы">
              <v-list-item-content>Смывы</v-list-item-content>
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
