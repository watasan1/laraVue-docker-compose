<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\SaveContactRequest; //5_27edit
use App\Http\Resources\ContactResource; //5_30add
use Symfony\Component\HttpFoundation\Response; // 5_40add

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all() →　latest()->get()
        $contacts = ContactResource::collection(Contact::latest()->get());

        return response()->json(['contacts' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveContactRequest $request)
    {
        // 5_27 
        $contact = $request->contact;
        Contact::create($contact);
           
        return response()->json([], Response::HTTP_CREATED); // 5_40 201返却
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        // 編集用データの取得
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(SaveContactRequest $request, Contact $contact)
    {
        // 更新
        $contact->update($request->contact);

        return response()->json([],Response::HTTP_ACCEPTED); // 5_40 200 返却
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        // 削除
        $contact->delete();

        return response()->json([], Response::HTTP_NO_CONTENT); // 5_40 204 返却
    }
}
