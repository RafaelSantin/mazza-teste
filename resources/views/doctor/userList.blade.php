@extends('layout.menu')

@section('head')

    @parent
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


@stop

@section('sidebar')
    @parent
@stop

@section('content')
    @parent
    <div>
        <h2>Listagem Usuarios</h2>
        <table id="table_id" class="display">
                    <thead>
            <tr>
                <th>Nome</th>                   
                <th>E-mail</th>   
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nome</th>                   
                <th>E-mail</th>                     
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
        <h5 class="modal-title">Cadastrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-save-user">
            <h2>Cadastro de Usuarios</h2>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nome Usuario</label>
                <div class="col-sm-6">
                  <input type="text" id="user_name" name="user_name" class="form-control" required>
                  <input type="hidden" id="user_id" name="user_id"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-6">
                  <input class="form-control" id="user_email" name="user_email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="user_password" name="user_password" required>
                </div>
            </div>          
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirmar Senha</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" required>
                </div>
            </div>
        </form>
      </div>
      <div class="alert alert-danger alert-error-field hide" role="alert">
          Todos os campos precisam ser preenchidos
      </div>

      <div class="alert alert-danger alert-error-password hide" role="alert">
          As senhas precisam ser iguais.
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
            "ajax": {"url": "{{route('listUsers')}}" ,"dataSrc":"" },
            "columns": [
                { "data": "user_name" },
                { "data": "user_email" },
            ]
            }
        );
        
        
       $('#table_id tbody').on( 'click', 'tr', function () {

            console.log(tabela.row( this ).data());
            $("#user_name").val(tabela.row( this ).data().user_name);
            $("#user_email").val(tabela.row( this ).data().user_email);
            $("#user_id").val(tabela.row( this ).data().user_id);
            console.log($("#user_email").val());
            abreModal();
        } );

       $("#novoBtn").on('click', function(){
            $("#user_name").val('');
            $("#user_email").val('');
            abreModal();
       })       

        $("#salvaBtn").on('click', function(){
            $('.alert-error-field').addClass('hide');
            $('.alert-error-password').addClass('hide');
            if($("#user_name").val() == '' || $("#user_email").val() == '' || $("#user_password").val() == '')
            {
                $('.alert-error-field').removeClass('hide');
            }else if($("#user_password").val() != $("#user_password_confirm").val()){
                $('.alert-error-password').removeClass('hide');
            }else{
                salvaUser();
            }
       })       

       $("#deletaBtn").on('click', function(){
            deletaUser();
       })

        abreModal = function(){
            $('.alert-error-field').addClass('hide');
            $('.alert-error-password').addClass('hide');
            $("#user_password").val('');
            $("#user_password_confirm").val('');

            if($("#user_id").val() == '')
            {
                $("#deletaBtn").hide();
            }else{
                $("#deletaBtn").show();
            }

            $('#myModal').modal('show');
        }

        salvaUser = function(){
            $('#form-save-user').validate({
              rules: {
                field: {
                  required: true
                }
              }
            });
            let urlAjax = '';
            if($("#user_id").val() == '')
            {
                urlAjax = "{{route('insertUser')}}";
            }else{
                urlAjax = "{{route('updateUser')}}";
            }

            data = $("#form-save-user").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

        deletaUser = function(){

            let urlAjax = "{{route('deleteUser')}}";            

            data = $("#form-save-user").serialize(); 

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