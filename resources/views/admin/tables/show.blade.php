<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $table->table_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 6px 12px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        table th {
            background-color: #f2f2f2;
        }
        .no-data {
            text-align: center;
            color: #555;
            font-size: 14px;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-left: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>{{ $table->table_name }}</h1>
    <form method="GET" action="{{ route('tables.show', $table->id) }}">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
    <table>
    <thead>
        <tr>
            @foreach($columns as $column)
                <th>
                    <a href="{{ route('tables.show', ['id' => $table->id, 'sort' => $column, 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        {{ ucfirst($column) }}
                    </a>
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody> 
        @forelse($rows as $row)
            <tr> 
                @foreach($columns as $column) 
                    <td>{{ $row[$column] ?? '-' }}</td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) }}" class="no-data">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
    <a href="{{ route('index') }}">Back to Tables</a>
</body>
</html>
