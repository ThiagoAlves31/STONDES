@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row"><h3>Produtos disponíveis</h3></div>
        <br>
        <div class="row">
        <div class=".col-md">
            <table class="table table-striped" id="table_products">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Título</th>
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
                <a role="button" href="/productscreate" class="btn btn-primary">Adicionar Produto</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
     $(document).ready(function(){
        LoadProducts();        
     });
     
     function LoadProducts(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
            });

            $.ajax({
                method:"get",
                dataType:"json",
                url:"api/products/nolent",
                success: function(data){
                    $.each(data['data'],function(key,level){
                        $("#table_products").append(
                            '<tr id="'+level.product_id+'">'+
                                '<td>'+level.product_id+'</td>'+
                                '<td>'+level.type+'</td>'+
                                '<td>'+level.name+'</td>'+
                                '<td>'+level.description+'</td>'+
                                '<td><a class="btn btn-info" href="/productlent/'+level.product_id+'">Emprestar</a></td>'+
                                '<td><a class="btn btn-warning" href="/products/'+level.product_id+'">Editar</a></td>'+
                                '<td><a class="btn btn-danger" onclick="ProductRemove(\''+level.product_id+'\')">Apagar</a></td>'+
                            '</tr>'
                        );
                    })
                }
            });
           setTimeout(ReloadTables, 2000);
        }

    function ReloadTables() {
        $('#table_products').DataTable({
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

    function ProductRemove(id){
        var resposta = confirm("Tem certeza que deseja remover o produto?");

        if (resposta == true) {

            $.ajax({
                method:"delete",
                dataType:"json",
                url:"api/products/" + id ,
                success: function(data){

                    //Remove linha da Tabela
                    var data_table = $('#table_products').DataTable();
                    data_table.row('#'+id+'').remove().draw();

                    msg = "<div class='alert alert-success' role='alert'>"+
                          "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                          ""+data['data']['msg']+"</div>";
                    $("#msg").append(msg);

                },
                error: function(){
                    msg = "<div class='alert alert-danger' role='alert'>"+
                          "<a href='#' class='close' data-dismiss='alert' aria-label='Close'>&times;</a>"+
                          "Erro ao deletar arquivo!</div>";
                    $("#msg").append(msg);
                }
            })
        }
    }

</script>
@endsection