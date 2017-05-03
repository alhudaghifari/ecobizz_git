<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::post('/import', function () {
    $file = request()->file('file');
    $datas = \Excel::load($file, function ($reader) {
    })->get();
    $count = 0;
    foreach ($datas as $data) {
        $user = App\User::where('email', $data->email)->first();
        if ($user)
            continue;

        $count++;
        return $data;
        $user = new App\User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->mobile_number);
        $user->address = $data->address;
        $user->description = $data->description;
        $user->owner = $data->owner;
        $user->organization_name = $data->organization_name;
        $user->role_id = App\Role::where('name', $data->role)->first() ? App\Role::where('name', $data->role)->first()->id : null;
        $user->website = $data->website;
        $user->mobile_number = $data->mobile_number;
        $user->products = $data->products;
        $user->save();

    }
    return redirect()->back()->with(['success' => 1, 'message'=>'Import berhasil, ' . $count . ' User baru']);
});

Route::get('/export', function () {
    if (Auth::guest()) {
        return redirect('/');
    }
    if (!Auth::user()->is_admin) {
        return redirect('/');
    }

    $mode = request()->mode;


    Excel::create($mode." Data", function($excel) {
         $excel->sheet('Sheetname', function($sheet) {

            /*$query = App\User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.*', 'roles.name as role')->get();
            $query = $query->join()*/

            $users = App\User::all();
            $data = [];

            foreach ($users as $user){
                $temp = $user->toArray();
                $temp['role'] = $user->role ? $user->role->name : "";
                $temp['friend_count'] = count($user->friends);
                $temp['post_count'] = count($user->posts);
                $temp['thread_count'] = count($user->threads);

                array_push($data, $temp);
            }

            $sheet->fromArray($data
                , null, 'A1', false, true);


        });
    })->download('xls');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

//link profil
Route::get('user/{id}', function($id) {
    $user = App\User::find($id);
    $posts = $user->timelines;

    \App\UserView::newView(\Auth::user(), $user);

    return view('profile', [ 'user' => $user, 'posts' => $posts]);
});

Route::get('user/{id}/edit', function($id) {
    $user = App\User::find($id);
    return view('edit', ['user' => App\User::find($id)]);
});

Route::post('user/{id}/edit', function($id) {
    if (Auth::user()->id != $id)
        return redirect("home");

    $data = request()->all();

    $user = App\User::find($id);

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->address = $data['address'] ? $data['address'] : "";
    $user->description = $data['deskripsi'];
    $user->owner = $data['pemilik'];
    $user->organization_name = $data['organizationName'];
    $user->role_id = $data['kategori'];
    $user->website = $data['website'];
    $user->mobile_number = $data['hp'];

    $user->save();

    if (request()->photo) {
        $user->uploadPhoto($data['photo']);
    }

    if (request()->organizationImage) {
        $user->uploadOrganizationChart($data['organizationImage']);
    }

    \App\UserActivity::updateActivity();

    return redirect('user/'.$id);
});

Route::post('user/{id}/timeline', function($id) {
    $post = new App\TimelinePost;
    $post->user_id = $id;
    $post->message = request()->timeline_post;
    $post->save();

    \App\UserActivity::postTimelineActivity();

    return Redirect::back();
});

Route::get('/forum', function() {
    $forums = App\Forum::all();
    return view('forum', ['forums' => $forums ]);
});

Route::get('/forum/{id}', function($id) {
    $forum = App\Forum::find($id);
    $threads = $forum->threads;
    return view('topik', ['threads' => $threads, 'forum' => $forum ]);
});

Route::get('/thread/{id}', function($id) {
    $thread = App\Thread::find($id);
    $posts = $thread->posts;

    \App\ForumView::newView(\Auth::user(), $thread);

    return view('thread', [ 'thread' => $thread,'posts' => $posts ]);
});

Route::post('/thread/{id}', function($id) {
    $post = new App\ForumPost;
    $post->thread_id = $id;
    $post->owner_id = Auth::user()->id;
    $post->content = request()->comment;
    $post->save();

    \App\UserActivity::postForumActivity($post);

    return Redirect::back();
});

Route::get('/create-forum/{id}', function ($id) {
    if (!Auth::user()) {
        return Redirect::back();
    }
    $forum = App\Forum::find($id);
    return view('newthread', ['forum' => $forum ]);
});

Route::post('/forum/{id}', function($id) {
    $thread = new App\Thread;
    $thread->name = request()->judul;
    $thread->forum_id =$id;
    $thread->owner_id = Auth::user()->id;
    $thread->save();

    $post = new App\ForumPost;
    $post->thread_id = $thread->id;
    $post->owner_id = Auth::user()->id;
    $post->content = request()->isi;
    $post->save();

    \App\UserActivity::createThreadActivity($thread);

    return redirect('forum/'.$id);
});

Route::get('/admin', function () {
    if (Auth::guest()) {
        return redirect('/');
    }
    if (!Auth::user()->is_admin) {
        return redirect('/');
    }
    $forums = App\Forum::all();
    $roles = App\Role::all();

    $forumId = request()->forumId;
    $categoryId = request()->categoryId;

    return view('admin', [ 'forums' => $forums, "roles" => $roles, 'forumId' => $forumId, 'categoryId' => $categoryId]);
});

Route::get('/admin/delete', function () {
    if (Auth::guest()) {
        return redirect('/');
    }
    if (!Auth::user()->is_admin) {
        return redirect('/');
    }

    $forumId = request()->forumId;
    $categoryId = request()->categoryId;

    $forum = App\Forum::find($forumId);
    $category = App\Role::find($categoryId);

    if ($forum)
        $forum->delete();
    if ($category)
        $category->delete();

    return redirect()->back()->with(['success' => 1, 'message'=>'Penghapusan berhasil']);
});

Route::post('/admin', function () {
    if (Auth::guest()) {
        return redirect('/');
    }
    if (!Auth::user()->is_admin) {
        return redirect('/');
    }
    if (request()->forumId) {
        $validator = Validator::make(request()->all(), [
        'judul' => 'required|string',
        'deskripsi' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['success' => 0, 'errors' => $validator->errors()]);
        }
        $new = request()->forumId == -1;
        $forum = null;
        $message = '';
        if ($new) {
            $forum = new App\Forum;
            $message = "Forum berhasil ditambahkan";
        }
        else {
            $forum = App\Forum::find(request()->forumId);
            $message = "Forum berhasil diperbarui";
        }
        $forum->name = request()->judul;
        $forum->description = request()->deskripsi;
        $forum->save();
        return redirect()->back()->with(['success' => 1, 'message' => $message]);
    } else if (request()->categoryId) {
        $validator = Validator::make(request()->all(), [
        'kategori' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['success' => 0, 'errors' => $validator->errors()]);
        }
        $new = request()->categoryId == -1;
        $role = null;
        $message = '';
        if ($new) {
            $role = new App\Role;
            $message = "Kategori berhasil ditambahkan";
        }
        else {
            $role = App\Role::find(request()->categoryId);
            $message = "Kategori berhasil diperbarui";
        }
        $role->name = request()->kategori;
        $role->save();
        return redirect()->back()->with(['success' => 1, 'message' => $message]);
    }
});

Route::get('/forum-search/{query}', function ($query) {
   $data = array();
	$forums_name = DB::table('users')
				//-> where('name', 'like', "%query%")
				-> where('name', 'LIKE', "%$query%")
				-> get();
				//dd($forums_name);
	return json_encode($forums_name);
	array_push($data, $forums_name);

	$forums_description = DB::table('forums')
				-> where('description', 'like', '%$query&')
				-> get();
				//dd($forums_description);
	array_push($data, $forums_description);

	$forum_posts_content = DB::table('forum_posts')
				-> where('content', 'like', '%$query&')
				-> get();
				//dd($forum_posts_content);
	array_push($data, $forum_posts_content);

	$threads_name = DB::table('threads')
				-> where('name', 'like', '%$query&')
				-> get();
				//dd($threads_name);

	//dd($data);
	array_push($data, $threads_name);

	//dd($data);

    return json_encode ($data);

});

Route::get('/messagelist', function() {
	if (!Auth::user()) {
        return Redirect::back();
    }
	$user = Auth::user();
	$friend_lists = $user->friends();
	return view('messagelist', ['friend_lists' => $friend_lists]);
});

Route::get('/message', function () {
    return view('message');
});

Route::get('/newmessage', function () {
    return view('newmessage');
});

Route::get('/search', 'SearchHandler@search');
