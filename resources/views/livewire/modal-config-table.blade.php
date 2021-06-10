<!-- Modal -->
<div id="category" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div style="width: 100%">
                    <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products[0]['category']['image']) }}" alt="">
                    <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $products[0]['category']['name'] }} ({{ $count }})</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <input value="{{ $search }}" type="text" placeholder="Search by title" class="form-control" wire:model.debounce.500ms="search">
                </form>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Dispo</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
{{--                        <tr role="button" wire:click="compatibles({{ $product->id }})">--}}
                        <tr>
                            <th scope="row">{{ $loop->index }}</th>
                            <td>{{ $product['title'] }}</td>
                            @if($product['qty_available'] > 0)
                                <td><i style="color: #00ad5f" class="fa fa-check-circle fa-lg" aria-hidden="true"></i></td>
                            @else
                                <td><i style="color: #00ad5f" class="fa fa-times-circl fa-lg" aria-hidden="true"></i></td>
                            @endif
                            <td>{{ $product['price'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="4">Empty</th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>