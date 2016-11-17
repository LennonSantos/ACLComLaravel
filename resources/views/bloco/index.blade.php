@extends('adminlte::page')
@section('content')
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<div class="vue" id="manage-vue">
		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="pull-left">
		            <h2>BLOCOS</h2>
		        </div>
		        <div class="pull-right">
		        	@permission(('item-create'))
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-bloco">
				  		Criar bloco
					</button>
					@endpermission
		        </div>
		    </div>
		</div>

		<!-- Item Listing -->

		<table class="table table-bordered">
			<tr>
				<th>Nome do bloco</th>
				<th>Qauntidade de unidades</th>
				<th width="200px">Action</th>
			</tr>
			<tr v-for="bloco in blocos">
				<td>@{{ bloco.nome_bloco }}</td>
				<td>@{{ bloco.quantidade_unidade }}</td>
				<td>	
					@permission(('item-edit'))
				     	<button class="btn btn-primary" @click.prevent="editBloco(bloco)">Edit</button>
				    @endpermission
				    @permission(('item-delete'))
				    	<button class="btn btn-danger" @click.prevent="deleteBloco(bloco)">Delete</button>
					@endpermission
				</td>
			</tr>
		</table>

		<!-- Pagination -->

		<nav>
	        <ul class="pagination">
	            <li v-if="pagination.current_page > 1">
	                <a href="#" aria-label="Previous"
	                   @click.prevent="changePage(pagination.current_page - 1)">
	                    <span aria-hidden="true">«</span>
	                </a>
	            </li>
	            <li v-for="page in pagesNumber"
	                v-bind:class="[ page == isActived ? 'active' : '']">
	                <a href="#"
	                   @click.prevent="changePage(page)">@{{ page }}</a>
	            </li>
	            <li v-if="pagination.current_page < pagination.last_page">
	                <a href="#" aria-label="Next"
	                   @click.prevent="changePage(pagination.current_page + 1)">
	                    <span aria-hidden="true">»</span>
	                </a>
	            </li>
	        </ul>
	    </nav>

	    <!-- Create Item Modal -->

		<div class="modal fade" id="create-bloco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Criar bloco</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createBloco">
		      				<div class="form-group">
								<label for="title">Nome do bloco:</label>
								<input type="text" name="nome_bloco" class="form-control" v-model="newBloco.nome_bloco" />
								<span v-if="formErrors['nome_bloco']" class="error text-danger">@{{ formErrors['nome_bloco'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Quantidade de unidades:</label>
								<input type="text" name="quantidade_unidade" class="form-control" v-model="newBloco.quantidade_unidade" />
								<span v-if="formErrors['quantidade_unidade']" class="error text-danger">@{{ formErrors['quantidade_unidade'] }}</span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Salvar</button>
							</div>
		      			</form>
		      		</div>
		    	</div>
		  	</div>
		</div>

		<!-- Edit Item Modal -->

		<div class="modal fade" id="edit-bloco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Editar Bloco</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateBloco(fillBloco.id)">
			      			<div class="form-group">
								<label for="nome_bloco">Nome do bloco:</label>
								<input type="text" name="nome_bloco" class="form-control" v-model="fillBloco.nome_bloco" />
								<span v-if="formErrorsUpdate['nome_bloco']" class="error text-danger">@{{ formErrorsUpdate['nome_bloco'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Quantidade de unidades:</label>
								<input type="text" name="quantidade_unidade" class="form-control" v-model="fillBloco.quantidade_unidade" />
								<span v-if="formErrorsUpdate['quantidade_unidade']" class="error text-danger">@{{ formErrorsUpdate['quantidade_unidade'] }}</span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Salvar</button>
							</div>
				      	</form>
		      		</div>
		   		</div>
		  	</div>
		</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
	<script type="text/javascript" src="/js/bloco.js"></script>
@endsection