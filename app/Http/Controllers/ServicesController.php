<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['services'] = Services::all();
        $data['page_open'] = 'services';
        $data['page_title'] = 'services';
        $data['user'] = Auth::user();

        return view('admin.services', $data);
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
        try {
            $validate = Validator::make($request->all(), [
                "service" => "required",
                "price" => "required|numeric",
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
            } else {
                try {
                    $data = array(
                        'service_name'  => $request->service,
                        'price'  => $request->price,
                    );

                    $service = Services::create($data);


                    if ($service) {
                        return response()->json(['status' => 200, 'msg' => 'Inserted Succesfully', 'data' => $data], 200);
                    } else {
                        return response()->json(['status' => 500, 'msg' => 'Invalid query.'], 500);
                    }
                } catch (\Exception $e) {
                    abort(500, 'Something Went Wrong');
                }
            }
        } catch (\Exception $e) {
            abort(500, 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $id = $request->id;

            $service = Services::where('id', $id)->get()[0];
            $res['data'] = $service;

            return response()->json($res, 200);
        } catch (\Exception $e) {

            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "id" => "required",
                "service" => "required",
                "price" => "required",
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => 400, 'error' => $validate->getMessageBag()]);
            } else {
                try {
                    $id = $request->id;

                    if ($id == 1) {
                        abort(401, 'Unauthorized request!');
                    }

                    $data = array(
                        'service_name' => $request->service,
                        'price' => $request->price,
                    );

                    $service = Services::where('id', $id)->update($data);

                    if ($service) {
                        return response()->json(['status' => 200, 'msg' => 'Updated Succesfully']);
                    } else {
                        return response()->json(['status' => 500, 'msg' => 'Invalid query.'], 500);
                    }
                } catch (\Exception $e) {
                    abort(500, 'Something Went Wrong');
                }
            }
        } catch (\Exception $e) {
            abort(500, 'Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }


    public function getallservices()
    {
        $services = Services::all();

        $response['data'] = $services;

        return response()->json($response);
    }

    public function select(Request $request)
    {
        $id = $request->id;
        $service = Services::where('id', $id)->get();

        if (count($service)) {
            $data['id'] = $id;
            $data['data'] = $service;
            return response()->json($data, 200);
        } else {
            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $service = Services::where('id', $id)->get();

        if (count($service) > 0) {
            $service = Services::where('id', $id)->delete();
            if ($service) {
                return response()->json(['msg' => 'Success'], 200);
            } else {
                return response()->json(['msg' => 'Invalid Query'], 500);
            }
        } else {
            return response()->json(['msg' => 'Bad request. ID is not found.'], 400);
        }
    }

    public function getservicesdata()
    {

        $services = Services::all();
        $labels = [];
        $data = [];
        

        foreach ($services as $key => $service) {
            $name = $service->service_name;
            $count = Appointment::where('service_id', $service->id)->where('status', '3')->count();
            array_push($labels, $name);
            array_push($data, $count);
        }

        $response['labels'] = $labels;
        $response['data'] = $data;


        return response()->json($response);
    }

}
