@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <login></login>
        <user-crud></user-crud>
        <!-- @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif -->
    </div>
</div>
@endsection
