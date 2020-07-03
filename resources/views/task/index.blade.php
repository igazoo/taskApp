@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          task画面だよー
          <a href="{{route('task.create')}}">作成</a>
          @foreach($tasks as $task)
          @if($task->status ===0)

          <form method="POST" action="{{route('task._status_change',['id' =>$task->id])}}">
            @csrf
            <input type="hidden" name="status" value=1>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('開始する') }}
                </button>
              </div>
            </div>
          </form>
          <a href="{{route('task.show', ['id' => $task->id])}}">詳細</a>

          @elseif($task->status ===1)


          <form method="POST" action="{{route('task._status_change',['id' =>$task->id])}}">
            @csrf
            <input type="hidden" name="status" value=2>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('完了する') }}
                </button>
              </div>
            </div>
          </form>

          <a href="{{route('task.show', ['id' => $task->id])}}">詳細</a>
          @else
          {{$task->name}}
          {{$task->status}}
          <form method="POST" action="{{route('task._status_change',['id' =>$task->id])}}">
            @csrf
            <input type="hidden" name="status" value=1>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('進行中に戻す') }}
                </button>
              </div>
            </div>
          </form>
          <form method="POST" action="{{route('task._status_change',['id' =>$task->id])}}">
            @csrf
            <input type="hidden" name="status" value=0>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('未完了') }}
                </button>
              </div>
            </div>
          </form>
          <a href="{{route('task.show', ['id' => $task->id])}}">詳細</a>

@endif
@endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
