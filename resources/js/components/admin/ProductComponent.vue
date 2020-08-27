<template>
  <div>
    <v-skeleton-loader
      class="mx-auto"
      type="table-heading,table-thead,table-tbody"
      v-show="skeleton"
    ></v-skeleton-loader>
    <v-data-table
      :headers="headers"
      :items="data"
      :items-per-page="data.length"
      class="elevation-1"
      :search="search"
      hide-default-footer
      v-show="!skeleton"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Товары</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <template v-slot:activator="{ on }">
              <v-row>
                <v-col cols="8">
                  <v-btn color="success" dark class="mb-2" v-on="on">Добавить</v-btn>
                </v-col>
                <v-col cols="4">
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Поиск"
                    single-line
                    hide-details
                    class="searchInput"
                  ></v-text-field>
                </v-col>
              </v-row>
            </template>
            <v-card>
              <v-toolbar dark color="primary">
                <v-btn icon dark @click="dialog = false">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>{{formTitle}}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                  <v-btn dark text @click="dialog = false">Сохранить</v-btn>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-text>
                <v-container fluid>
                  <v-row>
                    <v-col cols="4">
                      <v-row>
                        <v-text-field v-model="editedItem.name" label="Название"></v-text-field>
                      </v-row>
                      <v-row>
                        <v-select
                          :items="categories"
                          item-value="id"
                          item-text="name"
                          v-model="editedItem.category_id"
                          label="Категория"
                        ></v-select>
                      </v-row>
                      <v-row>
                        <v-select
                          :items="subCategories"
                          item-value="id"
                          item-text="name"
                          v-model="editedItem.sub_category_id"
                          label="Подкатегория"
                        ></v-select>
                      </v-row>
                    </v-col>
                    <v-col cols="4">
                      <v-text-field v-model="editedItem.name" label="Название"></v-text-field>
                    </v-col>
                    <v-col cols="4">
                      <v-text-field v-model="editedItem.name" label="Название"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon color="warning" small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon color="error" small @click="showDeleteDialog(item)">mdi-delete</v-icon>
      </template>
      <template v-slot:no-data>Нет данных !</template>
    </v-data-table>
    <v-row>
      <v-dialog justify="center" v-model="deleteDialog" persistent max-width="350">
        <v-card>
          <v-card-title
            class="headline deleteDialogHead"
          >Вы действительно хотите удалить выбранную строку ?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="error darken-1" text @click="deleteDialog = false">Нет</v-btn>
            <v-btn color="success darken-1" text @click="deleteItem">Да</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-snackbar v-model="snackbar.show" right top :color="snackbar.color" :timeout="snackbar.time">
      {{ snackbar.text }}
      <template v-slot:action="{ attrs }">
        <v-icon @click="snackbar.show = false" color="white">mdi-close-circle-outline</v-icon>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
import main from "../../mixins/main.js";
export default {
  mixins: [main],
  data: () => ({
    headers: [
      { text: "Название", value: "name", sortable: false },
      { text: "Действия", value: "actions", sortable: false },
    ],
    categories: [],
    subCategories: [],
    editedItem: {
      name: "",
      category_id: "",
      sub_category_id: "",
    },
    defaultItem: {
      name: "",
      category_id: "",
      sub_category_id: "",
    },
  }),
  created() {
    this.index();
  },
  methods: {
    index() {
      axios
        .get("/api/products")
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.data = res.data.products;
            this.categories = res.data.categories;
            this.subCategories = res.data.subCategories;
            this.skeleton = false;
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {});
    },
    store() {
      axios
        .post("/api/products", this.editedItem)
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.data.unshift(res.data);
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    update() {
      axios
        .put("/api/products/" + this.editedItem.id, this.editedItem)
        .then((response) => {
          var res = response.data;
          if (res.success) {
            Object.assign(this.data[this.editedIndex], this.editedItem);
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteItem() {
      axios
        .delete("/api/products/" + this.editedItem.id)
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.data.splice(this.editedIndex, 1);
            this.showSnack("success", "Данные успешно удалены !");
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
