<template>
    <div class="alert alert-flash alert-dismissible fade show" :class="activeClass" role="alert" v-show="show">
        <strong>{{ title }}</strong> {{ body }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: ['message', 'alert', 'status'],
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
            if (this.status =='success'){
                this.activeClass = 'alert-success';
                this.title = 'Амжилттай!';
            }else{
                this.title = 'Анхаар!';
                this.activeClass = 'alert-danger';
            }
            this.flash (this.message, this.status);
        }
        window.events.$on('flash', (message, status) => this.flash(message, status));


    },
    methods:{
        flash(message, status){
            this.body = message;
            this.show = true;
            this.hide();
            if(status=='success'){
                this.title = 'Амжилттай!';
                this.activeClass = 'alert-success';
            }else{
                this.activeClass = 'alert-danger';
                this.title = 'Анхаар!';
            }
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
