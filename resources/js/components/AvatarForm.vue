 <template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <form method="POST" class="text-center" enctype="multipart/form-data">
                <div class="form-group row">                               
                    <div class="col-sm-12 ">
                        <img class="rounded-circle" :src="avatar" width="150" alt="Хэрэглэгчийн зураг">                                           
                        <div class="text-center" >
                            <input type="file" name="avatar" accept="image/*" @change="onChange">   
                        </div>
                    </div>      
                </div>
                </form>                                         
            </div>
        </div>
    </div>
     
 </template>

<script>  
      export default {

        props: ['user'],

        data() {
            return {
                avatar: ''
            };
        }, 

        methods: {
            onChange(e) {
               
                if (! e.target.files.lenght) return ;

                let avatar = e.target.files[0];
                
                let reader = new FileReader();

                reader.readAsDataURL(avatar);

                reader.onload = e =>{
                    console.log(e);
                    this.avatar = e.target.result;
                };
                
                // Persist to the server 
                this.persist(file);

            },

            persist(avatar){

                console.log('Persist called clicked');

                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/users/avatar`, data)
                    .then(()=> flash('Avatar uploaded!'));
            }

        }


     }
</script>


