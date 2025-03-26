@php
    use App\Models\Category;

    $topCategories = Category::withCount('products')->orderByDesc('products_count')->limit(3)->get();
@endphp

<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            @foreach ($topCategories as $index => $category)
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="{{ $index * 100 }}">
                    <a class="block-2-item" href="">
                        <figure class="image">
                            <img src="{{ asset('storage/' . $category->avatar) }}" width="400px" height="200px"
                                alt="Ảnh danh mục">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Collections</span>
                            <h3>{{ $category->name }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
