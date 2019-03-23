<template>
    <div class="container">
        <input @change="onChange()"  type="file" name="file" id="file"> 
        <br> <br> 

        <div id="progress" style="display:none;">
            <progress :value="percent" max="100" style="width:100%;"></progress> 

            <p v-if="currentName != null">Uploading: {{ currentName }}</p>
            {{ message }}
            <br><br>
        </div> 

     

    <form :action="action" method="POST">
      <input type="hidden" name="_token" :value="csrf">
      <input type="hidden" name="video" :value="fileName">
      <input type="text" name="name">
      <input type="submit" value="Submit">
    </form> 

    </div>
</template>

<script>
    export default {
        props: ['route', 'action', 'csrf'],
        data : function() {
            return {
               message: "",
               loaded:0,
               total:0,
               percent:0,
               fileName: "", 
               currentName: "",
            }
            
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            onChange: function(){
                
                var _this = this;

                var data = new FormData();

                var progress = document.getElementById('progress');
                    progress.style.display = "block";

                var file = document.getElementById("file");

                var fileName = file.files[0].name;

                this.currentName = fileName;
                
                var ext = fileName.split('.');
                var ext = ext.pop();

                console.log(ext);

                // if(ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "zip" ){

                    var form_data = new FormData();
                    form_data.append('file',file.files[0], file.files[0].name); 

                    axios.post(_this.route, form_data, {

                            onUploadProgress: function(uploadEvent){

                            // console.log(uploadEvent.loaded);
                                var uploaded_memory = "";
                                var total_memory = "";
                                var _loaded = uploadEvent.loaded;
                                var _total = uploadEvent.total;

                                var _percent = Math.round( ( _loaded / _total )*100 ); 
                                _this.percent = _percent;

					     //Math for Uploaded counter
	                        if ( _loaded < 1000000){
	                        	 _this.loaded = Math.round( _loaded / 1000 );         
	                            uploaded_memory = "kb";
	                        }
	                        else if ( _loaded > 1000000){
	                            _this.loaded = Math.round( ( _loaded / 1000 ) / 1000 );
	                            uploaded_memory = "mb";
	                        }  

                         //Math for total counter         
	                        if ( _total < 1000000){
                                _this.total = Math.round( _total / 1000 ); 
	                            total_memory = "kb";
	                        }
	                        else if ( _total > 1000000){
	                            _this.total = Math.round( ( _total/ 1000 ) / 1000 ); 
	                            total_memory = "mb";
	                        }                          


                             _this.message =  _this.loaded + uploaded_memory +" / " + _this.total + total_memory  
                                            + " (" +  _this.percent +"%) complete";

                            }
                        })
                        .then(function(response){
                            console.log(response.data.success);
                            _this.message = response.data.success;
                            _this.fileName = response.data.file_name;
                        })
                        .catch(function(e){
                            console.log(e);
                        });
                // }else{
                //      _this.message = "Oppss! file not supported.";
                // }


            }
        },
    }
</script>
