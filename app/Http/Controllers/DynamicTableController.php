<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicTable;
use App\Models\DynamicTableRow;


class DynamicTableController extends Controller
{
    public function index()
    { 
        $tables = DynamicTable::all();
        return view('admin.tables.index', compact('tables'));
    }

    // Show create form
    public function create()
    {
        return view('admin.tables.create');
    }

    // Store new table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_name' => 'unique:dynamic_tables,table_name',
            'columns' => 'required|string',
            'data' => 'required|array',
        ]);
    
        $table = DynamicTable::create([
            'table_name' => $validated['table_name'],
            'columns' => json_encode(explode(',', $validated['columns'])), // Store columns as JSON
        ]);
    
        foreach ($validated['data'] as $row) {
            DynamicTableRow::create([
                'table_id' => $table->id,
                'data' => json_encode(explode(',', $row)), // Store row data as JSON
            ]);
        }
    
        return redirect()->route('index')->with('success', 'Table created successfully!');
    }
    
  
    public function show(Request $request, $id)
    {
        $table = DynamicTable::findOrFail($id);
        
        // Debug columns
        // dd($table->columns, $table->columns instanceof ArrayObject);
    
        // Ensure columns is an array
        $columns = is_array($table->columns) ? $table->columns : json_decode($table->columns, true);
        
        // Debug columns after ensuring it's an array
       
    
        $query = DynamicTableRow::where('table_id', $table->id); 
    
        // Apply search if provided
        if ($request->has('search')) {
            $query->where(function ($q) use ($columns, $request) {
                foreach ($columns as $column) {
                    $q->orWhere('data->' . $column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    
        // Apply sorting if provided
        if ($request->has('sort') && in_array($request->sort, $columns)) {
            $query->orderBy('data->' . $request->sort, $request->get('direction', 'asc'));
        }
    
        // Fetch rows and ensure it's an array
        $rows = $query->get()->map(function ($row) {
            return json_decode($row->data, true); // Ensure this is an array
        });
    
        // Debug rows to ensure they are arrays
        // dd($rows);
    
        return view('admin.tables.show', compact('table', 'columns', 'rows'));
    }
    
    
    
    
    // Show edit form
    public function edit($id)
    {
        $table = DynamicTable::findOrFail($id);

    // Fetch rows related to the table
    $rows = DynamicTableRow::where('table_id', $id)->get()->map(function ($row) {
        return $row->data; // Extract the `data` field (JSON)
    });

    return view('admin.tables.edit', compact('table', 'rows'));
    }

    // Update table
    public function update(Request $request, $id)
{
    $request->validate([
        'table_name' => 'required|unique:dynamic_tables,table_name,' . $id,
        'columns' => 'required|string',
        'data' => 'nullable|array',
    ]);

    $table = DynamicTable::findOrFail($id);

    // Update table details
    $table->update([
        'table_name' => $request->table_name,
        'columns' => json_encode(explode(',', $request->columns)), // Convert columns to JSON
    ]);

    // Clear and re-add rows
    DynamicTableRow::where('table_id', $table->id)->delete();

    if ($request->has('data')) {
        foreach ($request->data as $row) {
            DynamicTableRow::create([
                'table_id' => $table->id,
                'data' => json_encode(explode(',', $row)), // Convert row data to JSON
            ]);
        }
    }

    return redirect()->route('index')->with('success', 'Table updated successfully!');
}


    // Delete table
    public function destroy($id)
    {
        $table = DynamicTable::findOrFail($id);
        $table->delete();

        return redirect()->route('index')->with('success', 'Table deleted successfully!');
    }
}
