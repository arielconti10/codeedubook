@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova categoria</h3>

            {!! Form::model($category, [
                'route' => ['categories.update', 'category' => $category->id], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::categories._form')


            <div class="form-group">
                {!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
@endsection