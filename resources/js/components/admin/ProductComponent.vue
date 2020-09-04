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
                <v-btn icon dark @click="modalCloseBtn">
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
                  <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                      <v-col cols="5">
                        <h5 class="productH5">Основные данные</h5>
                        <v-row>
                          <v-text-field
                            v-model="editedItem.name"
                            label="Название"
                            :rules="requiredText('Название')"
                          ></v-text-field>
                        </v-row>
                        <v-row>
                          <v-text-field
                            v-model="editedItem.price"
                            label="Цена"
                            :rules="requiredText('Цена')"
                          ></v-text-field>
                        </v-row>
                        <v-row>
                          <v-text-field
                            v-model="editedItem.count"
                            label="Кол-во"
                            :rules="requiredText('Кол-во')"
                          ></v-text-field>
                        </v-row>
                        <v-row>
                          <v-select
                            :items="categories"
                            item-value="id"
                            item-text="name"
                            v-model="editedItem.category_id"
                            label="Категория"
                            :rules="requiredList('Категория')"
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
                            :rules="requiredList('Подкатегория')"
                          ></v-select>
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
                        <!-- При изменении -->
                        <div v-if="editedIndex > -1">
                          <v-row>
                            <v-file-input
                              accept="image/png, image/jpeg, image/bmp"
                              prepend-icon="mdi-camera"
                              label="Обложка"
                              v-model="editedItem.updAvatar"
                              ref="avatar"
                            ></v-file-input>
                          </v-row>
                          <v-row v-if="editedItem.avatar.id!==undefined">
                            <v-col cols="4">
                              <v-img :src="'/storage/'+editedItem.avatar.path"></v-img>
                              <v-btn
                                x-small
                                color="error"
                                style="margin-top:5px"
                                @click="delImage(0,true)"
                              >Удалить</v-btn>
                            </v-col>
                          </v-row>
                          <v-row>
                            <v-file-input
                              accept="image/png, image/jpeg, image/bmp"
                              prepend-icon="mdi-camera"
                              multiple
                              label="Картинки"
                              v-model="editedItem.updImages"
                              ref="images"
                            ></v-file-input>
                          </v-row>
                          <v-row v-if="editedItem.images.length!=0">
                            <v-col cols="4" v-for="(item,i) in editedItem.images" :key="i">
                              <v-img :src="'/storage/'+item.path"></v-img>
                              <v-btn
                                x-small
                                color="error"
                                style="margin-top:5px"
                                @click="delImage(i)"
                              >Удалить</v-btn>
                            </v-col>
                          </v-row>
                        </div>
                        <!-- При добавлении -->
                        <div v-else>
                          <v-row>
                            <v-file-input
                              accept="image/png, image/jpeg, image/bmp"
                              prepend-icon="mdi-camera"
                              label="Обложка"
                              v-model="editedItem.avatar"
                              ref="avatar"
                              :rules="requiredImage('Обложка')"
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
                              :rules="requiredImage('Картинки')"
                            ></v-file-input>
                          </v-row>
                        </div>
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
                            :rules="requiredList(item.name)"
                          ></v-select>
                        </v-row>
                      </v-col>
                    </v-row>
                  </v-form>
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
      avatar: null,
      updAvatar: [],
      delAvatar: [],
      images: null,
      updImages: [],
      delImages: [],
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
      avatar: null,
      updAvatar: [],
      delAvatar: [],
      images: null,
      updImages: [],
      delImages: [],
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
      var validate = this.$refs.form.validate();
      if (validate) {
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
      }
    },
    editItem(item) {
      this.editedIndex = this.data.indexOf(item);
      this.editedItem = Object.assign(this.editedItem, item);
      this.setDirectories(false);
      var selDirectories = [];
      if (this.editedItem.directories[0] instanceof Object) {
        for (var key in this.editedItem.directories) {
          selDirectories.push(this.editedItem.directories[key].id);
        }
        this.editedItem.directories = selDirectories;
      }
      for (var key in this.editedItem.images) {
        var image = this.editedItem.images[key];
        if (image.avatar === 1) {
          this.editedItem.avatar = image;
          this.editedItem.images.splice(key, 1);
        }
      }
      this.dialog = true;
    },
    update() {
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
            this.$set(this.data, this.editedIndex, res.data[0]);
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
          directories = this.subCategories[key].directory_types;
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

      formData = this.getWithAppendedImages(formData);

      return formData;
    },
    getWithAppendedImages(formData) {
      //При изменении
      if (this.editedIndex > -1) {
        //Если есть новые картинки
        if (this.editedItem.updImages[0] !== undefined) {
          for (var key in this.editedItem.updImages) {
            formData.append("updImages[]", this.editedItem.updImages[key]);
          }
        }
        //Если есть удаленные картинки
        if (this.editedItem.delImages[0] !== undefined) {
          var delImages = [];
          for (var key in this.editedItem.delImages) {
            delImages.push({
              id: this.editedItem.delImages[key].id,
              path: this.editedItem.delImages[key].path,
            });
          }
          formData.append("delImages", JSON.stringify(delImages));
        }
        //Если добавлена новая обложка
        if (this.editedItem.updAvatar.lastModified !== undefined) {
          formData.append("updAvatar", this.editedItem.updAvatar);
        }
        if (this.editedItem.delAvatar.id !== undefined) {
          formData.append(
            "delAvatar",
            JSON.stringify({
              id: this.editedItem.delAvatar.id,
              path: this.editedItem.delAvatar.path,
            })
          );
        }
        formData.append("avatar", JSON.stringify(this.editedItem.avatar));
      }
      //При добавлении
      else {
        for (var key in this.editedItem.images) {
          formData.append("images[]", this.editedItem.images[key]);
        }
        formData.append("avatar", this.editedItem.avatar);
      }
      return formData;
    },
    delImage(i, avatar = false) {
      if (avatar === true) {
        this.editedItem.delAvatar = this.editedItem.avatar;
        this.editedItem.avatar = {};
      } else {
        this.editedItem.delImages.push(this.editedItem.images[i]);
        this.editedItem.images.splice(i, 1);
      }
    },
    modalCloseBtn() {
      this.dialog = false;
      this.deleteDialog = false;
      this.$nextTick(() => {
        this.editedItem.updImages = [];
        this.editedItem.updAvatar = [];
        if (this.editedItem.delImages[0] !== undefined) {
          for (var key in this.editedItem.delImages) {
            this.editedItem.images.unshift(this.editedItem.delImages[key]);
            this.editedItem.delImages.splice(key, 1);
          }
        }
        if (this.editedItem.delAvatar.id !== undefined) {
          this.editedItem.images.unshift(this.editedItem.delAvatar);
          this.editedItem.delAvatar = {};
        } else {
          this.editedItem.images.unshift(this.editedItem.avatar);
        }
        this.editedItem = Object.assign({}, this.defaultItem);
        this.$refs.form.resetValidation();
        this.editedIndex = -1;
      });
    },
    close() {
      this.dialog = false;
      this.deleteDialog = false;
      this.$nextTick(() => {
        this.editedItem.updImages = [];
        this.editedItem.updAvatar = [];
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
      this.$refs.form.resetValidation();
    },
  },
};
</script>
