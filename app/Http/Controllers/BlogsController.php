<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\StoreBlogscommentRequest;

use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Blogscomment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BlogsController extends Controller
{
    use MediaUploadingTrait;

    public function all_blogs()
    {
        $blogs = DB::table('blog_content_category')->select('blog_id')->pluck('blog_id')->toArray();
        $blogs = Blog::with(['categories', 'tags', 'media'])->orderBy('id', 'DESC');
        if(request('type')){
            $blogs = $blogs->whereHas('categories',function($categories){
                $categories->where('type','Business');
            });
        }else{
            $blogs = $blogs->where('type','AFAQ');
        }
        $blogs =$blogs->paginate(10);
        $ContentCategory = ContentCategory::get();
        return view('frontend.blogs_list')->with('ContentCategory', $ContentCategory)
            ->with('blogs', $blogs);
    }

    public function index($category_id)
    {
        $blogs = DB::table('blog_content_category')->select('blog_id')
            ->where('content_category_id', $category_id)->pluck('blog_id')->toArray();
        $blogs = Blog::with(['categories', 'tags', 'media'])->whereIn('id', $blogs)->orderBy('id', 'DESC')->paginate(10);
        $ContentCategory = ContentCategory::get();
        return view('frontend.blogs_list')->with('ContentCategory', $ContentCategory)
            ->with('blogs', $blogs);
    }

    public function view($lang, $article_id)
    {
        $article = Blog::where('id', $article_id)->withCount('blogBlogscomments')->with('blogBlogscomments')->firstOrFail();
        $article_arr = $article->toArray();

        $all_comments = [];
        $approved_comments = [];
        if (!empty($article_arr['blog_blogscomments'])) {
            $all_comments = $article_arr['blog_blogscomments'];
        }
        foreach ($all_comments as $k => $v) {
            if ($v['approved'] == 1) {
                $approved_comments[] = $v;
            }
        }

        $ContentCategory = ContentCategory::get();

        return view('frontend.article')->with('ContentCategory', $ContentCategory)
            ->with('blog', $article)->with('approved_comments', $approved_comments);
    }
    public function storeComment(StoreBlogscommentRequest $request)
    {
        $blogscomment = Blogscomment::create($request->all());

        if ($request->input('image', false)) {
            $blogscomment->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blogscomment->id]);
        }

        return redirect()->route('admin.blogscomments.index');
    }

    public function comment_create(StoreBlogscommentRequest $request)
    {
        $all_request_data = $request->all();
        $blogscomment = Blogscomment::create($all_request_data);
        return back()->withSuccess(trans('global.comment_sent'));
    }
}
