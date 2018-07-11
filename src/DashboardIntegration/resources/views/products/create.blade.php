<h1>Новый товар</h1>

    <div class="row">
        <div class="col-xs-12">
            {!! $form_builder->model($product, ['url' => '/dashboard/ecommerce/product', 'class' => 'js-submit', 'method' => 'POST']) !!}
            @include('ecommerce::products._form')
            {!! $form_builder->close() !!}
        </div>
    </div>
