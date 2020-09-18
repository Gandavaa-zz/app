<template>
    <div>
        <div v-for="(form, index) in forms" >
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="num"></label>
                <div  class="col-md-6">{{ index }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" :for="form.input.id">{{form.input.label}}</label>
                <div class="col-md-6">
                    <input class="form-control" :name="form.input.name" :id="form.input.id" v-model="form.input.value"></input>          
                </div>
            </div>
            <div class="form-group row">            
                <label class="col-md-4 col-form-label text-md-right" :for="form.textarea.id">{{form.textarea.label}}</label>
                <div class="col-md-6">
                    <textarea :name="form.textarea.name" class="form-control" :id="form.textarea.id" v-model="form.textarea.value">{{ form.textarea.value }}</textarea>          
                </div>
            </div>
            <div class="form-group row">  
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6 text-md-right">                            
                    <a class="form-control btn btn-danger mt-4" @click="RemoveForm(index)"><i class="cil-trash"></i></a>
                </div>
            </div>
        </div>
        <div class="form-group  row">
            <div class="col-md-12 text-md-center">
                <a class="right btn btn-primary" style="color:#fff !important" @click="addInput">Хэсэг нэмэх</a>
            </div>
        </div>
    </div>

</template>

<script>    
    export default {
        data(){
            return  {                
                counter: 0,
                forms: [{ 
                    input: {
                    id: 'part_id',
                    name: 'part_title[]',
                    label: 'Гарчиг',
                    value: '',
                    }, 
                    textarea: {
                        id:'title0',
                        name:'part_info[]',
                        label: 'Хэсгийн мэдээлэл',
                        value: '',
                    }
                }]     
            }            
        },
        methods: {
            addInput() {
                this.forms.push({                     
                     input:{
                        id: `part_id${++this.counter}`,
                        name: 'part_title[]',
                        label: 'Хэсгийн гарчиг',
                        value: ''
                    },
                     textarea: {
                        id: `info${this.counter}`,
                        name: 'part_info[]',
                        label: 'Хэсгийн мэдээлэл',
                        value: '',
                    }
                })                
            }, 
            RemoveForm(index){                
                if(this.forms.length > 1){
                    this.forms.splice(index, 1)
                }else 
                    alert(" Уучлаарай устгах боломжгүй")
            }
        }
    }
</script>

