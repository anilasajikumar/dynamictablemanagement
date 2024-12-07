@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Tables</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Action Button -->
    <div class="mb-3">
        <a href="{{ route('tables.create') }}" class="btn btn-primary">Create New Table</a>
    </div>

    <!-- Table to Display All Tables -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tables as $table)
            <tr>
                <td>{{ $table->id }}</td>
                <td>{{ $table->table_name }}</td>
                <td>
                    <a href="{{ route('tables.show', $table->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this table?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No tables found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
