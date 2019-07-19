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
                <button type="button" class="btn btn-primary">Adicionar</button>
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
                            '<tr>'+
                                '<td>'+level.contact_id+'</td>'+
                                '<td>'+level.contact_name+'</td>'+
                                '<td>'+level.contact_phone+'</td>'+
                                '<td>'+level.contact_email+'</td>'+
                                '<td><a class="btn btn-primary" href="/contacts/'+level.contact_id+'">@</a></td>'+
                                '<td><a class="btn btn-danger" onclick="ContactRemove(\''+level.contact_id+'\')">X</a></td>'+
                            '</tr>'
                        );
                    })
                }
            })
        }

    function ContactRemove(id){
        $.ajax({
            method:"delete",
            dataType:"json",
            url:"api/contacts/" + id ,
            success: function(data){

                $("#table_contacts td").parent().remove();
                LoadContacts();

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

</script>
@endsection