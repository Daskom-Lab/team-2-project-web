@extends('layout')

@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="product-section container">
        <div>
            <div class="product-section-image">
                <img width="150px" src="{{ url('/data_file/'.$product->file) }}" class="active" alt="product">
            </div>
            <div class="product-section-images">
                <div class="product-section-thumbnail selected">
                    <img width="150px" src="{{ url('/data_file/'.$product->file) }}" class="active" alt="product">
                </div>

                @if ($product->images)
                    @foreach (json_decode($product->file, true) as $image)
                    <div class="product-section-thumbnail">
                        <img width="150px" src="{{ url('/data_file/'.$product->file) }}" class="active" alt="product">
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->desc }}</div>
            <div class="product-section-price">{{ $product->price }}</div>

            <p>
                {!! $product->desc !!}
            </p>

            <p>&nbsp;</p>

            @if ($product->quantity > 0)
                <form action="/" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="button button-plain">Add to Cart</button>
                </form>
            @endif
        </div>
    </div> <!-- end product-section -->

@endsection

@section('extra-js')
    <script>
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.product-section-thumbnail');

            images.forEach((element) => element.addEventListener('click', thumbnailClick));

            function thumbnailClick(e) {
                currentImage.classList.remove('active');

                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                })

                images.forEach((element) => element.classList.remove('selected'));
                this.classList.add('selected');
            }

        })();
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>

@endsection
