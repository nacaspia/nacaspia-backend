<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\NewsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Translation;
use App\Repositories\NewsRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NewsController extends Controller
{
    protected $newsRepository;
    protected $currentLang;

    public function __construct(NewsRepositoryImpl $newsRepository)
    {
        $this->middleware('permission:news-view')->only('index');
        $this->middleware('permission:news-create')->only(['create', 'store']);
        $this->middleware('permission:news-edit')->only(['edit', 'update']);
        $this->middleware('permission:news-delete')->only('destroy');

        $this->newsRepository = $newsRepository;
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,['az','en','ru'])){
            return self::notFound();
        }
    }
    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = $this->newsRepository->getAll();
        $currentLang = $this->currentLang;
        return view('admin.news.index',compact('news','currentLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $categories = Category::orderBy('id','DESC')->get();
        $currentLang = $this->currentLang;
        return view('admin.news.create', compact('locales','categories','currentLang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $newsRequest)
    {
        try {

            $data = NewsHelper::data($newsRequest);
            $news = $this->newsRepository->create($data);
            if ($news) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $news->id,
                'subj_table' => 'news',
                'description' => $messages,
            ];
            saveLog($logData);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => null,
                'subj_table' => 'news',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = $this->newsRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $categories = Category::orderBy('id','DESC')->get();
        $currentLang = $this->currentLang;
        return view('admin.news.edit', compact('locales','news','categories','currentLang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $newsRequest, $id)
    {
        try {
            $news = News::where('id',$id)->first();
            $data = NewsHelper::data($newsRequest,$news);
            $newsUp = $this->newsRepository->update($id,$data);
            if ($newsUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'news',
                'description' => $messages,
            ];
            saveLog($logData);
            DB::commit();
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'news',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $news = News::where('id',$id)->first();
            if ($this->newsRepository->delete($news['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'news',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'news',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }


    public function deleteSliderImage(Request $request)
    {
        $imageName = $request->input('image'); // Silinməsi istənilən şəkil adı

        // Məlumatları əldə edin
        $data = News::whereJsonContains('slider_image', $imageName)->first();

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Məlumat tapılmadı.']);
        }

        // Şəkil massivini əldə edin
        $sliderImages = $data->slider_image; // Artıq massivdir, json_decode etməyə ehtiyac yoxdur

        // Şəkili massivdən sil
        if (($key = array_search($imageName, $sliderImages)) !== false) {
            unset($sliderImages[$key]); // Şəkili massivdən çıxar
        }

        // Yenilənmiş massiv
        $data->slider_image = array_values($sliderImages); // İndeksləri yenilə
        $data->save(); // Məlumatları saxla

        // Fiziki faylı sil
        $imagePath = public_path('uploads/news/slider_image/' . $imageName);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Şəkili sil
        }

        return response()->json(['success' => true, 'message' => 'Şəkil uğurla silindi.']);
    }

    public function orderSliderImage(Request $request)
    {
        $id = $request->input('id');
        $newOrder = $request->input('new_order'); // Yeni sıralama array şəklində gəlir

        // Məlumatları əldə edin
        $data = News::find($id);

        if (!$data) {
            return response()->json(['error' => 'Məlumat tapılmadı'], 404);
        }

        $data->slider_image = $newOrder;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Şəkil sıralaması yeniləndi']);
    }

}
