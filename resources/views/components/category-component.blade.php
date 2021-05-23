<div class="dropdown-menu" aria-labelledby="categories">
    @foreach($categories as $category)
    <a class="dropdown-item" href="{{ route('products.category', $category->slug) }}"><i class="{{ $category->icon }} mr-2" aria-hidden="true"></i>{{ $category->name }}</a>
    @endforeach
</div>