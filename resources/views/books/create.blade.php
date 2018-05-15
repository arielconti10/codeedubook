@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo produto</h3>
            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}
                @include('codeedubook::books._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection