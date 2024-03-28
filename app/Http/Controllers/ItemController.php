<?php

namespace App\Http\Controllers;

use App\Imports\ItemsImport;
use App\Models\Category;
use App\Models\Item;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function importIndex()
    {
        return view('items.import');
    }


    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new ItemsImport, request()->file('excel_file'));

        return to_route('items.index')->with('success', 'Items imported successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:png,jpg'],
            'name' => ['string', 'max:200'],
            'quantity' => ['nullable', 'numeric', 'min:0'],
            'category_id' => ['required', 'numeric'],
        ]);

        //handle Image Upload
        $imagePath = $this->uploadImage($request, 'image');

        $item = new Item();
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->category_id = $request->category_id;
        $item->image = $imagePath;
        $item->save();

        toastr()->success('Item Added Successfully');
        // Redirect or return a response
        return to_route('items.index');
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
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', ('categories')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        // Validation
        $request->validate([
            'name' => ['string', 'max:200'],
            'quantity' => ['nullable', 'numeric', 'min:0'],
        ]);

        /** Handle image file */
        $imagePath = $this->uploadImage($request, 'image', $item->image);

        // Update item
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->category_id = $request->category_id;
        $item->image = !empty($imagePath) ? $imagePath : $item->image;
        $item->save();

        toastr()->success('Item Updated Successfully');
        // Redirect or return a response
        return to_route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = Item::findOrFail($id);
            if ($item->image) {
                $this->removeImage($item->image);
            }
            $item->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            //return response(['status' => 'error', 'message' => $e->getMessage()]);
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
