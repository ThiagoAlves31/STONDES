@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Criar Produto</h3>
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row">
        	<div class="col-12">
	   			<form class="" action="" method="post" enctype="">
	   				{{ csrf_field() }}
	   				<div class="form-group">
	   					<label for="ProductType">Tipo:</label>
                          <select class="form-control" id="ProductType" required="true">
                            <option>Livro</option>
                            <option>CD</option>
                          </select>
	   				</div>
	   				<div class="form-group">
	   					<label>Título</label>
	   					<input type="text" class="form-control" id="ProductName" required="true">
	   				</div>
	   				<div class="form-group">
	   					<label>Descrição</label>
	   					<textarea class="form-control" rows="3" id="ProductDesc" required="true"></textarea>
	   				</div>	
	   				<button type="button" class="btn btn-primary" onclick="ProductCreate()">Adicionar</button>
	   			</form>
	   		</div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
	function ProductCreate(){
		productType = $('#ProductType').val();
		productName = $('#ProductName').val();
		productDesc = $('#ProductDesc').val();

		text = JSON.parse('{"type":"'+productType+'","name":"'+productName+'","description": "'+productDesc+'"}');

        $.ajax({
            method:"post",
            dataType:"json",
            url:"../api/products/",
            data: text,
            headers: {"content-type": "application/x-www-form-urlencoded","cache-control": "no-cache"},
            success: function(data){

                msg = "<div class='alert alert-success' role='alert'>"+
                      "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                      ""+data['data']['msg']+"</div>";
                $("#msg").append(msg);
                $('#ProductType').val("");
                $('#ProductName').val("");
                $('#ProductDesc').val("");
            },
            error: function(){
                msg = "<div class='alert alert-danger' role='alert'>"+
                      "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                      "Erro na criação do produto!</div>";
                $("#msg").append(msg);
            }
        })
    }

</script>
@endsection