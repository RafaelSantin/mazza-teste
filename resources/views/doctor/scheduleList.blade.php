@extends('layout.menu')

@section('head')

    @parent
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


@stop

@section('sidebar')
    @parent
@stop

@section('content')
    @parent
    <div>
        <h2>Listagem agendamentos</h2>
        <table id="table_id" class="display">
                    <thead>
            <tr>
                <th>Paciente</th>               
                <th>Medico</th>               
                <th>Data/hora</th>              
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Paciente</th>               
                <th>Medico</th>               
                <th>Data/hora</th>                    
            </tr>
        </tfoot>
        </table>

    </div>
    <div>
        <button class="btn btn-primary" id="novoBtn">Novo Agendamento</button>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-save-schedule">
            <h2>Cadastro de agendamento</h2>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Paciente</label>
                <div class="col-sm-6">
                       {!! Form::select('patient_id',$pacientes,'0',['class'=>'form-control','id'=>'patient_id']) !!}
                  <!-- <input type="text" id="patient_name" name="patient_name" class="form-control"> -->
                  <input type="hidden" id="schedule_id" name="schedule_id"  class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Médico</label>
                <div class="col-sm-6">

                    {!!  Form::select('doctor_id',$medicos,'0',['class'=>'form-control','id'=>'doctor_id'])  !!}
          
                </div>
            </div> 
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Data/hora</label>
                <div class="col-sm-6">
                     <input id="schedule_date_time" class="form_datetime form-control" name="schedule_date_time" type='text' data-date-format="DD-MM-YYYY hh:mm" />
                    

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
            "ajax": {"url": "{{route('listSchedules')}}" ,"dataSrc":"" },
            "columns": [
                { "data": "patient_name" },
                { "data": "doctor_name" },
                { "data": "schedule_date_time" },
            ]
            }
        );
        
        
       $('#table_id tbody').on( 'click', 'tr', function () {

            console.log(tabela.row( this ).data());
            $("#patient_id").val(tabela.row( this ).data().patient_id);
            $("#doctor_id").val(tabela.row( this ).data().doctor_id);
            $("#schedule_date_time").val(tabela.row( this ).data().schedule_date_time);
            $("#schedule_id").val(tabela.row( this ).data().schedule_id);
            abreModal();
        } );

       $("#novoBtn").on('click', function(){
            $("#patient_id").val('');
            $("#doctor_id").val('');
            $("#schedule_date_time").val('');
            $("#schedule_id").val('');
            abreModal();
       })       

       $("#salvaBtn").on('click', function(){
            salvaSchedule();
       })       

       $("#deletaBtn").on('click', function(){
            deletaSchedule();
       })

        abreModal = function(){
            if($("#schedule_id").val() == '')
            {
                $("#deletaBtn").hide();
            }else{
                $("#deletaBtn").show();
            }

            $('#myModal').modal('show');
        }

        salvaSchedule = function(){

            let urlAjax = '';
            if($("#schedule_id").val() == '')
            {
                urlAjax = "{{route('insertSchedule')}}";
            }else{
                urlAjax = "{{route('updateSchedule')}}";
            }

            data = $("#form-save-schedule").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

        deletaSchedule = function(){

            let urlAjax = "{{route('deleteSchedule')}}";            

            data = $("#form-save-schedule").serialize(); 

            console.log(data);

            $.post(urlAjax,data, function( data ) {
                //console.log(data);
                $( "#myModal" ).modal('hide');
                $( "#modalSave" ).modal('show');
                tabela.ajax.reload();
            });
        }

        
        $(".form_datetime").datetimepicker();

    });

</script>
@stop