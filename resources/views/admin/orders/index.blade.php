@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35"><i class="fas fa-shopping-cart"></i> Orders</h3>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Mailing address</th>
                        <th>Zip code</th>
                        <th>Commune</th>
{{--                        <th>Article name</th>--}}
{{--                        <th>Quantity</th>--}}
                        <th>Created date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr class="tr-shadow">
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ $order->user->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->zip_code }}</td>
                        <td>{{ $order->commune->name }}</td>
{{--                        <td>Cadre</td>--}}
{{--                        <td>3</td>--}}
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <div class="table-data-feature">
                                @can('delete', $order)
                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </form>
                                @endcan
                                <a href="{{ route('orders.show', $order) }}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                        {{ $orders->links() }}
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