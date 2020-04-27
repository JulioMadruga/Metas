var app = new Vue({
    el:"#app2",
    data: {
        showingAddModal: false,
        errorMessage: "",
        successMessage: "",
        numChecks : "",
        numChecksd : "",
        totChecks : "",
        numUsers: "",
        users:"",
        checksUser:"",

        clickedUser:{},
    },

    mounted: function(){
       // console.log("mounted");
        this.getAllUsers();
        this.getAllCheckGaroto();
        this.getAllCheckDisnorte();

    },
    methods: {
        getAllUsers: function(){

            axios.get("../api/panel.php?action=users")
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.users = response.data.users;
                        console.log(app.users);
                        app.numUsers = app.users.length;

                    }
                });
        },
        getAllCheckGaroto: function(){

            axios.get("../api/panel.php?action=garoto")
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.checks = response.data.checks;
                        //console.log(app.checks);
                        app.numChecks = app.checks[0].checks;

                    }
                });
        },
        getAllCheckDisnorte: function(){

            axios.get("../api/panel.php?action=disnorte")
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.checksd = response.data.checks;
                        //console.log(app.checksd);
                        app.numChecksd = app.checksd[0].checks;

                        app.totChecks = parseFloat(app.numChecks)  + parseFloat(app.numChecksd);
                    }
                });
        },

        async selectUser(user){
            app.clickedUser = user;
            console.log(app.clickedUser);

            var formData = app.toFormData(app.clickedUser);

            await axios.post("../api/panel.php?action=user", formData)
                .then(function(response){

                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.checksUser = response.data.checkUser;
                        console.log(app.checksUser);

                    }
                });

             $("#container0").fadeOut(2000);
            $("#container1").fadeOut(1000);
            $("#container2").fadeOut(900);

            $("#container3").show();
            $("#container4").show();


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