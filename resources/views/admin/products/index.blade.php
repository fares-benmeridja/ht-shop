@extends('layouts.admin')

@section('title', 'Add article')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35"><i class="fas fa-clipboard-list"></i> Articles</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <a href="{{ route('products.create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small"><i class="zmdi zmdi-plus"></i>add article</a>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                <tr>
                    <th>Article name</th>
                    <th>Category</th>
                    <th>price</th>
                    <th>Created date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr class="tr-shadow">
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->formated_price }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <div class="table-data-feature">
                            @can('update', $product)
                            <a href="{{ route('products.edit', $product) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            @endcan
                            @can('delete', $product)
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>
                            @endcan
                            <a href="{{ route('products.show', $product) }}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                <i class="zmdi zmdi-more"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
                @endforeach
                </tbody>
                <tfoot>
                    {{ $products->links() }}
                </tfoot>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>

</div>

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
    </div>
    @include('admin.includes.footer')
</div>
@endsection