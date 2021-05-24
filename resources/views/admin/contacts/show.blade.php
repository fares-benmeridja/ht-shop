@extends('layouts.admin')

@section('title', 'Detailed Inbox')

@section('content')
    <div>
        <div>
            <div class="heading">
                <a onclick="window.history.back();" style="cursor: pointer">
                    <i class="fa fa-arrow-left"></i>
                </a>

            </div>
            <div class="container col-10">
                <div class="message">
                    <h6><span class="ml-2">{{ "<$contact->email>" }}</span></h6>
                    <small>{{ $contact->created_at->format('d M Y H:i') }}<span class="ml-1">({{ $contact->created_at->diffForHumans() }})</span></small>
                    <p>{{ $contact->message }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection