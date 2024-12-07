@extends('layouts.frontend')

@section('content')
<h1>Available Tables</h1>
<ul>
    @foreach($tables as $table)
    <li><a href="{{ route('frontend.tables.view', $table->id) }}">{{ $table->table_name }}</a></li>
    @endforeach
</ul>
@endsection
