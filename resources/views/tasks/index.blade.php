@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @include('common.errors')

        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Tarefa</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                    <input type="hidden" name="status" id="task-status" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Adicionar
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (count($tasks) > 0)
    <input type="hidden" name="_method" value="DELETE">
    <div class="panel panel-default">
        <div class="panel-heading">
            Pendentes
        </div>

    <div class="panel-body" style="overflow-x:auto;">
        <table class="table table-striped task-table">
            <thead>
                <th>Situação</th>
                <th>Tarefa</th>
                <th>Apagar</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    @if ($task->status == 0)
                    <tr>
                        <td width="100px">
                            {{Form::model($task, array("method" => "post", "action" => array("TaskController@changeStatus", $task->id)))}}
                            <button class="btn btn-light">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                            {{Form::close()}}
                        </td>
                        <td>
                            <h4><a href="{{ 'edit/'.$task->id }}">{{ $task->name }}</a></h4>
                        </td>
                        <td width="50px">
                            <form action="/task/{{ $task->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @endif
    @if (count($tasks->where('status', 1)) > 0)
    <input type="hidden" name="_method" value="DELETE">
    <div class="panel panel-default">
        <div class="panel-heading">
            Concluídas
        </div>

        <div class="panel-body" style="overflow-x:auto;">
            <table class="table table-striped task-table">
                <thead>
                    <th>Situação</th>
                    <th>Tarefa</th>
                    <th>Apagar</th>
                </thead>
              <tbody>
                  @foreach ($tasks as $task)
                  @if ($task->status == 1)
                  <tr>
                      <td width="100px">
                          {{Form::model($task, array("method" => "post", "action" => array("TaskController@changeStatus", $task->id)))}}
                          <button class="btn btn-light">
                              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          </button>
                          {{Form::close()}}
                      </td>
                      <td>
                          <h4><a href="{{ 'edit/'.$task->id }}">{{ $task->name }}</a></h4>
                      </td>
                      <td width="50px">
                          <form action="/task/{{ $task->id }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button class="btn btn-danger">
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                              </button>
                          </form>
                      </td>
                  </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
