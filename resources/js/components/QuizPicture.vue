<template>    
    <div>
        <input type="file" name="image" accept="image/*" @change="onChange">
        
        <img :src="image" class="img-fluid mt-2">        
    </div>
</template>

<script>
    export default {

        props: ['quiz'], 

        data(){
            return {
                image: '/storage/'+this.quiz.quiz_path
            }
        },

        methods:{
            onChange(e){

                if (! e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    this.image = e.target.result;
                }

                // this.persist(image);
            },

            // persist(image){
            //     let data = new FormData();

            //     data.append('image', image);

            //     axios.post(`/QuizzesController/store/${this.quiz.id}/upload`, data)
            //         .then(() => flash('Зураг хадгалагдлаа!'));
            // }
        }
        

    }
</script>