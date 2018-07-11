
    <h1>{{$product['name']}} <small>редактирование товара</small></h1>

    <div class="row">
        <div class="col-xs-12">
            {!! $form_builder->model($product, ['url' => '/dashboard/ecommerce/product/'.$product['id'], 'class' => 'js-submit', 'method' => 'PUT']) !!}
            @include('ecommerce::products._form')
            {!! $form_builder->close() !!}
        </div>
    </div>