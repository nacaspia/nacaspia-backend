<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Accreditation;
use App\Models\Career;
use App\Models\Category;
use App\Models\Charter;
use App\Models\City;
use App\Models\Complaint;
use App\Models\Enlightenment;
use App\Models\HealthyEating;
use App\Models\InstituteCategory;
use App\Models\Laboratory;
use App\Models\LaboratoryCategory;
use App\Models\LeaderShip;
use App\Models\News;
use App\Models\Page;
use App\Models\PageContent;
use App\Models\Position;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Structure;
use App\Models\TariffCategory;
use App\Models\Training;
use App\Models\Useful;
use App\Models\UsefulCategory;
use App\Models\UsefulLink;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $currentLang;

    public function __construct()
    {
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,['az','en','ru'])){
            return self::notFound();
        }
    }

    public function index()
    {
        $currentLang = $this->currentLang;
        return view('site.home',compact('currentLang'));
    }

    public function about() {
        $currentLang = $this->currentLang;
        return view('site.about',compact('currentLang'));
    }

    public function projects()
    {
        $currentLang = $this->currentLang;
        return view('site.projects',compact('currentLang'));
    }

    public function projectDetail($slug)
    {
        $currentLang = $this->currentLang;
        return view('site.project-detail',compact('currentLang'));
    }

    public function serviceDetail($slug)
    {
        $currentLang = $this->currentLang;
        return view('site.service-detail',compact('currentLang'));
    }

    public function blogs()
    {
        $currentLang = $this->currentLang;
        return view('site.blogs',compact('currentLang'));
    }

    public function blogDetail($slug)
    {
        $currentLang = $this->currentLang;
        return view('site.blog-detail',compact('currentLang'));
    }

    public function contact() {
        $currentLang = $this->currentLang;
        return view('site.contact',compact('currentLang'));
    }
    public function notPage()
    {
        $currentLang = $this->currentLang;
        return view('errors.404',compact('currentLang'));
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }
}
