<?php

namespace App\Http\Controllers;

use App\Models\PublisherModel;
use App\Models\LinkModel;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;

class   PublisherController extends Controller
{
    public function index()
    {
        $publishers = PublisherModel::with(['links'])->get();
        $results = [
            "data" => $publishers,
            "code" => 200,
            "message" => "Listing tags successfully!"
        ];
        return response()->json($results);
    }

    public function store(Request $request)
    {
//        dd($request->links);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'reg_no' => 'required',
            'url' => 'required',
            'contact_details' => 'required',
            'links' => 'required',
        ]);

        $pub_name = $request->name;
        $pub_email = $request->email;
        $pub_registration_no = $request->reg_no;
        $pub_url = $request->url;
        $pub_contact_details = $request->contact_details;

        $publisher = PublisherModel::create([
            'pub_name' => $pub_name,
            'pub_email' => $pub_email,
            'pub_registration_no' => $pub_registration_no,
            'pub_url' => $pub_url,
            'pub_contact_details' => $pub_contact_details
        ]);
//        dd($publisher->id);
        foreach ($request->links as $key => $link)
        {
            LinkModel::create([
                'publisher_id' => $publisher->id,
                'Type' => $link['type'],
                'linkURLs' => $link['links_url']
            ]);
        }

//            dd($link);

        return $results = [
            "data" => $publisher,
            "code" => 200,
            "message" => "New Publisher inserted successfully"
        ];


    }

    public function  destroy(Request $request, $id) {
        if ($id) {
            $publisher = PublisherModel::findOrFail($id);
            $publisher->delete();
            $publisher = PublisherModel::all();
            return response()->json($publisher);
    }
    }
}
