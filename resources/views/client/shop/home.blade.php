@extends('client.layout.master')

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>New update Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="client/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">Tank Top</a></h3>
                                <p class="mb-0">Finding perfect t-shirt</p>
                                <p class="text-primary font-weight-bold">$50</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="client/images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">Corater</a></h3>
                                <p class="mb-0">Finding perfect products</p>
                                <p class="text-primary font-weight-bold">$50</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="client/images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">Polo Shirt</a></h3>
                                <p class="mb-0">Finding perfect products</p>
                                <p class="text-primary font-weight-bold">$50</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="client/images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">T-Shirt Mockup</a></h3>
                                <p class="mb-0">Finding perfect products</p>
                                <p class="text-primary font-weight-bold">$50</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                            <figure class="block-4-image">
                                <img src="client/images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="#">Corater</a></h3>
                                <p class="mb-0">Finding perfect products</p>
                                <p class="text-primary font-weight-bold">$50</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
