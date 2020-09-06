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
      <template v-slot:item.status="{ item }">
        <span>{{statusTableName(item.status)}}</span>
      </template>
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Вопросы клиентов</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-dialog v-model="dialog" max-width="500px">
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
                  <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                      <v-col cols="12">
                        <v-select
                          :items="statusList"
                          item-value="id"
                          item-text="name"
                          v-model="editedItem.status"
                          label="Статус"
                        ></v-select>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field v-model="editedItem.name" label="Полное имя" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field v-model="editedItem.name" label="Email" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-textarea v-model="editedItem.name" label="Текст вопроса" readonly></v-textarea>
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
    headers: [
      { text: "Полное имя", value: "name", sortable: false },
      { text: "Email", value: "email", sortable: false },
      { text: "Текст вопроса", value: "question", sortable: false },
      { text: "Статус", value: "status", sortable: false },
      { text: "Дата", value: "created_at", sortable: false },
      { text: "Действия", value: "actions", sortable: false },
    ],
    statusList: [
      {
        id: 0,
        name: "Не ответили",
      },
      {
        id: 1,
        name: "Ответили",
      },
    ],
    editedItem: {
      name: "",
      email: "",
      question: "",
      status: 0,
    },
    defaultItem: {
      name: "",
      email: "",
      question: "",
      status: 0,
    },
  }),
  created() {
    this.index();
  },
  methods: {
    index() {
      axios
        .get("/api/questions")
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
    update() {
      axios
        .put("/api/questions/" + this.editedItem.id, this.editedItem)
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
        .delete("/api/questions/" + this.editedItem.id)
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
    statusTableName(status) {
      if (Number(status) == 1) {
        return "Ответили";
      } else {
        return "Не ответили";
      }
    },
  },
};
</script>
