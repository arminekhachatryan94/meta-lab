<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Validator;

class CommentsController extends Controller
{
    protected function validator(array $data) {
        return Validator::make($data, [
            'post_id' => 'required',
            'user_id' => 'required',
            'body' => 'required|string|max:255'
        ]);
    }
    protected function save(array $data) {
        return Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => $data['user_id'],
            'body' => $data['body']
        ]);
    }

    public function create(Request $request, $id) {
        $req = [
            'post_id' => $id,
            'user_id' => $request->input('user_id'),
            'body' => $request->input('body')
        ];
        $errors = $this->validator($req)->errors();
        if( count($errors) == 0 ){
            $comment = $this->save($req);
            return response()->json([ 'comment' => $comment ], 201);
        } else {
            return response()->json([ 'errors' => $errors ], 401);
        };
    }
}