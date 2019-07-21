@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <div class="row"><h3>Produtos Emprestados</h3></div>
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row">
        <div class=".col-md">
            <table class="table table-striped" id="table_lents">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Título</th>
                    <th>Contato</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Data Empréstimo</th>
                    <th>Confirmar Devolução</th>
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
        Loadlentss();        
     });
     
     function Loadlentss(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
            });

            $.ajax({
                method:"get",
                dataType:"json",
                url:"api/lents",
                success: function(data){
                    $.each(data['data'],function(key,level){
                        $("#table_lents").append(
                            '<tr id="'+level.lent_id+'"align="center">'+
                                '<td>'+level.type+'</td>'+
                                '<td>'+level.name+'</td>'+
                                '<td>'+level.contact_name+'</td>'+
                                '<td>'+level.contact_phone+'</td>'+
                                '<td>'+level.contact_email+'</td>'+
                                '<td>'+level.created_at+'</td>'+
                                '<td><a class="btn btn-info" onclick="lentsRemove(\''+level.lent_id+'\')">Devolver</a></td>'+
                            '</tr>'
                        );
                    })
                }
            });
           setTimeout(ReloadTables, 800);
        }

    function ReloadTables() {
        $('#table_lents').DataTable({
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

    function lentsRemove(id){
        var resposta = confirm("Tem certeza que deseja coonfirmar a devolução do produto?");

        if (resposta == true) {
            json = JSON.parse('{"lent_id":"'+id+'"}');
            $.ajax({
                method:"put",
                dataType:"json",
                url:"api/lents",
                data:json,
                success: function(data){

                    //Remove linha da Tabela
                    var data_table = $('#table_lents').DataTable();
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