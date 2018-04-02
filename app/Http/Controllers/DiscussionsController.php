<?php

namespace App\Http\Controllers;

use App\Http\Services\Parser;
use Auth;
use App\Http\Models\Discussion;
use App\Http\Requests\DiscussionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscussionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth' , ['only' => ['create' , 'store' , 'edit' , 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::orderBy('created_at' , 'desc')->paginate(8);
        return view('discussion.index' , compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Discussion $discussion)
    {
        return view('discussion.create' , compact('discussion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'last_user_id' => Auth::user()->id,
        ];
        $discussion = Discussion::create(array_merge($request->all() , $data));
        return redirect(route('discussion.show' , ['id' => $discussion->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $parser = new Parser();
        $html = $parser->makeHtml($discussion->content);
        return view('discussion.show' , compact('discussion' , 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        $this->authorize('update' , $discussion);
        return view('discussion.edit' , compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscussionRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $this->authorize('update' , $discussion);
        $discussion->update($request->all());
        return redirect(route('discussion.show' , ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , Discussion $discussion)
    {
        $this->authorize('delete' , $discussion);
    }
}
