var app = new Vue({
    el: "#app",
    data: {
        rua: "",
        bairro: "",
        city: "",
        uf: "",
        cep: "56302000",
        error: ""
    },
    methods: {
        getCity: function() {
            var self = this;
            $.getJSON("https://viacep.com.br/ws/" + this.cep+"/json", function(result) {
                if (("erro" in result)) {
                    self.error = "CEP não encontrado";
                    self.city = "";

                } else {
                    self.city = result.localidade
                    self.rua = result.logradouro
                    self.bairro = result.bairro
                    self.uf = result.uf

                }
                console.log(result);
            });
        }
    },
    watch: {
        cep: function() {
            if (this.cep.length === 8) {
                this.getCity();
                this.error = "";
                $(".error").removeClass("no");
            }
            if (this.cep.length < 8) {
                this.city = "";
                this.error = "CEP Inválido";
                $(".error").addClass("no");
                $(".display").removeClass("animated fadeInDown");
            }
        }
    },
    mounted: function(){
        this.getCity();
    }
})
