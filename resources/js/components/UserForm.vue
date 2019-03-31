<template>
  <div>
    <b-form @submit.prevent="onSubmit" @reset.prevent="onReset">
      <b-form-group id="nameInputGroup" label="Name" label-for="nameInput">
        <b-form-input
          id="nameInput"
          type="text"
          name="name"
          :state="validateState('name')"
          v-model="data.name"
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
          v-model="data.email"
          v-validate="'required'"
          placeholder="Enter email"
        />
        <b-form-invalid-feedback :state="!validateState('email')">{{ errors.first('email') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-button btn-block type="submit" variant="primary">Submit</b-button>
      <b-button btn-block type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
const defaultForm = {
  id: "",
  name: "",
  email: ""
};

export default {
  props: {
    form: {
      type: Object,
      default: () => defaultForm
    }
  },
  data() {
    return {};
  },
  computed: {
    data: {
      get() {
        return this.form || defaultForm;
      },
      set(value) {
        this.$emit("input", value);
      }
    }
  },
  methods: {
    onReset(event) {
      // this.$validator.reset().then(() => {
      this.$emit("reset", event);
      // });
    },
    onSubmit(event) {
      // this.$validator.validateAll().then(validated => {
      // if (validated) {
      this.$emit("submit", event);
      // }
      // });
    },
    validateState(ref) {
      if (
        this.veeFields[ref] &&
        (this.veeFields[ref].dirty || this.veeFields[ref].validated)
      ) {
        return !this.errors.has(ref);
      }
      return null;
    }
  }
};
</script>
