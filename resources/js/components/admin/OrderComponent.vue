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
          <v-toolbar-title>Заказы</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-dialog v-model="dialog" max-width="350px">
            <template v-slot:activator="{ on }">
              <v-row>
                <v-col cols="8"></v-col>
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
                  <v-form ref="form" v-model="valid" lazy-validation></v-form>
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
    headers: [
      { text: "Номер заказа", value: "name", sortable: false },
      { text: "ФИО клиента", value: "serial_number", sortable: false },
      { text: "Тип заказа", value: "in_index", sortable: false },
      { text: "Тип доставки", value: "actions", sortable: false },
      { text: "Статус оплаты", value: "actions", sortable: false },
      { text: "Статус доставки", value: "actions", sortable: false },
      { text: "Дата заказа", value: "actions", sortable: false },
    ],
    editedItem: {
      name: "",
      serial_number: 0,
      in_index: false,
    },
    defaultItem: {
      name: "",
      serial_number: 0,
      in_index: false,
    },
  }),
  watch: {
    "editedItem.in_index": function (val) {
      if (val) {
        this.editedItem.serial_number = 1;
      } else {
        this.editedItem.serial_number = 0;
      }
      console.log(this.editedItem.serial_number);
    },
  },
  created() {
    // this.index();
    this.skeleton = false;
  },
  methods: {
    index() {
      axios
        .get("/api/categories")
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
        axios
          .post("/api/categories", this.editedItem)
          .then((response) => {
            var res = response.data;
            if (res.success) {
              res.data.in_index = Number(res.data.in_index);
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
      axios
        .put("/api/categories/" + this.editedItem.id, this.editedItem)
        .then((response) => {
          var res = response.data;
          if (res.success) {
            this.editedItem.in_index = Number(this.editedItem.in_index);
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
        .delete("/api/categories/" + this.editedItem.id)
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
    serialNumber() {
      if (this.editedItem.in_index) {
        return this.requiredNumber("Порядковый номер");
      } else {
        return [];
      }
    },
  },
};
</script>
