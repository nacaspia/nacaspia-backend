<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlidersHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlidersRequest;
use App\Models\Slider;
use App\Models\Translation;
use App\Repositories\SlidersRepositoryImpl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SlidersController extends Controller
{
    protected $sliderRepository;
    protected $currentLang;

    public function __construct(SlidersRepositoryImpl $sliderRepository)
    {
        $this->middleware('permission:sliders-view')->only('index');
        $this->middleware('permission:sliders-create')->only(['create', 'store']);
        $this->middleware('permission:sliders-edit')->only(['edit', 'update']);
        $this->middleware('permission:sliders-delete')->only('destroy');

        $this->sliderRepository = $sliderRepository;
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
        $currentLang = $this->currentLang;
        $slider = $this->sliderRepository->edit(1);
        $locales = Translation::where('status',1)->get();
        if (!empty($slider)) {
            return view('admin.sliders.edit', compact('locales','slider'));
        }else {
            return view('admin.sliders.create', compact('locales'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locales = Translation::where('status',1)->get();
        return view('admin.sliders.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlidersRequest $slidersRequest)
    {
        try {
            $data = SlidersHelper::data($slidersRequest);
            $slider = $this->sliderRepository->create($data);
            if ($slider) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $slider->id,
                'subj_table' => 'sliders',
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
                'subj_table' => 'sliders',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = $this->sliderRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        return view('admin.sliders.edit', compact('locales','slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlidersRequest $slidersRequest, $id)
    {
        try {
            $slider = Slider::where('id',$id)->first();
            $data = SlidersHelper::data($slidersRequest,$slider);
            $pageMenu = $this->sliderRepository->update($id,$data);
            if ($pageMenu) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'sliders',
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
                'subj_table' => 'sliders',
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
            $slider = Slider::where('id',$id)->first();
            if ($this->sliderRepository->delete($slider['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'sliders',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'sliders',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }
}
