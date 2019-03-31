import Vue from "vue";
import { has, get, set } from "lodash";

export default Vue.extend({
    methods: {
        hasError(name) {
            return has(this.errors, name);
        },

        getError(name) {
            return get(this.errors, `${name}[0]`);
        },

        setError(name, value) {
            return set(this.errors, name, value);
        }
    },
});
