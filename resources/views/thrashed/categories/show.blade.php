@extends('views.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Categoria - {{$category->name}}</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Nome</strong>
                </li>
                <li class="list-group-item">{{$category->name}}</li>

            </ul>
        </div>
    </div>
@endsection

