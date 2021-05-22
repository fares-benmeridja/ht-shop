@extends('layouts.admin')

@section('title', 'Manage admins')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- USER DATA-->
        <div class="user-data m-b-30" style="white-space: nowrap;">
            <h3 class="title-3 m-b-30"><i class="fas fa-users"></i>Manage admins</h3>
            <div class="table-data__tool">
                <div class="table-data__tool-right">
                    <a href="{{ route('admins.create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small"><i class="zmdi zmdi-plus"></i>add admin</a>
                </div>
            </div>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                    <tr>
                        <td>name</td>
                        <td>Mailing address</td>
                        <td>City</td>
                        <td>Phone number</td>
                        <td>Facebook account</td>
                        <td>role</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            <div class="table-data__info">
                                <h6>{{ $admin->full_name }}</h6>
                                <span>
                                    <a href="{{ 'mailto:'.$admin->email }}">{{ $admin->email }}</a>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="table-data__info">
                                {{ $admin->short_address }}
                            </div>
                        </td>
                        <td>{{ $admin->wilaya }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->facebook }}</td>
                        <td>
                            <span class="role admin">{{ $admin->role->name }}</span>
                        </td>
                        <td>
                            <div class="table-data-feature">

                                @can('delete', $admin)
                                    <form action="{{ route('admins.destroy', $admin) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>
                                @endcan

                                <a href="{{ route('admins.edit', $admin) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="user-data__footer d-flex justify-content-center">
                {{ $admins->links() }}
            </div>
        </div>
        <!-- END USER DATA-->
    </div>
    @include('admin.includes.footer')
</div>
@endsection