<!-- Vue component -->
<template>
  <div>
    <v-select
      v-model="selected"
      multiple
      :options="options"
      @input="setSelected"
    />
    <input type="hidden" v-model="selected" name="permissions" />
  </div>
</template>


<script>
import vSelect, { VueSelect } from "vue-select";

Vue.component("v-select", vSelect);

export default {
  inheritAttrs: false,
  props: ["values"],
  data() {
    return {
      options: [],
      selected: [],
      value: {},
      selectedValue: "",
    };
  },
  mounted() {
    if (this.$attrs.selected) {
      this.$attrs.selected.forEach((element) => {
        this.selected.push(element);
      });
    }

    axios.get("/settings/getPermissions").then((response) => {
      response.data.forEach((element) => {
        this.options.push(element.name);
      });
    });
  },

  methods: {
    setSelected() {
      console.log(this.selected);
    },
  },
};
</script>
