<template>
  <b-container fluid>
    <b-alert :show="alert.show" dismissible :variant="alert.type">{{ alert.message }}</b-alert>
    <b-card>
      <b-row>
        <b-col xs="12" sm="4" md="3" class="mb-2">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search"/>
          </b-input-group>
        </b-col>

        <b-col sm="4" md="1" class="mb-2">
          <b-form-select :options="pageOptions" v-model="perPage"/>
        </b-col>

        <b-col sm="4" offset-md="6" md="2" class="mb-2">
          <b-button @click="showModalItem(defaultForm, 'create')" block>Add User</b-button>
        </b-col>
      </b-row>

      <b-table
        id="tableUser"
        ref="table"
        responsive
        show-empty
        :items="itemsProdiver"
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        :filter="filter"
      >
        <template slot="actions" slot-scope="{ item }">
          <b-button
            size="sm"
            @click="showModalItem(item, 'update', $event.target)"
            class="mr-1"
          >Modify</b-button>
          <b-button
            size="sm"
            @click="showModalItem(item, 'delete', $event.target)"
            class="mr-1"
          >Delete</b-button>
        </template>
      </b-table>

      <b-row>
        <b-col md="6" class="my-1">
          <b-pagination
            :total-rows="totalRows"
            :per-page="perPage"
            v-model="currentPage"
            class="my-0"
          />
        </b-col>
      </b-row>
    </b-card>

    <b-modal id="modalUser" hide-footer :title="modalUser.title" @hide="resetUser">
      <b-form @submit.prevent="submitUser" @reset.prevent="resetUser">
        <b-form-group id="nameInputGroup" label="Name" label-for="nameInput">
          <b-form-input
            id="nameInput"
            type="text"
            name="name"
            :state="validateState('name')"
            v-model="form.name"
            v-validate="'required'"
            placeholder="Enter name"
          />
          <b-form-invalid-feedback :state="!validateState('name')">{{ errors.first('name') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group
          id="emailInputGroup"
          label="Email"
          label-for="emailInput"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="emailInput"
            type="text"
            name="email"
            :state="validateState('email')"
            v-model="form.email"
            v-validate="'required|email'"
            placeholder="Enter email"
          />
          <b-form-invalid-feedback :state="!validateState('email')">{{ errors.first('email') }}</b-form-invalid-feedback>
        </b-form-group>
        <b-button btn-block type="submit" variant="primary">Submit</b-button>
        <b-button btn-block type="reset" variant="danger">Reset</b-button>
      </b-form>
    </b-modal>
  </b-container>
</template>

<script>
import get from "lodash/get";

export default {
  data() {
    return {
      form: {
        id: "",
        name: "",
        email: ""
      },
      defaultForm: {
        id: "",
        name: "",
        email: ""
      },
      isBusy: false,
      items: [],
      itemAction: "create",
      fields: [
        { key: "id", label: "Id", sortable: true, sortDirection: "desc" },
        { key: "name", label: "Name", sortable: true, sortDirection: "asc" },
        { key: "email", label: "Email", sortable: true, sortDirection: "asc" },
        {
          key: "token",
          label: "Security-Code",
          sortable: true,
          sortDirection: "asc"
        },
        { key: "actions", label: "Actions", class: "text-center" }
      ],
      detailFields: ["id", "name", "email", "created_at", "updated_at"],
      currentPage: 1,
      perPage: 5,
      totalRows: 1,
      pageOptions: [5, 10, 15, 25, 50],
      sortBy: null,
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      modalUser: { title: "", okTitle: "Save", cancelTitle: "Cancel" },
      modalTitles: {
        create: "Create User",
        update: "Update User",
        delete: "Delete User"
      },
      modelOkTitles: {
        create: "Create",
        update: "Update",
        delete: "Delete"
      },
      alert: {
        show: false,
        type: "success",
        message: ""
      }
    };
  },
  methods: {
    handlerError(err) {
      console.log(err.response.data.errors);

      const names = get(err, "response.data.errors.name", []);
      const emails = get(err, "response.data.errors.email", []);

      if (names.length > 0) {
        names.map(name => {
          this.errors.add({
            field: "name",
            msg: name
          });
        });
      }

      if (emails) {
        emails.map(email => {
          this.errors.add({
            field: "email",
            msg: email
          });
        });
      }

      // const error = {
      //   field: 'Field name',
      //   msg: 'Error message',
      //   rule: 'Rule Name', // optional
      //   scope: 'Scope Name', // optional
      //   regenerate: () => 'some string', // optional
      //   id: 'uniqueId' // optional
      // };

      this.alert = {
        show: true,
        type: "danger",
        message: `${this.itemAction} failured`
      };
    },

    handleResponse(res) {
      this.$root.$emit("bv::hide::modal", "modalUser");
      this.$root.$emit("bv::refresh::table", "tableUser");
      this.alert = {
        show: true,
        type: "success",
        message: `${this.itemAction} successfully`
      };
    },

    resetUser(event) {
      console.log("resetUser(event): ", this.itemAction, event);
      this.$validator.reset();
      // this.$root.$emit("bv::hide::modal", "modalUser");
    },

    submitUser(event) {
      console.log("errors: ", this.errors);
      this.$validator.validateAll().then(validated => {
        console.log("validated: ", validated);
        if (validated) {
          switch (this.itemAction) {
            case "create":
              axios
                .post(baseUrl + "/users", this.form)
                .then(this.handleResponse)
                .catch(this.handlerError);
              break;

            case "update":
              axios
                .put(baseUrl + "/users/" + this.form.id, this.form)
                .then(this.handleResponse)
                .catch(this.handlerError);
              break;

            case "delete":
              axios
                .delete(baseUrl + "/users/" + this.form.id, this.form)
                .then(this.handleResponse)
                .catch(this.handlerError);
              break;
          }
        }
      });
    },

    validateState(ref) {
      if (
        this.veeFields[ref] &&
        (this.veeFields[ref].dirty || this.veeFields[ref].validated)
      ) {
        return !this.errors.has(ref);
      }
      return null;
    },

    showModalItem(item, action) {
      this.form = item;
      this.itemAction = action;
      this.modalUser.title = this.modalTitles[action];
      this.modalUser.okTitle = this.modelOkTitles[action];
      console.log("this.modalUser: ", this.modalUser);
      this.$root.$emit("bv::show::modal", "modalUser");
    },

    loadItems(ctx = {}) {
      console.log("loadItems");
      const params = {
        page: get(ctx, "currentPage", 1),
        size: get(ctx, "perPage", 10),
        sort: get(ctx, "sortBy", "id"),
        desc: get(ctx, "sortDesc", true),
        filter: get(ctx, "filter", "")
      };
      return axios
        .get(baseUrl + "/users", { params })
        .then(res => {
          const items = res.data.data;
          this.totalRows = res.data.total;
          return items || [];
        })
        .catch(err => []);
    },

    itemsProdiver(ctx) {
      return this.loadItems(ctx);
    }
  }
};
</script>
