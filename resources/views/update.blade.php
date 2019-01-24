@extends('layouts.app')

@section('content')

	<div class="panel-body">
        <h1>Editar tarefa</h1>
        <hr>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Tarefas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$task->name}}</li>
          </ol>
        </nav>
        <div class="container">
    		{{Form::model($task, array("method" => "patch", "action" => array("TaskController@update", $task->id)))}}
                <div class="form-group">
                {{Form::label("name", "Nome")}}
				{{Form::text("name", null, array("class" => "form-control"))}}
                </div>
                <div class="form-group">
				{{Form::submit("Salvar", array("class" => "btn btn-primary"))}}
                <a href="/" class="btn btn-secondary" name="Back" value="Back">Voltar</a>
                </div>
    		{{Form::close()}}
	   </div>

	</div>
