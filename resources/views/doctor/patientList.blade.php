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
        <h2>Listagem Pacientes</h2>
        <table id="table_id" class="display">
                    <thead>
            <tr>
                <th>Nome</th>               
                <th>Endereço</th>               
                <th>E-mail</th>               
                <th>CPF</th>               
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nome</th>               
                <th>Endereço</th>               
                <th>E-mail</th>               
                <th>CPF</th>                       
            </tr>
        </tfoot>
        </table>

    </div>
    <div>
        <button class="btn btn-primary" id="novoBtn">Novo Paciente</button>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-save-patient">
            <h2>Cadastro de Pacientes</h2>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nome Paciente</label>
                <div class="col-sm-6">
                  <input type="text" id="patient_name" name="patient_name" class="form-control">
                  <input type="hidden" id="patient_id" name="patient_id"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Endereço</label>
                <div class="col-sm-6">
                  <input class="form-control" id="patient_full_adress" name="patient_full_adress">
                </div>
            </div> 
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-6">
                  <input class="form-control" id="patient_email" name="patient_email">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">CPF</label>
                <div class="col-sm-6">
                  <input class="form-control" id="patient_cpf" name="patient_cpf">
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
                
        var tabela = $('#table_id').DataTable(  {
            "ajax": {"url": "{{route('listPatients')}}" ,"dataSrc":"" },
            "columns": [
                { "data": "patient_name" },
                { "data": "patient_full_adress" },
                { "data": "patient_email" },
                { "data": "patient_cpf" },
            ]
            }
        );
        
        
       $('#table_id tbody').on( 'click', 'tr', function () {

            console.log(tabela.row( this ).data());
            $("#patient_name").val(tabela.row( this ).data().patient_name);
            $("#patient_full_adress").val(tabela.row( this ).data().patient_full_adress);
            $("#patient_email").val(tabela.row( this ).data().patient_email);
            $("#patient_cpf").val(tabela.row( this ).data().patient_cpf);
            $("#patient_id").val(tabela.row( this ).data().patient_id);
            abreModal();
        } );

       $("#novoBtn").on('click', function(){
            $("#patient_name").val('');
            $("#patient_full_adress").val('');
            $("#patient_email").val('');
            $("#patient_cpf").val('');
            $("#patient_id").val('');
            abreModal();
       })       

       $("#salvaBtn").on('click', function(){
            salvaPatient();
       })       

       $("#deletaBtn").on('click', function(){
            deletaPatient();
       })

        abreModal = function(){
            if($("#patient_id").val() == '')
            {
                $("#deletaBtn").hide();
            }else{
                $("#deletaBtn").show();
            }

            $('#myModal').modal('show');
        }

        salvaPatient = function(){

            let urlAjax = '';
            if($("#patient_id").val() == '')
            {
                urlAjax = "{{route('storePatient')}}";
            }else{
                urlAjax = "{{route('updatePatient')}}";
            }

            data = $("#form-save-patient").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

        deletaPatient = function(){

            let urlAjax = "{{route('deletePatient')}}";            

            data = $("#form-save-patient").serialize(); 

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