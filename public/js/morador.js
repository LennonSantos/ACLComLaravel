Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({

  el: '#manage-vue',


  data: {
    moradores: [],
    pagination: {
        total: 0, 
        per_page: 2,
        from: 1, 
        to: 0,
        current_page: 1
      },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newMorador : {'id_unidade':'','data_entrada':'','nome_completo':'','cpf':'','rg':'','telefone_1':'','telefone_2':'','telefone_3':'','profissao':'','data_nascimento':'','sexo':'','email':''},
    fillMorador : {'id_unidade':'','data_entrada':'','nome_completo':'','cpf':'','rg':'','telefone_1':'','telefone_2':'','telefone_3':'','profissao':'','data_nascimento':'','sexo':'','email':'','id':''}
  },

  computed: {
        isActived: function () {
            return this.pagination.current_page;
        },

        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;

            if (from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);

            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];

            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

  ready : function(){
  		this.getVueMoradores(this.pagination.current_page);
  },

  methods : {

        getVueMoradores: function(page){
          this.$http.get('/morador?page='+page).then((response) => {
            this.$set('moradores', response.data.data.data);
            this.$set('pagination', response.data.pagination);
          });
        },

        createMorador: function(){

		  var input = this.newMorador;

		  this.$http.post('/morador/create',input).then((response) => {

		    this.changePage(this.pagination.current_page);

			this.newMorador = {'id_unidade':'','data_entrada':'','nome_completo':'','cpf':'','rg':'','telefone_1':'','telefone_2':'','telefone_3':'','profissao':'','data_nascimento':'','sexo':'','email':''};

			$("#create-morador").modal('hide');

			toastr.success('Morador criado com sucesso!', 'Success Alert', {timeOut: 5000});

		  }, (response) => {

			this.formErrors = response.data;

	    });

	},


      deleteMorador: function(item){

        this.$http.delete('/morador/'+item.id).then((response) => {

            this.changePage(this.pagination.current_page);

            toastr.success('Morador deletado com sucesso!', 'Success Alert', {timeOut: 5000});

        });

      },


      editMorador: function(unidade){

          this.fillMorador.id = unidade.id;

          this.fillMorador.telefone_2 = unidade.telefone_2;

          this.fillMorador.data_entrada = unidade.data_entrada;

          this.fillMorador.nome_completo = unidade.nome_completo;

          this.fillMorador.cpf = unidade.cpf;

          this.fillMorador.rg = unidade.rg;
          
          this.fillMorador.telefone_1 = unidade.telefone_1;

          this.fillMorador.telefone_3 = unidade.telefone_3;

          this.fillMorador.profissao = unidade.profissao;

          this.fillMorador.data_nascimento = unidade.data_nascimento;

          this.fillMorador.sexo = unidade.sexo;

          this.fillMorador.email = unidade.email;

          this.fillMorador.id_unidade = unidade.id_unidade;

          $("#edit-morador").modal('show');

      },


      updateMorador: function(id){

        var input = this.fillMorador;

        this.$http.put('/morador/'+id,input).then((response) => {

            this.changePage(this.pagination.current_page);

            this.fillMorador = {'id_unidade':'','data_entrada':'','nome_completo':'','cpf':'','rg':'','telefone_1':'','telefone_2':'','telefone_3':'','profissao':'','data_nascimento':'','sexo':'','email':'','id':''}

            $("#edit-morador").modal('hide');

            toastr.success('Morador atualizado com sucesso', 'Success Alert', {timeOut: 5000});

          }, (response) => {

              this.formErrorsUpdate = response.data;

          });

      },


      changePage: function (page) {

          this.pagination.current_page = page;

          this.getVueMoradores(page);

      }


  }


});