<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data = ['page_title' => 'report', ];
    }
    
    public function showFilterForm()
    {
        $page_open = 'inv_apt_generation';
        $page_title = 'Appointment Report';
        $user = Auth::user();
        $appointments = Appointment::all(); // Assuming you want to display all appointments initially
        return view('admin.inventory.apt_report_generation', compact('appointments',  'page_open', 'user', 'page_title'));
    }
    
    public function filterAppointments(Request $request)
{
    $page_open = 'inv_apt_generation';
    $page_title = 'Appointment Report';
    $user = Auth::user();
       
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Convert the start and end dates to Carbon instances for proper date comparison
    $startDateTime = Carbon::parse($startDate);
    $endDateTime = Carbon::parse($endDate);

    // Get appointments within the specified date range
    $filteredAppointments = Appointment::with('user')
        ->whereBetween('date', [$startDateTime, $endDateTime])
        ->get();

    // Pass the filtered appointments to the view
    return view('admin.inventory.apt_report_generation', compact('filteredAppointments', 'page_open', 'user', 'page_title'));
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
}
