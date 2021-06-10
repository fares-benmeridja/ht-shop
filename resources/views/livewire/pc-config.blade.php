<div class="component">
    @foreach($collection as $products)
        <div class="card my-3">
            <div type="button" data-toggle="modal" data-target="#category-{{ $loop->index }}" class="text-decoration-none d-flex justify-content-between m-4">
                <div style="flex: 2">
                    <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->category->image) }}" alt="">
                    <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $products->first()->category->name }}</span>
                </div>
                <i class="fa fa-plus-circle fa-3x my-auto" aria-hidden="true"></i>
            </div>
        </div>

    <!-- Modal -->
        <div id="category-{{ $loop->index }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div style="width: 100%">
                            <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->category->image) }}" alt="">
                            <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $products->first()->category->name }} ({{ $products->count() }})</span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" style="margin-bottom: 1rem">
                            <input id="search-{{ $loop->index }}" onkeyup="filterTable()" type="text" placeholder="Search by title" class="form-control filter-input">
                        </form>

                        <div class="row" x-data="{link : ''}">
                            <table class="table col-8 filter-table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Dispo</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                    @php
                                        $initLink = \Illuminate\Support\Str::replace("\\","/", asset('storage'.DIRECTORY_SEPARATOR.$products->first()->first_image) );
                                        $link = \Illuminate\Support\Str::replace("\\","/", asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) );
                                    @endphp
                                    <tr class="filter-tr" role="button" x-model="link" @mouseover="link = '{{ $link }}'" @mouseleave="link = '{{ $initLink }}'" wire:click="compatibles({{$product->id}})">
                                        <th scope="row">{{ $loop->index }}</th>
                                        <td>{{ $product->title }}</td>
                                        @if($product->qty_available > 0)
                                            <td><i style="color: #00ad5f" class="fa fa-check-circle fa-lg" aria-hidden="true"></i></td>
                                        @else
                                            <td><i style="color: #00ad5f" class="fa fa-times-circl fa-lg" aria-hidden="true"></i></td>
                                        @endif
                                        <td>{{ $product->formatedPrice }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="col-4" style="padding: 50px;">
                                <ul>
                                    <li style="list-style: none">
                                        <img :src="link" style="width: 100%; height: auto; object-fit: cover" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
