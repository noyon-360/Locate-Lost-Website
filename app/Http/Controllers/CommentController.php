<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\MissingPerson;
use App\Models\MissingReports;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $missingReport = MissingPerson::findOrFail($id);

        $comment = new Comment();
        $comment->missing_report_id = $missingReport->id;
        $comment->content = $request->comment;

        if (auth()->guard('web')->check()) {
            $comment->commentable_type = 'App\Models\User';
            $comment->commentable_id = auth()->guard('web')->id();
        } elseif (auth()->guard('station')->check()) {
            $comment->commentable_type = 'App\Models\Stations';
            $comment->commentable_id = auth()->guard('station')->id();
        }

        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been added.');
    }
}
