@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Criar Contato</h3>
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row">
        	<div class="col-12">
	   			<form class="" action="" method="post" enctype="">
	   				{{ csrf_field() }}
	   				<div class="form-group">
	   					<label>Nome</label>
	   					<input class="form-control" id="ContactName">
	   				</div>
	   				<div class="form-group">
	   					<label>Telefone</label>
	   					<input class="form-control" id="ContactPhone">
	   				</div>
	   				<div class="form-group">
	   					<label>Email</label>
	   					<input class="form-control"  id="ContactEmail">
	   				</div>	
	   				<button type="button" class="btn btn-primary" onclick="ContactCreate()">Adicionar</button>
	   			</form>
	   		</div>
        </div>
    </div>
@endsection
<script type="text/javascript">
	function ContactCreate(){

		contactName = $('#ContactName').val();
		contactPhone = $('#ContactPhone').val();
		contactEmail = $('#ContactEmail').val();

		text = JSON.parse('{"contact_name":"'+contactName+'","contact_phone":"'+contactPhone+'","contact_email": "'+contactEmail+'"}');

        $.ajax({
            method:"post",
            dataType:"json",
            url:"../api/contacts/",
            data: text,
            headers: {"content-type": "application/x-www-form-urlencoded","cache-control": "no-cache"},
            success: function(data){

                msg = "<div class='alert alert-success' role='alert'>"+
                      "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                      ""+data['data']['msg']+"</div>";
                $("#msg").append(msg);
            },
            error: function(){
                msg = "<div class='alert alert-danger' role='alert'>"+
                      "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                      "Erro na atualização do contato!</div>";
                $("#msg").append(msg);
            }
        })
    }

</script>