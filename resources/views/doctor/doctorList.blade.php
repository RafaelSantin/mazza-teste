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
    <div>
        <h2>Listagem Médicos</h2>
        <table id="table_id" class="display">
                    <thead>
            <tr>
                <th>Nome</th>               
                <th>Especialidade</th>               
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nome</th>               
                <th>Especialidade</th>                    
            </tr>
        </tfoot>
        </table>

    </div>
    <div>
        <button class="btn btn-primary" id="novoBtn">Novo Médico</button>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-save-doctor">
            <h2>Cadastro de médicos</h2>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nome médico</label>
                <div class="col-sm-6">
                  <input type="text" id="doctor_name" name="doctor_name" class="form-control">
                  <input type="hidden" id="doctor_id" name="doctor_id"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Especialidade</label>
                <div class="col-sm-6">
                  <input class="form-control" id="doctor_specialty" name="doctor_specialty">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="salvaBtn" >Salvar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="deletaBtn" class="btn btn-danger" data-dismiss="modal">deletar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalSave">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <h3>Ação realizada</h3>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@stop

@section('javascript')
@parent
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#table_id').DataTable(  {
        //     "ajax": {
        //         "url": "{{route('listDoctors')}}",
        //         "data": function ( d ) {
        //           console.log(d); }
        //         }
        //     }
        //  );

        
        var tabela = $('#table_id').DataTable(  {
            "ajax": {"url": "{{route('listDoctors')}}" ,"dataSrc":"" },
            "columns": [
                { "data": "doctor_name" },
                { "data": "doctor_specialty" },
            ]
            }
        );
        
        
       $('#table_id tbody').on( 'click', 'tr', function () {

            console.log(tabela.row( this ).data());
            $("#doctor_name").val(tabela.row( this ).data().doctor_name);
            $("#doctor_specialty").val(tabela.row( this ).data().doctor_specialty);
            $("#doctor_id").val(tabela.row( this ).data().doctor_id);
            abreModal();
        } );

       $("#novoBtn").on('click', function(){
            $("#doctor_name").val('');
            $("#doctor_specialty").val('');
            $("#doctor_id").val('');
            abreModal();
       })       

       $("#salvaBtn").on('click', function(){
            salvaMedico();
       })       

       $("#deletaBtn").on('click', function(){
            deletaMedico();
       })

        abreModal = function(){
            if($("#doctor_id").val() == '')
            {
                $("#btnDelete").hide();
            }else{
                $("#btnDelete").show();
            }

            $('#myModal').modal('show');
        }

        salvaMedico = function(){

            let urlAjax = '';
            if($("#doctor_id").val() == '')
            {
                urlAjax = "{{route('storeDoctors')}}";
            }else{
                urlAjax = "{{route('updateDoctors')}}";
            }

            data = $("#form-save-doctor").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

        deletaMedico = function(){

            let urlAjax = "{{route('deleteDoctors')}}";            

            data = $("#form-save-doctor").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

    });
</script>
@stop