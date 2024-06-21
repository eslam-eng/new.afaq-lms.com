<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFaqQuestionRequest;
use App\Http\Requests\StoreFaqQuestionRequest;
use App\Http\Requests\UpdateFaqQuestionRequest;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqQuestionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('faq_question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestions = FaqQuestion::all();

        return view('admin.faqQuestions.index', compact('faqQuestions'));
    }

    public function create()
    {
        abort_if(Gate::denies('faq_question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FaqCategory::pluck('category_' . app()->getLocale() . ' as category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.faqQuestions.create', compact('categories'));
    }

    public function store(StoreFaqQuestionRequest $request)
    {
        $faqQuestion = FaqQuestion::create($request->all());

        return redirect()->route('admin.faq-questions.index');
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = FaqCategory::pluck('category_' . app()->getLocale() . ' as category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $faqQuestion->load('category');

        return view('admin.faqQuestions.edit', compact('categories', 'faqQuestion'));
    }

    public function update(UpdateFaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->update($request->all());

        return redirect()->route('admin.faq-questions.index');
    }

    public function show(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->load('category');

        return view('admin.faqQuestions.show', compact('faqQuestion'));
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->delete();

        return back()->with('message', __('global.delete_account_success'));
    }

    public function massDestroy(MassDestroyFaqQuestionRequest $request)
    {
        FaqQuestion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function frontfaq()
    {
        $faqCats = FaqCategory::whereHas('faqQuestions')->orderBy('order', 'asc');
        if(request('type')){
            $faqCats = $faqCats->where('type',request('type'));
        }
        $faqCats = $faqCats->get();
        $faqQuestions = FaqQuestion::with('category')->orderBy('order', 'asc')->get();
        return view('frontend.faqs', compact('faqQuestions', 'faqCats'));
    }
    public function faq_ques_view(Request  $request)
    {
        if($request->category_id)
        {
            $faqQuestions = FaqQuestion::where('category_id',$request->category_id)->orderBy('order','asc')->get();
        }
        else {
            $faqQuestions = FaqQuestion::orderBy('order', 'asc')->get();
        }
        $faq_cats = FaqCategory::all();
        return view('admin.faqQuestions.reorder',compact('faqQuestions','faq_cats'));
    }
    public function sort_faq_ques(Request $request)

    {
        foreach ($request->order as $key => $order) {
            $faqQuestions = FaqQuestion::find($order['id'])->update(['order' => $order['order']]);
        }
        return response('Update Successfully.', 200);
    }
}
