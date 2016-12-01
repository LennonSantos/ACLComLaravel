@extends('adminlte::page')
@section('content')
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<div class="vue" id="manage-vue">
		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="pull-left">
		            <h2>UNIDADES</h2>
		        </div>
		        <div class="pull-right">
		        	@permission(('item-create'))
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-unidade">
				  		Criar Unidade
					</button>
					@endpermission
		        </div>
		    </div>
		</div>

		<!-- Item Listing -->

		<table class="table table-bordered">
			<tr>
				<th>Nº unidade</th>
				<th>Responsável</th>
				<th>Metragem</th>
				<th>Qauntidade de comôdos</th>
				<th>Nº matrícula</th>
				<th>Situação</th>
				<th>Bloco</th>
				<th width="200px">Action</th>
			</tr>
			<tr v-for="unidade in unidades">
				<td>@{{ unidade.numero_unidade }}</td>
				<td>@{{ unidade.responsavel }}</td>
				<td>@{{ unidade.metragem }}</td>
				<td>@{{ unidade.quantidade_comodos }}</td>
				<td>@{{ unidade.numero_matricula }}</td>
				<td>@{{ unidade.situacao }}</td>
				<td>@{{ unidade.bloco.nome_bloco }}</td>
				<td>	
					@permission(('item-edit'))
				     	<button class="btn btn-primary" @click.prevent="editUnidade(unidade)">Edit</button>
				    @endpermission
				    @permission(('item-delete'))
				    	<button class="btn btn-danger" @click.prevent="deleteUnidade(unidade)">Delete</button>
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

		<div class="modal fade" id="create-unidade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Criar Unidade</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createUnidade">
		      				<div class="form-group">
								<label for="title">Número da unidade:</label>
								<input type="text" name="numero_unidade" class="form-control" v-model="newUnidade.numero_unidade" />
								<span v-if="formErrors['numero_unidade']" class="error text-danger">@{{ formErrors['numero_unidade'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Responsável:</label>
								<input type="text" name="id_responsavel" class="form-control" v-model="newUnidade.id_responsavel" />
								<span v-if="formErrors['id_responsavel']" class="error text-danger">@{{ formErrors['id_responsavel'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Metragem:</label>
								<input type="text" name="metragem" class="form-control" v-model="newUnidade.metragem" />
								<span v-if="formErrors['metragem']" class="error text-danger">@{{ formErrors['metragem'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Quantidade de comodos:</label>
								<input type="text" name="quantidade_comodos" class="form-control" v-model="newUnidade.quantidade_comodos" />
								<span v-if="formErrors['quantidade_comodos']" class="error text-danger">@{{ formErrors['quantidade_comodos'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Número da matrícula:</label>
								<input type="text" name="numero_matricula" class="form-control" v-model="newUnidade.numero_matricula" />
								<span v-if="formErrors['numero_matricula']" class="error text-danger">@{{ formErrors['numero_matricula'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Situação:</label>
								<input type="text" name="situacao" class="form-control" v-model="newUnidade.situacao" />
								<span v-if="formErrors['situacao']" class="error text-danger">@{{ formErrors['situacao'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Bloco:</label>
								<input type="text" name="id_bloco" class="form-control" v-model="newUnidade.id_bloco" />
								<span v-if="formErrors['id_bloco']" class="error text-danger">@{{ formErrors['id_bloco'] }}</span>
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
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateBloco(fillUnidade.id)">
			      			<div class="form-group">
								<label for="numero_unidade">Número da unidade:</label>
								<input type="text" name="numero_unidade" class="form-control" v-model="fillUnidade.numero_unidade" />
								<span v-if="formErrorsUpdate['numero_unidade']" class="error text-danger">@{{ formErrorsUpdate['numero_unidade'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Responsável:</label>
								<input type="text" name="id_responsavel" class="form-control" v-model="fillUnidade.id_responsavel" />
								<span v-if="formErrorsUpdate['id_responsavel']" class="error text-danger">@{{ formErrorsUpdate['id_responsavel'] }}</span>
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
	<script type="text/javascript" src="/js/unidade.js"></script>
@endsection