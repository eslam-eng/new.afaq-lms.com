<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewsletterRequest;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Models\Membership;
use App\Models\Newsletter;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('newsletter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletters = Newsletter::all();

        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        abort_if(Gate::denies('newsletter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.create');
    }

    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = Newsletter::create($request->all());

        return redirect()->route('admin.newsletters.index');
    }

    public function edit(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter->update($request->all());

        return redirect()->route('admin.newsletters.index');
    }

    public function show(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.show', compact('newsletter'));
    }

    public function destroy(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletter->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyNewsletterRequest $request)
    {
        Newsletter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function subscribe(Request $request)
    {
        $newsletter = Newsletter::create($request->all());
        $request->validate([
            'email' => 'email|required',
        ]);
//        return back()->with('message', app()->getLocale() == 'en' ? 'Subscribed successfully' : "تم الاشتراك بنجاح");
        return redirect()->back()->with('message',app()->getLocale() == 'en' ? 'Subscribed successfully' : "تم الاشتراك بنجاح");
    }

    public function subscribe_count(Request $request)
    {
        $sub = Membership::find($request->id);
        if ($sub) {
            $sub->subscribtion_count = $sub->subscribtion_count  + 1;
            $sub->save();
        }
    }
}
