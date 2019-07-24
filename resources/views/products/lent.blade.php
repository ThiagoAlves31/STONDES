@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="col-6">
        		<h3>Emprestar Produto</h3>
        		<div class="row">
            		<div class=".col-md"><div id="msg"></div></div>
        		</div>
	   			<form class="" action="" method="post" enctype="">
	   				{{ csrf_field() }}
	   				<div class="form-group">
	   					<label>Código</label>
	   					<input class="form-control" readonly="readonly" id="ProductId" value="{{ $lentProduct->product_id}}">
	   				</div>
	   				<div class="form-group">
	   					<label>Tipo</label>
	   					<input class="form-control" readonly="readonly" id="ProductType" value="{{ $lentProduct->type }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Título</label>
	   					<input class="form-control"  readonly="readonly"id="ProductName" value="{{ $lentProduct->name }}">
	   				</div>
	   				<div class="form-group">
	   					<label>Descrição</label>
	   					<textarea class="form-control"  readonly="readonly" rows="3" id="ProductDesc">{{ $lentProduct->description }}</textarea>
	   				</div>	
	   				<button type="button" class="btn btn-primary" id="btnSubmit" onclick="LentProductCreate({{ $lentProduct->product_id}})">Emprestar</button>
	   			</form>
	   		</div>
	   		<div class="col-6">
	   			<h3>Escolha o contato desejado</h3>
	   			<table class="table table-striped" id="table_contacts">
	            <thead>
	                <tr>
	                    <th>Nome</th>
	                    <th>Telefone</th>
	                    <th>Email</th>
	                </tr>
	            </thead>
	            <tbody>
	            </tbody>
	            </table>
	   		</div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">

     $(document).ready(function(){
        LoadContacts();        
     });
     
     function LoadContacts(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
            });

            $.ajax({
                method:"get",
                dataType:"json",
                url:"../api/contacts",
                success: function(data){
                    $.each(data['data'],function(key,level){
                        $("#table_contacts").append(
                            '<tr id="'+level.contact_id+'">'+
                                '<td><input type="radio" id="optioncontact" name="optioncontact" value="'+level.contact_id+'"> '+level.contact_name+'</td>'+
                                '<td>'+level.contact_phone+'</td>'+
                                '<td>'+level.contact_email+'</td>'+
                          '</tr>'
                        );
                    })
                }
            });
          setTimeout(ReloadTables, 2000);
        }

    function ReloadTables() {
        $('#table_contacts').DataTable({
            "destroy": true,
            "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
            "pageLength": 5,
            "language":{
                 "decimal":        "",
                "emptyTable":     "Nenhuma informação encontrada",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ entradas",
                "infoEmpty":      "Mostrando 0 de 0 de 0 entradas",
                "infoFiltered":   "(Filtrando de _MAX_ total entradas)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ Entradas",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Localizar:",
                "zeroRecords":    "Nenhum ocorrência encontrada",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior",
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
                }
            }
        });
    };

    function LentProductCreate(id){
        var resposta = confirm("Tem certeza que deseja emprestar o produto?");
        
        if (resposta == true) {
            
            var idcontact = $("input[name='optioncontact']:checked").val();

            if (idcontact != null){

                datas = JSON.parse('{"product_id": "'+id+'","contact_id": "'+idcontact+'"}');
                $.ajax({
                    method:"post",
                    dataType:"json",
                    url:"../api/lents/",
                    data:datas,
                    success: function(data){

                        msg = "<div class='alert alert-success' role='alert'>"+
                            "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                            ""+data['data']['msg']+"</div>";
                        $("#msg").append(msg);
                        $("#btnSubmit").attr("disabled", true);

                    },
                    error: function(){
                        msg = "<div class='alert alert-danger' role='alert'>"+
                            "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                            "Erro ao fazer empréstimo ddo produto!</div>";
                        $("#msg").append(msg);
                    }
                })
            }else{ 
                msg = "<div class='alert alert-danger' role='alert'>"+
                            "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                            "Escolha um contato antes de continuar!</div>";
                $("#msg").append(msg);
            }
        }
    }
</script>
@endsection