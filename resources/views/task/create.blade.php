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
          <div class="card-body">
            <form method="POST" action="{{route('task.store')}}">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('タスク名') }}</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="name" >
                </div>
              </div>
              <div class="form-group row">
                <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('内容') }}</label>
                <div class="col-md-6">
                  <textarea type="text" class="form-control" name="text">
                  </textarea>
                </div>
              </div>
              <div class="form-task row">
                <label for="datepicker" class="col-md-4 col-form-label text-md-right">期限</label>
                <div class="col-md-6"  id="date_picker">
                  <Datepicker
                  v-model="defaultDate"
                  :format="DatePickerFormat"
                  :language="ja"
                  name="limit_date">
                </Datepicker>
              </div>
            </div>
          
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('追加する') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
