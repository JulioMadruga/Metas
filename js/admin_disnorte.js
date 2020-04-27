
var app = new Vue({
    el:"#app2",
    data: {
        showingAddModal: false,
        errorMessage: "",
        successMessage: "",
        numChecks : "",
        numChecksd : "",
        usuarios:{id:""},
        relMerchan: [],
        relMerchan2:[],
        arr: []

    },

    mounted: function(){
        console.log("mounted");

        this.getRelAllUser();
        this.getAllUsers();
        this.chart();
        this.chart2();
        this.chart3();



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
                        //console.log(app.users);
                        app.numUsers = app.users.length;

                    }
                });
        },


        PieChart:  function (data,data2) {

            var relMerchan2Array = "";
            app.arr = [];
           // console.log(data[0][1]);
            //console.log(data2[0][1]);

            if (data == undefined){
                app.getRelAllUser();
            }

            var arrayLength = data[0].length;

                        for (var i = 0; i < arrayLength; i++) {
                var item = {value: data[0][i] ,name:data2[0][i]};
                app.arr.push(item);
            }

            teste = ["mentos", "marilan", "casaredo", "pepsico", "batavo", "rich", "sta", "yasai", "bbrasil", "frimesa", "fleshmann"];

            //console.log(app.arr);

            var relMerchan2Array = Object.keys(app.relMerchan2).map(i => app.relMerchan2[i])

           // console.log(relMerchan2Array[0]);

            this.chart(relMerchan2Array[0],app.arr);
        },

        getRelUser: function(v){

            //console.log(v);

            var formData = app.toFormData(v);

            axios.post("../api/relatorios.php?action=merchan", formData)
                .then(function(response){
                    app.relMerchan = "";
                    app.relMerchan2 = "";

                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.relMerchan = response.data.relMerchan;
                        app.relMerchan2 = response.data.relMerchan2;
                        console.log(app.relMerchan);
                        console.log(app.relMerchan2);

                        app.PieChart(app.relMerchan,app.relMerchan2)

                    }
                });
        },

        getRelAllUser: function(){

            axios.get("../api/relatorios.php?action=read")
                .then(function(response){
                    app.relMerchan = "";
                    app.relMerchan2 = "";

                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.relMerchan = response.data.relMerchan;
                        app.relMerchan2 = response.data.relMerchan2;
                        //console.log(app.relMerchan);
                       // console.log(app.relMerchan2);

                        app.PieChart(app.relMerchan,app.relMerchan2)

                    }
                });
        },

        getRelUser: function(v){

            //console.log(v);

            var formData = app.toFormData(v);

            axios.post("../api/relatorios.php?action=merchan", formData)
                .then(function(response){
                    app.relMerchan = "";
                    app.relMerchan2 = "";

                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    } else{
                        app.relMerchan = response.data.relMerchan;
                        app.relMerchan2 = response.data.relMerchan2;
                        console.log(app.relMerchan);
                        console.log(app.relMerchan2);

                        app.PieChart(app.relMerchan,app.relMerchan2)

                    }
                });
        },




        chart: function(data, data2){





            var myChart = echarts.init(document.getElementById('main'),'macarons');

            // specify chart configuration item and data
            var option = {

                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                   // orient: 'vertical',
                    left: 'center',
                    bottom: 10,
                    data: data,
                },
                series : [
                    {
                        name: '',
                        type: 'pie',
                        radius : '40%',
                        center: ['50%', '35%'],
                        data: data2,

                        label:{
                            fontSize: 9
                        },

                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };


            // use configuration item and data specified to show chart
            myChart.setOption(option);

        },

        chart2: function(){

            var myChart = echarts.init(document.getElementById('main2'),'macarons');

            // specify chart configuration item and data
            var option = {

                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    left: 'center',
                    bottom: 10,
                    data: ['A','B','C','D','E','F']
                },
                series : [
                    {
                        name: 'PERCENTUAL',
                        type: 'pie',
                        radius : '40%',
                        center: ['50%', '35%'],
                        data:[
                            {value:10, name:'A'},
                            {value:20, name:'B'},
                            {value:30, name:'C'},
                            {value:15, name:'D'},
                            {value:10, name:'E'},
                            {value:15, name:'F'}
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };


            // use configuration item and data specified to show chart
            myChart.setOption(option);

        },

        chart3: function(){

            var myChart = echarts.init(document.getElementById('main3'),'macarons');

            // specify chart configuration item and data
            var option = {

                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    left: 'center',
                    bottom: 10,
                    data: ['A','B','C','D','E']
                },
                series : [
                    {
                        name: 'PERCENTUAL',
                        type: 'pie',
                        radius : '40%',
                        center: ['50%', '35%'],
                        data:[
                            {value:10, name:'A'},
                            {value:20, name:'B'},
                            {value:30, name:'C'},
                            {value:15, name:'D'},
                            {value:25, name:'E'}
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };


            // use configuration item and data specified to show chart
            myChart.setOption(option);

        },


        teste: function(sel){

            var opts = [],
                opt;
            var len = sel.options.length;
            for (var i = 0; i < len; i++) {
                opt = sel.options[i];

                if (opt.selected) {
                    opts.push(opt.value);
                   // alert(opt.value);
                }
            }

            app.usuarios.id = opts;
           console.log(app.usuarios);

            app.getRelUser(app.usuarios);

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

