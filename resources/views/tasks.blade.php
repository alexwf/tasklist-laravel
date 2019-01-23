@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @include('common.errors')

        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                    <input type="hidden" name="status" id="task-status" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (count($tasks) > 0)
    <input type="hidden" name="_method" value="DELETE">
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Tasks
        </div>

    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>Task</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    @if ($task->status == 0)
                    <tr>
                        <td class="table-text">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                {{ $task->name }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <form action="/task/{{ $task->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="btn btn-default">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                            </form>
                        </td>
                        <td>
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
    @if (count($tasks) > 0)
    <input type="hidden" name="_method" value="DELETE">
    <div class="panel panel-default">
        <div class="panel-heading">
            Concluídas
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                </thead>
              <tbody>
                  @foreach ($tasks as $task)
                  @if ($task->status == 1)
                  <tr>
                      <td class="table-text">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                              <label class="form-check-label" for="defaultCheck1">
                              {{ $task->name }}
                              </label>
                          </div>
                      </td>
                      <td>
                          <form action="/task/{{ $task->id }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}

                              <button>Delete Task</button>
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
