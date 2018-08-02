@extends('layouts.app')

@section('content')
    <div class="container">
         <div class="panel-body">
            <form method="POST" action="{{ route('add') }}" aria-label="{{ __('Add Todo') }}">
                @csrf
                    <div class="input-group mb-3">
                        <input id="description" type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ empty($todo)? old('description') : $todo->body}}" required autofocus>

                        @if(!empty($todo))
                            <input type="hidden" value="{{ $todo->id }}" name="id"/>
                        @endif
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            @if(empty($todo))
                                {{ __('Add task') }}
                            @else
                                {{ __('Edit task') }}
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link {{ empty($completed)? 'active': ''}}" href="{{ route('todo') }}">{{ __('Active') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ ! empty($completed)? 'active': ''}}" href="{{ route('completed') }}">{{ __('Completed') }}</a>
                  </li>
                </ul>
            </div>

            <div class="panel-body">
                <table class="table table-hover">
                    <tbody>
                        @if (count($todos) > 0)
                        @foreach ($todos as $todo)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $todo->body }}</div>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        @if(empty($completed))
                                        <form action="/todo/{{ $todo->id }}/edit" method="POST">
                                            @csrf
                                            <button>{{ __('Edit') }}</button>
                                        </form>

                                        <form action="/todo/complete" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $todo->id }}">

                                            <button>{{ __('Mark As Completed') }}</button>
                                        </form>
                                        @endif
                                        <form action="/todo/{{ $todo->id }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button>{{ __('Delete') }}</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="3">No records exist</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
