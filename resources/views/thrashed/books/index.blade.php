@extends('layouts.app')

@section('content')
    <div class="container">

        <br />
        <div class="row">
            {!! Form::model(compact('search'),
                ['class' => 'form-inline', 'method' => 'GET']) !!}

            {!! Form::label('search', 'Pesquisar por título', ['class' => 'control-label']) !!}
            {!! Form::text('search', null, ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}

            {!! Form::close() !!}

        </div>
        <div class="row">
            @if($books->count() > 0)
            {!!
                Table::withContents($books->items())->striped()
                ->callback('Ações', function($field, $book){

                    $linkView = route('thrashed.books.show', ['book' => $book->id]);
                    $linkDestroy = route('thrashed.books.update', ['book' => $book->id]);
                    $restoreForm = "restore-form-{$book->id}";
                     $form = Form::open(['route' => ['thrashed.books.update', 'book' => $book->id],
                            'method' => 'PUT', 'id' => $restoreForm, 'style' => 'display:none']).
                            Form::hidden('redirect_to', URL::previous()).
                            Form::close();
                     $anchorRestore = Button::link('Restaurar')->asLinkTo($restoreForm)
                                     ->addAttributes([
                                        'onclick' => "event.preventDefault();document.getElementById(\"{$restoreForm}\").submit()"
                                     ]);
                     return "<ul class=\"list-inline\">
                                <li>".Button::link('Ver')->asLinkTo($linkView)."</li>
                                <li>|</li>
                                <li>".$anchorRestore."</li>
                            </ul>".
                            $form;
                })

             !!}
            @else
                <br/>
                <div class="well well-lg text-center">
                    <p><strong>Lixeira vazia</strong></p>
                </div>
            @endif

            {{ $books->links() }}
        </div>
    </div>
@endsection