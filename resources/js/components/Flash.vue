<template>
    <div class="alert alert-flash alert-dismissible fade show" :class="activeClass" role="alert" v-show="show">
        <strong>{{ title }}</strong> {{ body}} !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: ['message', 'alert'],
    data() {
        return {
            activeClass: '',
            title: '',         
            body: '',
            show: false            
        }
    },
    created() {
       
        if (this.message){
            this.flash (this.message); 
        }
        this.activeClass = this.alert; 
        if (this.alert =='alert-success') this.title = 'Амжилттай!';
        else this.title = 'Анхаар!';
        
        window.events.$on('flash', message => this.flash(message));
    },
    methods:{
        flash(message){
            this.body = message;
            this.show = true;
            this.hide();
        },

        hide(){            
            setTimeout(() =>{
                this.show = false;                
            }, 15000);
        }
    }
};
</script>

<style>

    .alert-flash{
        z-index: 9999;
        position: fixed;
        right: 25px;
        top: 65px;
    }

</style>