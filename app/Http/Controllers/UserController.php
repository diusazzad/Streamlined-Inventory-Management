<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        return view('user.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:suppliers',
        ]);

        User::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Suppliers Created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return $users;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:255|unique:suppliers',
        ]);

        $users = User::findOrFail($id);

        $users->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'users Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'User Delete',
        ]);
    }

    // public function apiUsers()
    // {
    //     $users = User::all();

    //     return DataTables::of($users)
    //         ->addColumn('action', function ($users) {
    //             return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
    //             '<a onclick="deleteData(' . $users->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    //         })
    //         ->rawColumns(['action'])->make(true);
    // }

    // public function ImportExcel(Request $request)
    // {
    //     //Validasi
    //     $this->validate($request, [
    //         'file' => 'required|mimes:xls,xlsx',
    //     ]);

    //     if ($request->hasFile('file')) {
    //         //UPLOAD FILE
    //         $file = $request->file('file'); //GET FILE
    //         Excel::import(new SuppliersImport, $file); //IMPORT FILE
    //         return redirect()->back()->with(['success' => 'Upload file data suppliers !']);
    //     }

    //     return redirect()->back()->with(['error' => 'Please choose file before!']);
    // }

    // public function exportSuppliersAll()
    // {
    //     $suppliers = Supplier::all();
    //     $pdf = PDF::loadView('suppliers.SuppliersAllPDF', compact('suppliers'));
    //     return $pdf->download('suppliers.pdf');
    // }

    // public function exportExcel()
    // {
    //     return (new ExportSuppliers)->download('suppliers.xlsx');
    // }
}
