Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({

  el: '#manage-vue',


  data: {
    unidades: [],
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
    newUnidade : {'numero_unidade':'','id_responsavel':'','metragem':'','quantidade_comodos':'','numero_matricula':'','situacao':'','id_bloco':''},
    fillUnidade : {'numero_unidade':'','id_responsavel':'','metragem':'','quantidade_comodos':'','numero_matricula':'','situacao':'','id_bloco':'','id':''}
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
  		this.getVueUnidades(this.pagination.current_page);
  },

  methods : {

        getVueUnidades: function(page){
          this.$http.get('/unidade?page='+page).then((response) => {
            this.$set('unidades', response.data.data.data);
            this.$set('pagination', response.data.pagination);
          });
        },

        createUnidade: function(){

		  var input = this.newUnidade;

		  this.$http.post('/unidade/create',input).then((response) => {

		    this.changePage(this.pagination.current_page);

			this.newUnidade = {'numero_unidade':'','id_responsavel':'','metragem':'','quantidade_comodos':'','numero_matricula':'','situacao':'','id_bloco':''};

			$("#create-unidade").modal('hide');

			toastr.success('Unidade criado com sucesso!', 'Success Alert', {timeOut: 5000});

		  }, (response) => {

			this.formErrors = response.data;

	    });

	},


      deleteUnidade: function(item){

        this.$http.delete('/unidade/'+item.id).then((response) => {

            this.changePage(this.pagination.current_page);

            toastr.success('Unidade deletado com sucesso!', 'Success Alert', {timeOut: 5000});

        });

      },


      editUnidade: function(unidade){

          this.fillUnidade.id = unidade.id;

          this.fillUnidade.id_bloco = unidade.id_bloco;

          this.fillUnidade.id_responsavel = unidade.id_responsavel;

          this.fillUnidade.metragem = unidade.metragem;

          this.fillUnidade.quantidade_comodos = unidade.quantidade_comodos;

          this.fillUnidade.numero_matricula = unidade.numero_matricula;
          
          this.fillUnidade.situacao = unidade.situacao;

          this.fillUnidade.numero_unidade = unidade.numero_unidade;

          $("#edit-unidade").modal('show');

      },


      updateUnidade: function(id){

        var input = this.fillUnidade;

        this.$http.put('/unidade/'+id,input).then((response) => {

            this.changePage(this.pagination.current_page);

            this.fillUnidade = {'numero_unidade':'','id_responsavel':'','metragem':'','quantidade_comodos':'','numero_matricula':'','situacao':'','id_bloco':'','id':''};

            $("#edit-unidade").modal('hide');

            toastr.success('Unidade atualizado com sucesso', 'Success Alert', {timeOut: 5000});

          }, (response) => {

              this.formErrorsUpdate = response.data;

          });

      },


      changePage: function (page) {

          this.pagination.current_page = page;

          this.getVueUnidades(page);

      }


  }


});