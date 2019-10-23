<template>
    <div class="container mt-5">
     <div class="container register">
        <form @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-md-9 register-right">                        
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a Employee</h3>
                        <div class="row register-form">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" v-model="form.name" class="form-control" placeholder="First Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" v-model="form.email" class="form-control" placeholder="Email *" value="" />
                                    <span class="text-danger" v-if="errors.email" id="input-1-live-feedback">
                                            {{errors.email[0]}}
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" v-model="form.password" class="form-control" placeholder="Password *" value="" />
                                </div>
                                <input type="submit" name="" value="Submit" class="btn btn-primary">                               
                            </div>                            
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
      </form>
    </div>

     <div class="mt-5">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="post in users" v-bind:post="post.id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.name }}</td>
                    <td>{{ post.email }}</td>
                    <td></td>
                    <td>
                        <button id="show-modal" @click="editItem(post.id)" class="btn btn-primary">Edit</button>
                        <button @click="deleteItem(post.id)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit User Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                
            </div>
                <div class="modal-body">
                    <form @submit.prevent="updateItem">
                        <div class="row">
                            <div class="col-md-12 register-right">                       
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                               
                                        <div class="row register-form">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" v-model="uform.uname" class="form-control" placeholder="First Name *" value="" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" readonly="true" v-model="uform.uemail" class="form-control" placeholder="Email *" value="" />
                                                    <span class="text-danger" v-if="errors.email" id="input-1-live-feedback">
                                                            {{errors.email[0]}}
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" v-model="form.password" class="form-control" placeholder="Password *" value="" />
                                                </div>
                                                <input type="hidden" v-model="form.id">
                                                <input type="submit" name="" value="Submit" class="btn btn-primary">                               
                                            </div>                            
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</template>



<script>

 const axios = require('axios');
  export default {    
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: ""   
        },
        uform:{            
          uname:'',
          uemail:''   
        },
        errors:[],
        users:[],
        update_user:[],
        show: true,
        id1:''
        
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()             
        axios.post('/register', this.form)
          .then((response) => {
            this.users = response.data;
            console.log(this.users[0]);
          })
          .catch((error)  => {
            this.errors = error.response.data.errors;           
          })        
       
      },
      getData(){
          axios.get('/getdata')
          .then((response) => {
            this.users = response.data;
            console.log(response.data);
          })
          .catch((error)  => {
            //this.errors = error.response.data.errors;           
          })          
       },
    deleteItem(id){       
        
          axios.delete('/register/'+id)
          .then((response) => {
            this.users = response.data;
            console.log(response);
          })
          .catch((error)  => {
            //this.errors = error.response.data.errors;           
          })          
       },
       editItem(id){   
        $("#edit-item").modal('show');
          axios.get('/register/'+id+'/edit')
          .then((response) => {
            this.uform.uname = response.data[0].name;
            this.uform.uemail = response.data[0].email;
            this.id1        = id;
            console.log(response.data);
          })
          .catch((error)  => {
            //this.errors = error.response.data.errors;           
          })          
       },
       updateItem(){   
       alert(this.uform);
        axios.put('/updatedata/'+this.id1,this.uform)
          .then((response) => {
            $("#edit-item").modal('hide');
            this.users = response.data;
            console.log(response);
          })
          .catch((error)  => {
            //this.errors = error.response.data.errors;           
          })          
       }
    },    
    mounted() {
       this.getData();     
    }
  }
</script>
