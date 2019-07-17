@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Produtos</h3>
        <div class="row">
        <div class=".col-md">
            <table class="table" id="table_products">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>Emprestar</th>
                    <th>Editar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
        </div>
        <div class="row">
            <div class=".col-md">
                <button type="button" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
     $(document).ready(function(){
        $.ajax({
            method:"get",
            dataType:"json",
            url:"api/products",
            success: function(data){
                $.each(data['data']['data'],function(key,level){
                    $("#table_products").append(
                        '<tr>'+
                            '<td>'+level.product_id+'</td>'+
                            '<td>'+level.type+'</td>'+
                            '<td>'+level.name+'</td>'+
                            '<td>'+level.description+'</td>'+
                            '<td>'+level.product_id+'</td>'+
                            '<td>'+level.product_id+'</td>'+
                            '<td><a class="btn btn-danger" onclick="ProdRemove(\''+level.product_id+'\')" id="Hremove" >'+
                            'X</a></td>'+
                        '</tr>'
                    );
                })
            }
        })
     });
     
     function ProdRemove(id){
        $('#Hremove').click(function(){
            $.ajax({
            method:"delete",
            dataType:"json",
            url:"api/products/" + id ,
            success: function(){
                alert("Produto deletado com sucesso");
            }
        })
        })
     }

</script>
@endsection