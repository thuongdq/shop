@extends('layouts.app')
@section('content')
    @role('owner')
        Xin chào tôi là onwner
    @endrole

    @role('admin')
    Xin chào tôi là onwner
    @endrole

    @permission('upload')
        <input type="file">
    @endpermission

    @ability('admin', 'upload', ['validate_all' => true])
        Xin chào tôi là onwner
        <input type="file">
    @endability
@endsection
@section('title')
    ABC - @parent
@endsection
