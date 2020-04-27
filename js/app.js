var app = new Vue({
    el: "#app2",
    data: {
        showingAddModal: false,
        errorMessage: "",
        successMessage: "",
         newUser: {email: "", cargo: "", senha: "", senha2: "", ind: "Garoto" },
        clickedUser: {},
        erroLogin: false,



    },

    mounted: function(){
        console.log("mounted");
       // this.getAllUsers();
        //this.getUser(user);

    },

    methods: {

        getLogin: function(){
            app.erroLogin = false;
            console.log(app.newUser);
            var formData = app.toFormData(app.newUser);


            axios.post("./api/login.php?action=login", formData)
                .then(function(response){

                  console.log(response.data.error);

                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.users = response.data.users;
                        console.log(app.users);

                        if(app.users.length === 1){

                            if(app.newUser.ind === "Garoto"){

                              if(app.users[0].tipo === "admin"){

                                  window.location.href = './admin/load.php';

                              }else {

                                 window.location.href = './painel.php';
                              }


                            }else {

                                window.location.href = './marilan/index.php';

                            }

                          //


                        }else {

                            app.erroLogin = true;
                        }


                    }
                });
        },



        toFormData: function(obj){
            var form_data = new FormData();
            for ( var key in obj ) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function(){
            app.errorMessage = "";
            app.successMessage = "";
        }
    }
});