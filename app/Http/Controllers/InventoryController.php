<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
class InventoryController extends Controller
{
  
    public function index()
{
    $categories = Category::all();
    $products = Products::all();
    $selectedCategoryId = null;
   $page_open = 'inventory';
   $page_title= 'inventory';
   $user= Auth::user();

    return view('admin.inventory.admin_inventory', compact('products', 'categories', 'selectedCategoryId', 'page_open', 'user', 'page_title'));
}

    public function viewProduct($id) {
        $product = Products::find($id);
        $page_open = 'inventory';
   $page_title= 'inventory';
   $user= Auth::user();
   
        return view('admin.inventory.view_product', compact('product', 'page_open', 'user', 'page_title'));
    }
    

//     public function store(Request $request)
// {
//     $request->validate([
//         'category_id' => 'required|exists:categories,id', // Ensure a valid category is selected
//         'prod_name' => 'required|string',
//         'serial_num' => 'required|string|regex:/^[a-zA-Z0-9]+$/',
//         'manufacturer' => 'required|string',
//         'price' => 'required|integer',
//         'qty' => 'required|integer',
//         'purchased_date' => 'required|date',
//         'note' => 'required|string',
        
//     ]);

  

//     return redirect()->route('admin.inventory')->with('success', 'product added successfully');

// }
public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'prod_name' => 'required|string',
        'serial_num' => 'required|string|unique:products,serial_num', // Check for uniqueness
        'manufacturer' => 'required|string',
        'price' => 'required|numeric',
        'qty' => 'required|integer',
        'purchased_date' => 'required|date',
        'note' => 'required|string',
    ], [
        'serial_num.unique' => 'The serial number already exists.',
    ]);

    try {
        Products::create([
            'category_id' => $request->input('category_id'), 
            'prod_name' => $request->input('prod_name'),
            'serial_num' => $request->input('serial_num'),
            'manufacturer' => $request->input('manufacturer'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
            'purchased_date' => $request->input('purchased_date'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Product added successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while adding the product. Please try again.');
    }
}

    public function edit(Products $product)
{
    $categories = Category::all();
    $page_open = 'inventory';
    $page_title= 'inventory';
    $user= Auth::user();
    return view('admin.inventory.update_inv', compact('product', 'categories', 'page_open', 'user', 'page_title'));
}

public function update(Request $request, Products $product)
{
    // Validate the form data
    $validatedData = $request->validate([
        'update_category' => 'required|exists:categories,id',
        'update_prod_name' => 'required|string',
        'update_serial_num' => 'required|string',
        'update_manufacturer' => 'required|string',
        'update_price' => 'required|integer',
        'update_qty' => 'required|integer',
        'update_date' => 'required|date',
        'update_notes' => 'required|string',
    ]);

    // Update the product with the validated data
    $product->update([
        'category_id' => $validatedData['update_category'],
        'prod_name' => $validatedData['update_prod_name'],
        'serial_num' => $validatedData['update_serial_num'],
       ' manufacturer'=>$validatedData['update_manufacturer'],
       'price' => $validatedData['update_price'],
        'qty' => $validatedData['update_qty'],
        'purchased_date' => $validatedData['update_date'],
        'note'=>$validatedData['update_notes']
        
    ]);

    // Redirect back to the product listing or wherever you want
    return redirect()->route('products.index')->with('success', 'product updated successfully');
}

    public function destroy(Products $product)
    {
        $product->delete();
    
        return redirect()->back()->with('success', 'product deleted successfully');
    }
  

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        $product = Products::find($productId);
    
        if ($product) {
            $product->qty = $quantity;
            $product->save();
            return response()->json(['message' => 'Quantity updated successfully']);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    
    public function inventoryReportGeneration(Request $request)
{
    // Your inventory report generation logic goes here
    $categories = Category::all();
    $page_open = 'inv_report_generation';
    $page_title = 'Inventory Report';
    $user = Auth::user();

    // Apply filter for the purchased date
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $productsQuery = Products::query();

    if ($startDate && $endDate) {
        $productsQuery->whereBetween('purchased_date', [$startDate, $endDate]);
    }

    $filteredProducts = $productsQuery->get();
    $selectedCategoryId = null;

    return view('admin.inventory.inv_report_generation', compact('filteredProducts', 'categories', 'selectedCategoryId', 'page_open', 'user', 'page_title'));
}

// public function appointmentReportGeneration(Request $request)
// {
//     // Your appointment report generation logic goes here
//     $categories = Category::all();
//     $page_open = 'apt_report_generation';
//     $page_title = 'Appointment Report';
//     $user = Auth::user();

//     // Apply filter for the appointment date
//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date');

//     // Implement your appointment report generation logic here
//     // You might have a different data source for appointment data

//     // For example, you can create a variable to hold the appointment data
//     $filteredAppointments = [];

//     return view('admin.inventory.apt_report_generation', compact( 'page_open', 'user', 'page_title'));
// }


// public function generateProductsPDF(Request $request)
// {
//     if ($request->has('start_date') && $request->has('end_date')) {
//         $filteredProducts = Products::whereBetween('purchased_date', [$request->start_date, $request->end_date])->get();
//     } else {
//         $filteredProducts = [];
//     }

//     $pdf = PDF::loadView('admin.inventory.inv_report_generation', compact('filteredProducts'));

//     return $pdf->download('filtered_products.pdf');
// }
}