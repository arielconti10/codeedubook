@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova categoria</h3>
            {!! Form::model($book, [
                'route' => ['books.update', 'product' => $book->id], 'class' => 'form', 'method' => 'PUT']) !!}

                @include('codeedubook::books._form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection