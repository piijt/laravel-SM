<?php
namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller {

      public function getHome() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view ('home', ['posts' => $posts]);
      }
      public function postCreatePost(Request $request) {
        // Validation
        $this->validate($request, [
          'body' =>'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request ['body'];
        $message = 'OOPS Something went wrong';
        if ($request->user()->posts()->save($post)) {
           $message = 'Post was successfully created!';
        }
        return redirect()->route('home')->with(['message' => $message]);
      }

      public function getDeletePost($post_id) {
        $post = Post::where('id', $post_id)->first(); //argument is = because it is default
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('home')->with(['message' => 'Post was deleted']);
      }

    public function postEditPost(Request $request) {
      $this->validate($request, [
        'body' => 'required'
      ]);
      $post = Post::find($request['postId']);
      if (Auth::user() != $post->user) {
          return redirect()->back();
      }
      $post->body = $request['body'];
      $post->update();
      return response()->json(['new_body' => $post->body], 200);
    }
}
