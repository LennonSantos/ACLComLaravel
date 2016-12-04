@extends('adminlte::page')
@section('content')
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<div class="vue" id="manage-vue">
		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="pull-left">
		            <h2>MORADORES</h2>
		        </div>
		        <div class="pull-right">
		        	@permission(('item-create'))
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-morador">
				  		Criar Morador
					</button>
					@endpermission
		        </div>
		    </div>
		</div>

		<!-- Item Listing -->

		<table class="table table-bordered">
			<tr>
				<th>Nº unidade</th>
				<th>Data de entrada</th>
				<th>Nome Completo</th>
				<th>CPF</th>
				<th>RG</th>
				<th>Telefone 1</th>
				<th>Telefone 2</th>
				<th>Telefone 3</th>
				<th>Profissão</th>
				<th>Data de nascimento</th>
				<th>Sexo</th>
				<th>Email</th>
				<th width="200px">Action</th>
			</tr>
			<tr v-for="morador in moradores">
				<td>@{{ morador.unidade.numero_unidade }}</td>
				<td>@{{ morador.data_entrada }}</td>
				<td>@{{ morador.nome_completo }}</td>
				<td>@{{ morador.cpf }}</td>
				<td>@{{ morador.rg }}</td>
				<td>@{{ morador.telefone_1 }}</td>
				<td>@{{ morador.telefone_2 }}</td>
				<td>@{{ morador.telefone_3 }}</td>
				<td>@{{ morador.profissao }}</td>
				<td>@{{ morador.data_nascimento }}</td>
				<td>@{{ morador.sexo }}</td>
				<td>@{{ morador.email }}</td>
				<td>	
					@permission(('item-edit'))
				     	<button class="btn btn-primary" @click.prevent="editMorador(morador)">Edit</button>
				    @endpermission
				    @permission(('item-delete'))
				    	<button class="btn btn-danger" @click.prevent="deleteMorador(morador)">Delete</button>
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

		<div class="modal fade" id="create-morador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Criar Morador</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createMorador">
		      				<div class="form-group">
								<label for="title">Número da unidade:</label>
								<input type="text" name="id_unidade" class="form-control" v-model="newMorador.id_unidade" />
								<span v-if="formErrors['id_unidade']" class="error text-danger">@{{ formErrors['id_unidade'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Data de entrada:</label>
								<input type="text" name="data_entrada" class="form-control" v-model="newMorador.data_entrada" />
								<span v-if="formErrors['data_entrada']" class="error text-danger">@{{ formErrors['data_entrada'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Nome completo:</label>
								<input type="text" name="nome_completo" class="form-control" v-model="newMorador.nome_completo" />
								<span v-if="formErrors['nome_completo']" class="error text-danger">@{{ formErrors['nome_completo'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">CPF:</label>
								<input type="text" name="cpf" class="form-control" v-model="newMorador.cpf" />
								<span v-if="formErrors['cpf']" class="error text-danger">@{{ formErrors['cpf'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">RG:</label>
								<input type="text" name="rg" class="form-control" v-model="newMorador.rg" />
								<span v-if="formErrors['rg']" class="error text-danger">@{{ formErrors['rg'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 1:</label>
								<input type="text" name="telefone_1" class="form-control" v-model="newMorador.telefone_1" />
								<span v-if="formErrors['telefone_1']" class="error text-danger">@{{ formErrors['telefone_1'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 2:</label>
								<input type="text" name="telefone_2" class="form-control" v-model="newMorador.telefone_2" />
								<span v-if="formErrors['telefone_2']" class="error text-danger">@{{ formErrors['telefone_2'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 3:</label>
								<input type="text" name="telefone_3" class="form-control" v-model="newMorador.telefone_3" />
								<span v-if="formErrors['telefone_3']" class="error text-danger">@{{ formErrors['telefone_3'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Profissão:</label>
								<input type="text" name="profissao" class="form-control" v-model="newMorador.profissao" />
								<span v-if="formErrors['profissao']" class="error text-danger">@{{ formErrors['profissao'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Data de nascimento:</label>
								<input type="text" name="data_nascimento" class="form-control" v-model="newMorador.data_nascimento" />
								<span v-if="formErrors['data_nascimento']" class="error text-danger">@{{ formErrors['data_nascimento'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Sexo:</label>
								<input type="text" name="sexo" class="form-control" v-model="newMorador.sexo" />
								<span v-if="formErrors['sexo']" class="error text-danger">@{{ formErrors['sexo'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Email:</label>
								<input type="text" name="email" class="form-control" v-model="newMorador.email" />
								<span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
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

		<div class="modal fade" id="edit-morador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Editar Morador</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateMorador(fillMorador.id)">
			      			<div class="form-group">
								<label for="title">Número da unidade:</label>
								<input type="text" name="id_unidade" class="form-control" v-model="fillMorador.id_unidade" />
								<span v-if="formErrors['id_unidade']" class="error text-danger">@{{ formErrors['id_unidade'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Data de entrada:</label>
								<input type="text" name="data_entrada" class="form-control" v-model="fillMorador.data_entrada" />
								<span v-if="formErrors['data_entrada']" class="error text-danger">@{{ formErrors['data_entrada'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Nome completo:</label>
								<input type="text" name="nome_completo" class="form-control" v-model="fillMorador.nome_completo" />
								<span v-if="formErrors['nome_completo']" class="error text-danger">@{{ formErrors['nome_completo'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">CPF:</label>
								<input type="text" name="cpf" class="form-control" v-model="fillMorador.cpf" />
								<span v-if="formErrors['cpf']" class="error text-danger">@{{ formErrors['cpf'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">RG:</label>
								<input type="text" name="rg" class="form-control" v-model="fillMorador.rg" />
								<span v-if="formErrors['rg']" class="error text-danger">@{{ formErrors['rg'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 1:</label>
								<input type="text" name="telefone_1" class="form-control" v-model="fillMorador.telefone_1" />
								<span v-if="formErrors['telefone_1']" class="error text-danger">@{{ formErrors['telefone_1'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 2:</label>
								<input type="text" name="telefone_2" class="form-control" v-model="fillMorador.telefone_2" />
								<span v-if="formErrors['telefone_2']" class="error text-danger">@{{ formErrors['telefone_2'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Telefone 3:</label>
								<input type="text" name="telefone_3" class="form-control" v-model="fillMorador.telefone_3" />
								<span v-if="formErrors['telefone_3']" class="error text-danger">@{{ formErrors['telefone_3'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Profissão:</label>
								<input type="text" name="profissao" class="form-control" v-model="fillMorador.profissao" />
								<span v-if="formErrors['profissao']" class="error text-danger">@{{ formErrors['profissao'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Data de nascimento:</label>
								<input type="text" name="data_nascimento" class="form-control" v-model="fillMorador.data_nascimento" />
								<span v-if="formErrors['data_nascimento']" class="error text-danger">@{{ formErrors['data_nascimento'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Sexo:</label>
								<input type="text" name="sexo" class="form-control" v-model="fillMorador.sexo" />
								<span v-if="formErrors['sexo']" class="error text-danger">@{{ formErrors['sexo'] }}</span>
							</div>
							<div class="form-group">
								<label for="title">Email:</label>
								<input type="text" name="email" class="form-control" v-model="fillMorador.email" />
								<span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
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
	<script type="text/javascript" src="/js/morador.js"></script>
@endsection