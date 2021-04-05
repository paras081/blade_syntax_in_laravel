@extends('layouts.app')


@section('content')

    <h1>Contact Page</h1>
    <form method="post" route="">
        @csrf
        <label for="dropdown" class="col-sm-4 col-form-label text-md-right">{{ __('My dropdown') }}</label>

        <div class="col-md-12">
            <select  name="dropdown">
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->id }}</option>
                @endforeach
            </select>

            @if ($errors->has('dropdown'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dropdown') }}</strong>
                </span>
            @endif
        </div>
    </form>
@stop

