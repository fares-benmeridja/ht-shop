<div class="component">
    <div class="row">
        <div class="col">
            <h3 style="margin: 0 0 25px; font-size: 26px; text-align: center; font-weight: 600; color: #969696;">components</h3>
            @foreach($collection as $key => $products)
                @if($selectedProducts !== [] && Illuminate\Support\Arr::has($selectedProducts, $key))
                    <div class="card mt-3" style="border-bottom: none; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                        <div style="margin: 0.7rem 0.9rem !important;" class="text-decoration-none d-flex justify-content-between">
                            <div style="flex: 2">
                                <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->category->image) }}" alt="">
                                <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $key }}</span>
                            </div>
                        </div>
                    </div>

                    <div style="background-color:#80808012; border-top: none; border-top-left-radius: 0; border-top-right-radius: 0;" class="card">
                        <div class="text-decoration-none d-flex justify-content-between m-4">
                            <div style="flex: 2">
                                <div style="margin-right: 20px; width: 50px; height: 50px; display: inline-block">
                                    <img style="border: none; height: 100%; width: 100%; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->images->first()->code) }}" alt="">
                                </div>
                                <div style="display:inline-block;" class="my-auto">
                                    <a href="{{ route('products.shop', ["slug" => $key, "product" => $products->first()]) }}" target="_blank" style="text-decoration: none"> <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $products->first()->title }}</span></a>
                                </div>
                            </div>
                            <i type="button" style="color: #e3342f" wire:click="unsetProduct('{{ $key }}')" class="fa fa-trash-o fa-2x my-auto" aria-hidden="true"></i>
                        </div>
                    </div>
                @else
                    <div class="card my-3">
                        <div style="margin: 0.7rem 0.9rem !important;" type="button" data-toggle="modal" data-target="#category-{{ $loop->index }}" class="text-decoration-none d-flex justify-content-between">
                            <div style="flex: 2">
                                <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->category->image) }}" alt="">
                                <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $products->first()->category->name }}</span>
                            </div>
                            <i class="fa fa-plus-circle fa-2x my-auto" aria-hidden="true"></i>
                        </div>
                    </div>
                @endif

            <!-- Modal -->
                <div wire:ignore.self id="category-{{ $loop->index }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 100%">
                                    <img style="margin-right: 20px; border-radius: 50%; border: 1px solid gray; width: 50px; height: 50px; object-fit: cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$products->first()->category->image) }}" alt="">
                                    <span style="font-size: 21px; font-family: Montserrat,sans-serif; color: #505050; text-transform: uppercase; font-weight: 400; margin: auto">{{ $key }} ({{ $products->count() }})</span>
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
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($products as $product)
                                            @php
                                                $initLink = \Illuminate\Support\Str::replace("\\","/", asset('storage'.DIRECTORY_SEPARATOR.$products->first()->first_image) );
                                                $link = \Illuminate\Support\Str::replace("\\","/", asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) );
                                            @endphp
                                            <tr class="filter-tr" x-on:mouseover="link = '{{ $link }}'" x-on:mouseleave="link = '{{ $initLink }}'">
                                                <th scope="row">{{ $loop->index }}</th>
                                                <td>{{ $product->title }}</td>
                                                @if($product->qty_available > 0)
                                                    <td><i style="color: #00ad5f" class="fa fa-check-circle fa-lg" aria-hidden="true"></i></td>
                                                @else
                                                    <td><i style="color: #00ad5f" class="fa fa-times-circl fa-lg" aria-hidden="true"></i></td>
                                                @endif
                                                <td>{{ $product->formatedPrice }}</td>
                                                <td wire:click="setCompatible({{ $product->id }})">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </td>
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

        @if($selectedProducts !== [])
        <div class="col-5">
            <h3 style="margin: 0 0 25px; font-size: 26px; text-align: center; font-weight: 600; color: #969696;">Virtual cart</h3>
            <div class="card mt-3">
                <table class="table mb-0" style="border: 2px solid #00aced">
                    <tbody>
                    @foreach($cart as $product)
                        <tr>
                            <td colspan="2">{{ $product['title'] }}</td>
                            <td>{{ number_format($product['price'], 0, ',', ' ') .' DZA' }}</td>
                        </tr>
                    @endforeach
                    <tr style="font-size: 18px; font-weight: 600; color: #0096c8;">
                        <td>Amount : </td>
                        <td colspan="2">{{ number_format($amount, 0, ',', ' ') .' DZA' }}</td>
                    </tr>
                    </tbody>
                    <button wire:click="cart" type="submit" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add to cart</button>
                </table>
            </div>
        </div>
        @endif
    </div>

</div>
