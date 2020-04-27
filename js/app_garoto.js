var app = new Vue({
    el:"#app2",
    data: {
        showingAddModal: false,
        errorMessage: "",
        successMessage: "",
        numChecks : "",
        numChecksd : "",

    },

    mounted: function(){
       // console.log("mounted");
        this.getAllUsers();

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