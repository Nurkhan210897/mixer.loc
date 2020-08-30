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
                  <v-btn dark text @click="save">Сохранить</v-btn>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="5">
                      <h5 class="productH5">Основные данные</h5>
                      <v-row>
                        <v-text-field v-model="editedItem.name" label="Название"></v-text-field>
                      </v-row>
                      <v-row>
                        <v-text-field v-model="editedItem.price" label="Цена"></v-text-field>
                      </v-row>
                      <v-row>
                        <v-text-field v-model="editedItem.count" label="Кол-во"></v-text-field>
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
                          :items="filteredSubCategories"
                          item-value="id"
                          item-text="name"
                          v-model="editedItem.sub_category_id"
                          label="Подкатегория"
                          @change="setDirectories"
                        ></v-select>
                      </v-row>
                      <v-row>
                        <v-file-input
                          accept="image/png, image/jpeg, image/bmp"
                          prepend-icon="mdi-camera"
                          label="Обложка"
                          v-model="editedItem.avatar"
                          ref="avatar"
                        ></v-file-input>
                      </v-row>
                      <v-row>
                        <v-file-input
                          accept="image/png, image/jpeg, image/bmp"
                          prepend-icon="mdi-camera"
                          multiple
                          label="Картинки"
                          v-model="editedItem.images"
                          ref="images"
                        ></v-file-input>
                      </v-row>
                      <v-row>
                        <v-col cols="5">
                          <v-row>
                            <v-text-field v-model="editedItem.weight" label="Вес"></v-text-field>
                          </v-row>
                          <v-row>
                            <v-text-field v-model="editedItem.length" label="Длина"></v-text-field>
                          </v-row>
                        </v-col>
                        <v-col cols="1"></v-col>
                        <v-col cols="5">
                          <v-row>
                            <v-text-field v-model="editedItem.width" label="Ширина"></v-text-field>
                          </v-row>
                          <v-row>
                            <v-text-field v-model="editedItem.height" label="Высота"></v-text-field>
                          </v-row>
                        </v-col>
                      </v-row>
                    </v-col>
                    <v-col cols="2"></v-col>
                    <v-col cols="5">
                      <h5 class="productH5">Технические характеристики</h5>
                      <v-row v-for="(item,i) in directories" :key="i">
                        <v-select
                          :items="item.directories"
                          item-value="id"
                          item-text="name"
                          v-model="editedItem.directories[i]"
                          :label="item.name"
                        ></v-select>
                      </v-row>
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
      { text: "Цена", value: "price", sortable: false },
      { text: "Кол-во", value: "count", sortable: false },
      { text: "Категория", value: "category.name", sortable: false },
      { text: "Подкатегория", value: "sub_category.name", sortable: false },
      { text: "Действия", value: "actions", sortable: false },
    ],
    test: "",
    categories: [],
    subCategories: [],
    filteredSubCategories: [],
    directories: [],
    editedItem: {
      name: "",
      price: "",
      count: "",
      weight: "",
      height: "",
      length: "",
      category_id: "",
      sub_category_id: "",
      directories: [],
      avatar: [],
      images: [],
    },
    defaultItem: {
      name: "",
      price: "",
      count: "",
      weight: "",
      height: "",
      length: "",
      category_id: "",
      sub_category_id: "",
      directories: [],
      avatar: [],
      images: [],
    },
  }),
  watch: {
    "editedItem.category_id"(id) {
      this.filteredSubCategories = this.subCategories.filter(function (item) {
        return item.category_id == id;
      });
    },
  },
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
            this.filteredSubCategories = this.subCategories;
            this.skeleton = false;
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {});
    },
    store() {
      var formData = this.getFormData();
      axios
        .post("/api/products", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.showSnack("success", "Данные успешно добавлены!");
            this.data.unshift(res.data[0]);
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    editItem(item) {
      this.editedIndex = this.data.indexOf(item);
      this.editedItem = Object.assign(this.editedItem, item);
      this.setDirectories(false);
      var selDirectories = [];
      if (this.editedItem.directories[0] instanceof Objectf) {
        for (var key in this.editedItem.directories) {
          selDirectories.push(this.editedItem.directories[key].id);
        }
        this.editedItem.directories = selDirectories;
      }
      this.dialog = true;
    },
    update() {
      console.log(this.editedItem);
      var formData = this.getFormData();
      axios
        .post(
          "/api/products/" + this.editedItem.id + "?_method=PUT",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.showSnack("success", "Данные успешно изменены!");
            Object.assign(this.data[this.editedIndex], this.editedItem);
            this.close();
          } else {
            // alert(res.msg);
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
            this.showSnack("success", "Данные успешно удалены!");
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    setDirectories(newDirectories = true) {
      if (newDirectories === true) {
        this.editedItem.directories = [];
      }
      var id = this.editedItem.sub_category_id;
      var directories;
      for (var key in this.subCategories) {
        if (Number(this.subCategories[key].id) === Number(id)) {
          directories = this.subCategories[key].directories;
          break;
        }
      }
      axios
        .get("/api/products/directories", {
          params: {
            directories: directories,
          },
        })
        .then((response) => {
          var res = response.data;
          this.directories = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getFormData() {
      var formData = new FormData();
      formData.append("name", this.editedItem.name);
      formData.append("price", this.editedItem.price);
      formData.append("count", this.editedItem.count);

      formData.append("weight", this.editedItem.weight);
      formData.append("height", this.editedItem.height);
      formData.append("width", this.editedItem.width);
      formData.append("length", this.editedItem.length);

      formData.append("category_id", this.editedItem.category_id);
      formData.append("sub_category_id", this.editedItem.sub_category_id);
      formData.append("directories", this.editedItem.directories);
      for (var key in this.editedItem.images) {
        formData.append("images[]", this.editedItem.images[key]);
      }
      formData.append("avatar", this.editedItem.avatar);
      return formData;
    },
  },
};
</script>
