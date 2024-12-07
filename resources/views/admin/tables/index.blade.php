<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables</title>
    <!-- Optional CSS Framework (e.g., Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Tables</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Create New Table Button -->
        <div class="mb-3">
            <a href="{{ route('tables.create') }}" class="btn btn-primary">Create New Table</a>
        </div>

        <!-- Tables Display -->
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
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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

    <!-- Optional JS Framework (e.g., Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
