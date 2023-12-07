<?php

namespace App\Http\Controllers;

use App\Models\ServicesWebsite;
use App\Models\Footer;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data = ['page_title' => 'website', ];
    }
    public function index()
    {
        $gallery = Gallery::all();
        $services = ServicesWebsite::all();
        
        $data = [
            'page_open' => 'services_content',
            'page_title' => 'services_content',
            'user' => Auth::user(),
            'services' => $services, 
            'gallery' => $gallery,
            
        ];

        return view('content.services', $data);
    }
    public function services_store(Request $request){
        $request->validate([
            'services_name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'services_image' => 'image|mimes:png,jpg, jpeg, gif|max:2048',
        ]);
        if ($request->hasFile('services_image')) {
            // Remove the space between 'public' and 'uploads'
            $imagePath = $request->file('services_image')->store('uploads', 'public');
        } else {
            $imagePath = null;
        }
        
        ServicesWebsite::create([
            'services_name' => $request->input('services_name'),
            'price' => $request->input('price'),
            'desc' => $request->input('desc'),
            'services_image' => $imagePath
        ]);
        return redirect()->route('content.services.index')->with('success', 'Services submitted successfully!');
    }
public function serviceUpdate(Request $request, $id){
    $request->validate([
        'services_name' =>'required',
        'desc' => 'required',
        'price'=>'required|numeric',
        'services_image'=>'image|mimes:png,jpg, jpeg,gif',
    ]);

    $services = ServicesWebsite::findOrFail($id);

    $services->update([
        'services_name'=>$request->input('services_name'),
        'price'=>$request->input('price'),
        'desc' => $request->input('desc'),

    ]);
    if ($request->hasFile('services_image')) {
        $imagePath = $request->file('services_image')->store('uploads', 'public');
        $services->update(['services_image' => $imagePath]);
    }

    return redirect()->route('content.services.index');
}
public function destroy($id){
    $services = ServicesWebsite::findOrFail($id);
    $services->delete();

    return redirect()->route('content.services.index');
}
//footer
public function footerIndex(){
    $footer = Footer::all();
    $data = [
        'page_open' => 'footer',
        'page_title' => 'footer',
        'user' => Auth::user(),
        'footer'=>$footer
    ];
        return view('content.footer', $data);
        
    
}

public function storeFooter(Request $request){
    $request->validate([
        'logo' => 'image|mimes:png,jpg,jpeg,gif',
        'facebook' => 'required',
        'address' => 'required',
        'phone' => 'numeric|digits:11',
        'copyright' => 'required',
        'days' => 'required',
        'hours' => 'required'
    ]);

    $imagePath = null;

    if ($request->hasFile('logo')) {
        $imagePath = $request->file('logo')->store('uploads', 'public');
    }

    Footer::create([
        'logo' => $imagePath,
        'facebook' => $request->input('facebook'),
        'address' => $request->input('address'),
        'phone' => $request->input('phone'),
        'copyright' => $request->input('copyright'),
        'days' => $request->input('days'),
        'hours' => $request->input('hours')
    ]);

    return redirect()->route('content.footer.index');
}

public function editFooter($id)
{
    $footer = Footer::findOrFail($id);
    return view('content.footer.edit', compact('footer'));
}

public function updateFooter(Request $request, $id)
{
    $request->validate([
        'logo' => 'image|mimes:png,jpg,jpeg,gif',
        'facebook' => 'required',
        'address' => 'required',
        'phone' => 'numeric|digits:11',
        'copyright' => 'required',
        'days' => 'required',
        'hours' => 'required',
    ]);
    

    $footer = Footer::findOrFail($id);

    // Update the fields based on the form input
    $footer->update([
        'facebook' => $request->input('facebook'),
        'address' => $request->input('address'),
        'phone' => $request->input('phone'),
        'copyright' => $request->input('copyright'),
        'days' => $request->input('days'),
        'hours' => $request->input('hours'),
    ]);

    // Update the logo if a new file is provided
    if ($request->hasFile('logo')) {
        // Remove the space between 'public' and 'uploads'
        $imagePath = $request->file('logo')->store('uploads', 'public');
        $footer->logo = $imagePath;
    }

    $footer->save();

    return redirect()->route('content.footer.index')->with('success', 'Footer updated successfully!');
}

    // public function showFooter()
    // {
    //     $data = [
    //         'user' => Auth::user(),
    //         $footerData = Footer::all()
    //     ];
    //      // Assuming you want the first record. Adjust this as needed.
       
    //     return view('content.about', $data);
    // }
    
    public function gallerystore(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'gallery_before' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_after' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // Add more validation rules if needed
    ]);

    $beforeImagePath = null;
    $afterImagePath = null;

    if ($request->hasFile('gallery_before')) {
        // Remove the space between 'public' and 'uploads'
        $beforeImagePath = $request->file('gallery_before')->store('uploads', 'public');
    }
    
    if ($request->hasFile('gallery_after')) {
        // Remove the space between 'public' and 'uploads'
        $afterImagePath = $request->file('gallery_after')->store('uploads', 'public');
    }

    Gallery::create([
        'gallery_before' => $beforeImagePath,
        'gallery_after' => $afterImagePath
    ]);

    return redirect()->route('content.services.index')->with('success', 'Gallery submitted successfully!');
}
public function galleryupdate(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'gallery_before' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_after' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // Add more validation rules if needed
    ]);

    $gallery = Gallery::findOrFail($id);

    // Update 'gallery_before' image if a new file is provided
    if ($request->hasFile('gallery_before')) {
        // Remove the space between 'public' and 'uploads'
        $beforeImagePath = $request->file('gallery_before')->store('uploads', 'public');
        $gallery->update(['gallery_before' => $beforeImagePath]);
    }

    // Update 'gallery_after' image if a new file is provided
    if ($request->hasFile('gallery_after')) {
        // Remove the space between 'public' and 'uploads'
        $afterImagePath = $request->file('gallery_after')->store('uploads', 'public');
        $gallery->update(['gallery_after' => $afterImagePath]);
    }

    return redirect()->route('content.services.index')->with('success', 'Gallery updated successfully!');
}

public function galleryDestroy($id){
    $gallery = Gallery::findOrFail($id);
    $gallery->delete();

    return redirect()->route('content.services.index');
}

}