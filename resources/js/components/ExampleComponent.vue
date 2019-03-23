<template>
    <div class="container">
      <br>
      <!-- <h1>{{ message }}</h1> -->
       <p>{{message}}</p>
    </div>
</template>

<script>
    export default {
        props: ['title'],
        data : function() {
            return {
                message: "",
            }         
            
        },
        mounted: function(){
             this.message = this.title;
        },

    


    }
</script>
