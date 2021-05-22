<div class="dropdown-menu" aria-labelledby="categories">
    @foreach($categories as $category)
    <a class="dropdown-item" href="{{ route('products.category', $category->slug) }}">{{ $category->name }}</a>
    @endforeach
</div>