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
          <v-toolbar-title>Карусель</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-dialog v-model="dialog" max-width="750px">
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
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                      <v-col cols="6">
                        <v-col cols="12">
                          <v-text-field
                            v-model="editedItem.title"
                            label="Заголовок"
                            :rules="requiredText('Заголовок')"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="editedItem.description"
                            label="Описание"
                            :rules="requiredText('Описание')"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="editedItem.serial_number"
                            label="Порядковый номер"
                            :rules="requiredNumber('Порядковый номер')"
                          ></v-text-field>
                        </v-col>
                      </v-col>
                      <v-col cols="6">
                        <v-col cols="12">
                          <v-text-field
                            v-model="editedItem.link_name"
                            label="Название ссылки"
                            :rules="requiredText('Название ссылки')"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="editedItem.link"
                            label="Ссылка"
                            :rules="requiredText('Ссылка')"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="editedIndex>-1">
                          <v-file-input
                            accept="image/png, image/jpeg, image/bmp"
                            prepend-icon="mdi-camera"
                            label="Картинка"
                            v-model="editedItem.updImage"
                            :rules="updImageValidate()"
                          ></v-file-input>
                        </v-col>
                        <v-col cols="12" v-else>
                          <v-file-input
                            accept="image/png, image/jpeg, image/bmp"
                            prepend-icon="mdi-camera"
                            label="Картинка"
                            v-model="editedItem.image"
                            :rules="requiredImage('Картинка')"
                          ></v-file-input>
                        </v-col>
                        <v-col cols="10" v-if="editedIndex>-1 && editedItem.image!=''">
                          <v-img :src="'/storage/'+editedItem.image"></v-img>
                          <v-btn
                            x-small
                            color="error"
                            style="margin-top:5px"
                            @click="deleteImage"
                          >Удалить</v-btn>
                        </v-col>
                      </v-col>
                    </v-row>
                  </v-form>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error darken-1" text @click="close">Отмена</v-btn>
                <v-btn color="success darken-1" text @click="save">Сохранить</v-btn>
              </v-card-actions>
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
    directoryTypes: [],
    categories: [],
    headers: [
      { text: "Заголовок", value: "title", sortable: false },
      { text: "Описание", value: "description", sortable: false },
      { text: "Порядковый номер", value: "serial_number", sortable: false },
      { text: "Название ссылки", value: "link_name", sortable: false },
      { text: "Ссылка", value: "link", sortable: false },
      { text: "Действия", value: "actions", sortable: false },
    ],
    editedItem: {
      name: "",
      category_id: "",
      serial_number: "",
      in_index: false,
      image: null,
      updImage: null,
      delImage: null,
      directories: [],
    },
    defaultItem: {
      name: "",
      category_id: "",
      serial_number: "",
      in_index: false,
      image: null,
      updImage: null,
      delImage: null,
      directories: [],
    },
  }),
  created() {
    this.index();
  },
  methods: {
    index() {
      axios
        .get("/api/sliders")
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.data = res.data;
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
          .post("/api/sliders", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            var res = response.data;
            if (res.success) {
              this.showSnack("success", "Данные успешно добавлены !");
              this.data.unshift(res.data);
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
    update() {
      var validate = this.$refs.form.validate();
      if (validate) {
        var formData = this.getFormData();
        axios
          .post(
            "/api/sliders/" + this.editedItem.id + "?_method=PUT",
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
              this.showSnack("success", "Данные успешно изменены !");
              this.$set(this.data, this.editedIndex, res.data);
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
    getFormData() {
      var formData = new FormData();
      formData.append("title", this.editedItem.title);
      formData.append("description", this.editedItem.description);
      formData.append("serial_number", this.editedItem.serial_number);
      formData.append("image", this.editedItem.image);
      formData.append("link_name", this.editedItem.link_name);
      formData.append("link", this.editedItem.link);
      if (this.editedIndex > -1) {
        if (this.editedItem.updImage !== null) {
          formData.append("updImage", this.editedItem.updImage);
        }
        if (this.editedItem.delImage !== null) {
          formData.append("delImage", JSON.stringify(this.editedItem.delImage));
        }
      }
      return formData;
    },
    deleteItem() {
      var formData = this.getFormData();
      axios
        .post(
          "/api/sliders/" + this.editedItem.id + "?_method=DELETE",
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
            this.showSnack("success", "Данные успешно удалены !");
            this.data.splice(this.editedIndex, 1);
            this.close();
          } else {
            alert(res.msg);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteImage() {
      this.editedItem.delImage = this.editedItem.image;
      this.editedItem.image = "";
    },
    updImageValidate() {
      if (this.editedItem.delImage != null) {
        return this.requiredImage("Обложка");
      } else {
        return [];
      }
    },
  },
};
</script>