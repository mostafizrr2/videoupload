
<template>
    <div class="container">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
        :data-target="['#'+fieldForm]" @click='onClick(fieldValue)'>
           Upload media
        </button>

        <!-- Modal -->
        <div class="modal fade" :id="fieldForm" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" :href="['#upload-'+ fieldForm]">
                        Upload
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" :href="['#media-'+ fieldForm]">
                        Library
                    </a>
                </li>
     
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show" :id="['upload-'+ fieldForm]">
                    <div class="mediaContainer">
                       <upload-component ></upload-component>
                    </div>
                </div>

                <div class="tab-pane fade show active" :id="['media-'+ fieldForm]">
                  <div class="mediaContainer">
                   <div class="row">
                       <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"  v-for="mediaFile in mediaFiles">
                            <img class="img-thumbnail mediaThumb" 
                            @click="slectImage(mediaFile.file_name)"
                            title="Select the image"
                            :src="['http://videoupload.test/storage/uploads/'+mediaFile.file_name]">
                       </div>
                   </div>
                   </div> 
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>


    </div>
</template>


<script>
    export default {
       props:[ 'field'],
       data() {
          return {
              fieldValue: "",
              fieldForm:"",
              mediaFiles: [],
              url: window.location.origin+window.location.pathname,
              postImage: "",
          }
       },

       mounted() {
            axios.get('image-library/')
                .then(respons => {
                      console.log(respons.data);
                      this.mediaFiles = respons.data;
                })
                   .catch(function(e){
                      console.log(e);
                 });
       },

       methods: {
           
            onClick: function(res){
              this.fieldValue = this.fieldProps;
              this.fieldForm = this.field;
            },
            
            slectImage: function(id){
                 var image = "";
                 var imageValue = "";
                 var editor = "";

                if(this.field == "featured"){
                    image = document.getElementById('featuredImage');
                    imageValue = document.getElementById('featuredImageValue');

                    image.src = 'http://videoupload.test/storage/uploads/'+id;
                    imageValue.value = 'http://videoupload.test/storage/uploads/'+id;

                }else if(this.field == "post"){
                    image = document.getElementById('postImage');
                    imageValue = document.getElementById('postImageValue');

                    var textarea_img = 
                    '<img style="height:auto; width:100%" src="http://videoupload.test/storage/uploads/'+id+'" />';
                    tinyMCE.execCommand('mceInsertContent', false, textarea_img); 

                }else if(this.field == "portfolio"){
                    image = document.getElementById('portfolioImage');
                    imageValue = document.getElementById('portfolioImageValue');

                    image.src = 'http://videoupload.test/storage/uploads/'+id;
                    imageValue.value = 'http://videoupload.test/storage/uploads/'+id;
                }

                $('#'+this.fieldForm).modal('hide');
            }
       },
    }
</script>

<style>
    .mediaContainer{
        margin: 20px;
        overflow-y: scroll;
        overflow-x: hidden;
        height: 360px;
    }
    .mediaThumb{
        width:100%;
        height:90%;
        cursor: pointer;
    }
    #postImage{
        widows: 100%;
    }
</style>

