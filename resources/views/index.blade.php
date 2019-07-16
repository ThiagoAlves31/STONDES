<!DOCTYPE html>
<html>
<head>
    <title>Controle de Produtos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Controle de Produtos</h1>
        <table class="table" id="teste">
        <thead>
            <tr>
                <th>ID</th>
                <th>TIPO</th>
                <th>NOME</th>
                <th>DESCRIÇÂO</th>
            </tr>
        </thead>
        </table>
    </div>
</body>

<script type="text/javascript">
        $.ajax({
            method:"get",
            dataType:"json",
            url:"api/products",
            success: function(data){
                alert("Oi");
                $.each(data['data']['data'],function(key,level){
                    $("#teste").append(
                        '<tr>'+
                            '<td>'+level.product_id+'</td>'+
                            '<td>'+level.type+'</td>'+
                            '<td>'+level.name+'</td>'+
                            '<td>'+level.description+'</td>'+
                        '</tr>'
                    );
                })
            }
        })

</script>  