<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BlogServiceInterface;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\NotificationServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $blogService;
    private $commonService;
    private $notificationService;

    public function __construct(
        NotificationServiceInterface $notificationService,
        BlogServiceInterface $blogService,
        CommonServiceInterface $commonService
    )
    {
        $this->notificationService = $notificationService;
        $this->blogService = $blogService;
        $this->commonService = $commonService;
    }

    public function homePage()
    {
        return view('home');
    }

    public function accommmadationPage()
    {
        return view('accommodation');
    }

    public function aboutusPage()
    {
        return view('about');
    }

    public function galleryPage()
    {
        return view('gallery');
    }

    public function packagesPage()
    {
        return view('packages-rates');
    }

    public function contactUsPage(Request $request)
    {
        $countries = $this->commonService->retrieveCountryList();

        $data = compact('countries');
        return view('contact', $data);
    }

    public function termsCondtionsPage(Request $request)
    {
        return view('terms-and-conditions');
    }

    public function acknowledgement($param)
    {
        $bookingId = decrypt($param);

        $data = compact('bookingId');
        return view('acknowledgements.inquiry-success', $data);
    }

    public function blogsPage()
    {
        $posts = [];

        $posts = $this->blogService->getAllPosts();
        //dd($posts);
        return view('blogs', compact('posts'));

    }

    public function showPost(string $postSlug)
    {
        // $post = null;

        // $post = $this->blogService->getPostBySlug($postSlug);
        //dd($post);
        // return view('blog.show', compact('post'));
        return view('blog-view');
    }

    public function learnAboutParkPage()
    {
        return view('infor-park-details');
    }

    public function getCountries(Request $request)
    {
        if($request->ajax()){
            $countries = $this->commonService->retrieveCountryList();

            return response()->json([
                "data" => $countries
            ]);
        }
    }
}
