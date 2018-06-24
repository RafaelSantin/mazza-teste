@extends('layout.menu')

@section('head')

    @parent
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  

@stop

@section('sidebar')
    @parent
@stop

@section('content')
    @parent
    <span> Agendamentos </span>
    <table id="table_id" class="display">
    <thead>
        <tr>
            <th>Columnfasdfa 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>asdfasfdasfaf</td>
            <td>afsadf2</td>
        </tr>
        <tr>
            <td>casdcasdc</td>
            <td>ssdqerasrar</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
@stop

@section('javascript')
@parent
<script type="text/javascript">
    $(document).ready( function () {
        console.log('teste');
        $('#table_id').DataTable( {
            language: {
                processing:     "Tratamento em curso...",
                search:         "Pesquisa:",
                lengthMenu:    "Exibir _MENU_ Registros",
                info:           "Exibindo _START_ &agrave; _END_ de _TOTAL_ elementos",
                infoEmpty:      "Exibindo 0 &agrave; 0 de 0 Elementos",
                infoFiltered:   "(Filtro de _MAX_ Elementos no total)",
                infoPostFix:    "",
                loadingRecords: "Carregando registros",
                zeroRecords:    "Nenhum registro no momento",
                emptyTable:     "Nenhum registro no momento",
                paginate: {
                    first:      "Primeira",
                    previous:   "Anterior",
                    next:       "Proxima",
                    last:       "Ultima"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        } );
        
    } );
</script>
@stop