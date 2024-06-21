<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Http\Resources\Api\FaqCategoryResource;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\Enquiry;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CmsController extends Controller
{
    public function get_web_views_pages($type)
    {
        if (Str::slug($type) == 'faqs') {
            $faqCats = FaqCategory::whereHas('faqQuestions')->get();
            $faqQuestions = FaqQuestion::with('category')->get();
            return $this->toJson(view('frontend.faqsApi', compact('faqQuestions', 'faqCats'))->render());
        } else {
            $page_content = null;
            $pages = ContentPage::get();
            foreach ($pages as $page) {
                if (Str::slug($page->title) == Str::slug($type)) {
                    $page_content = $page;
                    break;
                } else {
                    $page_content = ContentPage::where('id', '=', 1)->first();
                }
            }

            return $this->toJson(view('frontend.pageContentApi')->with('slug', $type)
                ->with('page_content', $page_content)->render());
        }
    }

    public function faqs()
    {
        $faqCats = FaqCategory::whereHas('faqQuestions')->with('faqQuestions')->get();

        return $this->toJson(FaqCategoryResource::collection($faqCats));
    }

    public function contact_us(StoreEnquiryRequest $request)
    {
        $all_request = $request->all();
        $details = [
            'name' => $all_request['name'],
            'email' => $all_request['email'],
            'message' => $all_request['message'],
            'topic' => $all_request['topic'],
        ];
        try {
            Mail::to($all_request['email'])->send(new \App\Mail\ContactMail($details));
            Mail::to(config('app.email'))->send(new \App\Mail\ContactMail($details));
        } catch (\Throwable $th) {
            // throw $th;
        }

        $enquiry = Enquiry::create($details);

        return $this->toJson(null, 200, trans('afaq.sent_successfully'), true);
    }

    public function contact_info()
    {
        $contact_info = [
            'social' => [
                [
                    'link' => 'https://twitter.com/AfaqLms',
                    'icon' => asset('afaq/icons/twitter.png')
                ],
                [
                    'link' => 'https://www.instagram.com/AfaqLms/',
                    'icon' => asset('afaq/icons/Instagram.png')
                ],
                [
                    'link' => 'https://www.linkedin.com/company/%D9%85%D8%B1%D9%83%D8%B2-%D8%A7%D9%81%D8%A7%D9%82-%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8-%D8%A7%D9%84%D8%B5%D8%AD%D9%8A/',
                    'icon' => asset('afaq/icons/linkedin.png')
                ],
                [
                    'link' => 'https://www.facebook.com/AfaqLms',
                    'icon' => asset('afaq/icons/facebook.png')
                ],
            ],
            'phone' => config('app.telephone')
        ];

        return $this->toJson($contact_info);
    }
}
