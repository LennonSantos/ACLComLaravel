Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({

  el: '#manage-vue',

  data: {
    blocos: [],
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
    newBloco : {'nome_bloco':'','quantidade_unidade':''},
    fillBloco : {'nome_bloco':'','quantidade_unidade':'','id':''}
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
  		this.getVueBlocos(this.pagination.current_page);
  },

  methods : {

        getVueBlocos: function(page){
          this.$http.get('/bloco?page='+page).then((response) => {
            this.$set('blocos', response.data.data.data);
            this.$set('pagination', response.data.pagination);
          });
        },

        createBloco: function(){

		  var input = this.newBloco;

		  this.$http.post('/bloco/create',input).then((response) => {

		    this.changePage(this.pagination.current_page);

			this.newBloco = {'nome_bloco':'','quantidade_unidade':''};

			$("#create-bloco").modal('hide');

			toastr.success('Bloco criado com sucesso!', 'Success Alert', {timeOut: 5000});

		  }, (response) => {

			this.formErrors = response.data;

	    });

	},


      deleteBloco: function(item){

        this.$http.delete('/bloco/'+item.id).then((response) => {

            this.changePage(this.pagination.current_page);

            toastr.success('Bloco deletado com sucesso!', 'Success Alert', {timeOut: 5000});

        });

      },


      editBloco: function(bloco){

          this.fillBloco.nome_bloco = bloco.nome_bloco;

          this.fillBloco.id = bloco.id;

          this.fillBloco.quantidade_unidade = bloco.quantidade_unidade;

          $("#edit-bloco").modal('show');

      },


      updateBloco: function(id){

        var input = this.fillBloco;

        this.$http.put('/bloco/'+id,input).then((response) => {

            this.changePage(this.pagination.current_page);

            this.fillBloco = {'nome_bloco':'','quantidade_unidade':'','id':''};

            $("#edit-bloco").modal('hide');

            toastr.success('Bloco atualizado com sucesso', 'Success Alert', {timeOut: 5000});

          }, (response) => {

              this.formErrorsUpdate = response.data;

          });

      },


      changePage: function (page) {

          this.pagination.current_page = page;

          this.getVueBlocos(page);

      }


  }


});