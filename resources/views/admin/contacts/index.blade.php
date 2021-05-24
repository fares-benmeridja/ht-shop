@extends('layouts.admin')

@section('title', 'Inbox')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35"><i class="fas fa-inbox"></i> Inbox</h3>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                <tr>
                    <th>email</th>
                    <th>Object</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                <tr class="tr-shadow">
                    <td>
                        <span class="block-email">{{ $contact->email }}</span>
                    </td>
                    <td class="desc">{{ $contact->object }}</td>
                    <td>
                        <p>{{ $contact->short_message }}</p>
                    </td>
                    <td>{{ $contact->created_at }}</td>
                    <td>
                        @can('delete', $contact)
                        <div class="table-data-feature">
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('You are sure to remove this ?')" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>
                        @endif
                            <a href="{{ route('contacts.show', $contact) }}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                <i class="zmdi zmdi-more"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @if(! $loop->last)
                    <tr class="spacer"></tr>
                @endif
                @endforeach
                </tbody>
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