<!-- Vue component -->
<template>
  <div>
    <v-select v-model="selected" multiple :options="options" @input="setSelected" />
    <input type="hidden" v-model="selected" name="groups" />
  </div>
</template>


<script>
import vSelect, { VueSelect } from 'vue-select'

Vue.component('v-select', vSelect);

export default {
    data() {
        return {
            options:[],
            selected:[],
            value: {
            },
            selectedValue: '',
        }
    },
     mounted() {
        if (this.$attrs.selected){
          this.$attrs.selected.forEach(element =>{
              this.selected.push(element);
          })
        }

         axios.get('/settings/userGroups/').then(response => {
             response.data.forEach(element => {
                 console.log("element [] - " + element.name);
               this.options.push(element.name)
             });
          });
      },
      methods: {
        setSelected() {
           console.log(this.selected)
        }
      }
}
</script>
