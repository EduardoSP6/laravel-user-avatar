@extends('layouts.app')

@section('content')
	
	<div class="container">
	
		<h2>Usuários Cadastrados</h2>
		
		<table class="table table-bordered">
			
			<tr>
				<td>ID</td>
				<td>Nome</td>
				<td>E-mail</td>
				<td>Ações</td>
			</tr>
			<tbody>
			
				@foreach($users as $user)

					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
		
						<td>

							<!-- alterar -->
							<a href="#"><i class="glyphicon glyphicon-pencil"></i></a>

							<!-- excluir -->
							<a href="#" class="link-del" id="{{ $user->id }}" onclick="{{"event.preventDefault;addClick();"}}"><i class="glyphicon glyphicon-remove"></i></a> 

						   	<form action="{{ route('delete',[$user->id]) }}" id="form-delete-{{ $user->id }}">
						       	<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>

						</td>
					</tr>
				@endforeach

			</tbody>
		</table>
		
		{{ $users->links() }}	

		@section('sa-scripts')

			<script>

				// exibe mensagem de confirmacao	
				function confirmDelete() {

					var form = document.getElementById("form-delete-" + this.id); // captura o form de exclusao

					swal({
						  title: 'Deseja excluir o Usuário?',
						  text: "Este processo é irreversível",
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Confirmar',
						  cancelButtonText: 'Cancelar'
						}).then(function () {
						  swal(
						    'Excluído!',
						    '',
						    'success'
						  );
						  form.submit();  // executa o submit no form de exclusao	
						});
				};

				// redefine o evento onclick dos icones de exclusao	
				function addClick() {

					var links = document.getElementsByClassName("link-del");

					for(var i = 0; i < links.length; i++){
						links[i].onclick = confirmDelete;
					}

				};

			</script>
		@endsection				

	</div>

@endsection

