<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;

class PasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            (new Paste())->getLatest(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paste = new Paste();
        $isSuccess = $paste->addOne($request->all());
        $code = 500;
        if ($isSuccess) {
            $code = 201;
        }
        return response()->json(
            ['success' => $isSuccess, 'link' => $paste->link], $code);
    }

    /**
     * Display the specified resource.
     *
     * @param string $link
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $link)
    {
        return response()->json(
            (new Paste())->getOne($link), 200);
    }
}
