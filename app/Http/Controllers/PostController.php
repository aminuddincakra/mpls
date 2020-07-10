<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PostController
 * @package App\Http\Controllers\API
 */

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->middleware('auth');     
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /posts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $this->postRepository->pushCriteria(new LimitOffsetCriteria($request));
        $posts = $this->postRepository->orderBy('id', 'DESC')->paginate(20);

        return view('dashboard.post.index')->with('posts',$posts);
    }

    public function create()
    {
        return view('dashboard.post.create');
    }

    /**
     * Store a newly created Post in storage.
     * POST /posts
     *
     * @param CreatePostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostAPIRequest $request)
    {
        $input = $request->all();

        $input['status'] = ($request->status) ? 1 : 0;
        $input['pinned'] = ($request->pinned) ? 1 : 0;
        $posts = $this->postRepository->create($input);

        flash('Selamat, '.$request->name.' berhasil disimpan','success');
        return redirect('dashboard/post');
    }

    public function edit($id)
    {
        /** @var Post $post */
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/post');
        }

        return view('dashboard.post.edit')->with('post',$post);
    }

    /**
     * Display the specified Post.
     * GET|HEAD /posts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Post $post */
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            return $this->sendError('Post not found');
        }

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully');
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /posts/{id}
     *
     * @param  int $id
     * @param UpdatePostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostAPIRequest $request)
    {
        $input = $request->all();

        /** @var Post $post */
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/post');
        }

        $input['status'] = ($request->status) ? 1 : 0;
        $input['pinned'] = ($request->pinned) ? 1 : 0;
        $post = $this->postRepository->update($input, $id);

        flash('Selamat, '.$request->name.' berhasil diupdate','success');
        return redirect('dashboard/post');
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /posts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Post $post */
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/post');
        }

        flash('Selamat, '.$post->name.' berhasil dihapus','success');
        $post->delete();
        return redirect('dashboard/post');           
    }
}
