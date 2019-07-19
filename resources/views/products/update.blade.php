@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Atualizar Produto</h3>
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
	   					<input class="form-control" readonly="readonly" id="ProductId" value="{{ $product->product_id}}">
	   				</div>
	   				<div class="form-group">
	   					<label>Tipo</label>
	   					<input class="form-control" id="ProductType" value="{{ $product->type }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Título</label>
	   					<input class="form-control" id="ProductName" value="{{ $product->name }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Descrição</label>
	   					<textarea class="form-control" rows="3" id="ProductDesc">{{ $product->description }}</textarea>
	   				</div>	
	   				<button type="button" class="btn btn-primary" onclick="ProductUpdate()">Atualizar</button>
	   			</form>
	   		</div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
	function ProductUpdate(){
		productId = $('#ProductId').val();
		productType = $('#ProductType').val();
		productName = $('#ProductName').val();
		productDesc = $('#ProductDesc').val();

		text = JSON.parse('{"type":"'+productType+'","name":"'+productName+'","description": "'+productDesc+'"}');

        $.ajax({
            method:"put",
            dataType:"json",
            url:"../api/products/" + productId,
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
                      "Erro na atualização do produto!</div>";
                $("#msg").append(msg);
            }
        })
    }

</script>
@endsection