<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Table - {{ $table->table_name }}</title>
    <!-- Optional CSS Framework (e.g., Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Table - {{ $table->table_name }}</h1>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Table Form -->
        <form action="{{ route('tables.update', $table->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Table Name -->
            <div class="mb-3">
                <label for="table_name" class="form-label">Table Name</label>
                <input type="text" class="form-control" id="table_name" name="table_name" value="{{ $table->table_name }}" required>
            </div>

            <!-- Columns -->
            <div class="mb-3">
                <label for="columns" class="form-label">Columns</label>
                <textarea class="form-control" id="columns" name="columns" rows="3" required>{{ implode(',', $table->columns) }}</textarea>
                <small class="form-text text-muted">Enter columns as a comma-separated list (e.g., Name, Age, Department).</small>
            </div>

            <!-- Data Rows -->
            <div id="data-rows">
                <label for="data" class="form-label">Data</label>
                @foreach ($rows as $row)
                <div class="row mb-3 data-row">
                    <div class="col">
                        <input type="text" class="form-control" name="data[]" value="{{ implode(',', $row) }}" placeholder="Enter comma-separated data for the columns">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger remove-row" onclick="removeRow(this)">Remove</button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">Add Row</button>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Table</button>
            <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Optional JS Framework (e.g., Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Add a new row for data input
        function addRow() {
            const rowHtml = `
                <div class="row mb-3 data-row">
                    <div class="col">
                        <input type="text" class="form-control" name="data[]" placeholder="Enter comma-separated data for the columns">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger remove-row" onclick="removeRow(this)">Remove</button>
                    </div>
                </div>`;
            document.getElementById('data-rows').insertAdjacentHTML('beforeend', rowHtml);
        }

        // Remove a row of data
        function removeRow(button) {
            button.closest('.data-row').remove();
        }
    </script>
</body>
</html>
