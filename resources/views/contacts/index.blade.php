@extends('layout.site')

@section('title','Controle de Livros e CDs')

@section('content')
    <div class="container">
        <h3 class="center">Lista de Contatos</h3>
        <div class="row">
            <div class=".col-md"><div id="msg"></div></div>
        </div>
        <div class="row">
        <div class=".col-md">
            <table class="table table-striped" id="table_contacts">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>email</th>
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
                <a role="button" href="contactscreate/" class="btn btn-primary" >Adicionar</a>
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
                url:"api/contacts",
                success: function(data){
                    $.each(data['data'],function(key,level){
                        $("#table_contacts").append(
                            '<tr id="'+level.contact_id+'">'+
                                '<td>'+level.contact_id+'</td>'+
                                '<td>'+level.contact_name+'</td>'+
                                '<td>'+level.contact_phone+'</td>'+
                                '<td>'+level.contact_email+'</td>'+
                                '<td><a class="btn btn-warning" href="/contacts/'+level.contact_id+'">Editar</a></td>'+
                                '<td><a class="btn btn-danger" onclick="ContactRemove(\''+level.contact_id+'\')">Apagar</a></td>'+
                            '</tr>'
                        );
                    })
                }
            })
            setTimeout(ReloadTables, 1000);
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

    function ContactRemove(id){
        var resposta = confirm("Tem certeza que deseja remover o produto?");

        if (resposta == true) {

            $.ajax({
                method:"delete",
                dataType:"json",
                url:"api/contacts/" + id ,
                success: function(data){

                    //remove linha da tabela
                    var data_table = $('#table_contacts').DataTable();
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