@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Atualizar Contato</h3>
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row">
        	<div class="col-12">
	   			<form class="" action="" method="post" enctype="">
	   				{{ csrf_field() }}
	   				<input type="hidden" name="_method" value="put">
	   				<div class="form-group">
	   					<label>Código</label>
	   					<input class="form-control" readonly="readonly" id="ContactId" value="{{ $contact->contact_id}}">
	   				</div>
	   				<div class="form-group">
	   					<label>Nome</label>
	   					<input class="form-control" id="ContactName" value="{{ $contact->contact_name }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Telefone</label>
	   					<input class="form-control" id="ContactPhone" value="{{ $contact->contact_phone }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Email</label>
	   					<input class="form-control"  id="ContactEmail" value="{{ $contact->contact_email }}">
	   				</div>	
	   				<button type="button" class="btn btn-primary" onclick="ContactUpdate()">Atualizar</button>
	   			</form>
	   		</div>
        </div>
    </div>
@endsection
<script type="text/javascript">
	function ContactUpdate(){

		contactId = $('#ContactId').val();
		contactName = $('#ContactName').val();
		contactPhone = $('#ContactPhone').val();
		contactEmail = $('#ContactEmail').val();

		text = JSON.parse('{"contact_name":"'+contactName+'","contact_phone":"'+contactPhone+'","contact_email": "'+contactEmail+'"}');

        $.ajax({
            method:"put",
            dataType:"json",
            url:"../api/contacts/" + contactId,
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