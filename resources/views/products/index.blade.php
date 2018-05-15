@extends('resources.views.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Produtos</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Novo produto</a>
        </div>
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
            {!!
                Table::withContents($products->items())->striped()
                ->callback('Ações', function($field, $product){
                    $linkEdit = route('products.edit', ['product' => $product->id]);
                    $linkDestroy = route('products.destroy', ['product' => $product->id]);
                    $deleteForm = "delete-form-{$product->id}";
                     $form = Form::open(['route' => ['products.destroy', 'product' => $product->id],
                            'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']).
                            Form::close();
                     $anchorDestroy = Button::link('Delete')->asLinkTo($linkDestroy)
                                     ->addAttributes([
                                        'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit()"
                                     ]);
                     return "<ul class=\"list-inline\">
                                <li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>
                                <li>|</li>
                                <li>".$anchorDestroy."</li>
                            </ul>".
                            $form;
                })

             !!}

            {{ $products->links() }}
        </div>
    </div>
@endsection