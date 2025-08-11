<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ServiceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use App\Models\Translation;
use App\Repositories\ServiceRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceController extends Controller
{
    protected $serviceRepository;
    protected $currentLang;

    public function __construct(ServiceRepositoryImpl $serviceRepository)
    {
        $this->middleware('permission:services-view')->only('index');
        $this->middleware('permission:services-create')->only(['create', 'store']);
        $this->middleware('permission:services-edit')->only(['edit', 'update']);
        $this->middleware('permission:services-delete')->only('destroy');

        $this->serviceRepository = $serviceRepository;
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

    public function index()
    {
        $servicesCategories = $this->serviceRepository->getAll();
        $mainServiceCategories = Service::whereNull('parent_id')->where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.services.index',compact('servicesCategories','mainServiceCategories','currentLang'));
    }

    public function orderBy(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $order => $id) {
            Service::where('id', $id)->update(['order_by' => $order + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $locales = Translation::where('status',1)->get();
        $mainServiceCategories = Service::whereNull('parent_id')->where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.services.create', compact('locales','mainServiceCategories','currentLang'));
    }

    public function store(ServiceRequest $serviceRequest)
    {
        try {
            $data = ServiceHelper::data($serviceRequest);
            $service = $this->serviceRepository->create($data);
            if ($service) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $service->id,
                'subj_table' => 'services',
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
                'subj_table' => 'services',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function show(Service $service)
    {
        //
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->edit($id);
        $locales = Translation::where('status',1)->get();
        $mainServiceCategories = Service::whereNull('parent_id')->where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.services.edit', compact('locales','mainServiceCategories','service','currentLang'));
    }

    public function update(ServiceRequest $serviceRequest, $id)
    {
        try {
            $service = Service::where('id',$id)->first();
            $data = ServiceHelper::data($serviceRequest,$service);
            $serviceUp = $this->serviceRepository->update($id,$data);
            if ($serviceUp) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'services',
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
                'subj_table' => 'services',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::where('id',$id)->first();
            $parentServiceCategory= Service::where(['parent_id' => $id])->get();
            $subParentServiceCategory= Service::where(['sub_parent_id' => $id])->get();
            if (!empty($parentServiceCategory[0])) {;
                Service::where(['parent_id' => $id])->delete();
            }elseif (!empty($subParentServiceCategory[0])){
                Service::where(['sub_parent_id' => $id])->delete();
            }
            if ($this->serviceRepository->delete($service['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'services',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success',$messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'services',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }


    public function getParentCategories(Request $request)
    {
        $parentId = $request->input('category_id');
        if (!$parentId) {
            return response()->json(['success' => false, 'message' => 'Invalid parent ID']);
        }

        // Alt kateqoriyaları gətir
        $subCategories = Service::where('parent_id', $parentId)->whereNotNull('parent_id')->whereNull('sub_parent_id')->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category['title'][$this->currentLang] ?? null,
            ];
        });

        return response()->json(['success' => true, 'parentCategories' => $subCategories]);
    }

    public function getSubCategories(Request $request)
    {
        $sub_parent_id = $request->input('parent_id');
        if (!$sub_parent_id) {
            return response()->json(['success' => false, 'message' => 'Invalid parent ID']);
        }

        // Alt kateqoriyaları gətir
        $subCategories = Service::where('sub_parent_id', $sub_parent_id)->whereNotNull('parent_id')->whereNotNull('sub_parent_id')->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category['title'][$this->currentLang] ?? null,
            ];
        });

        return response()->json(['success' => true, 'subParentCategories' => $subCategories]);
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'file' => 'required|string',
        ]);

//        $fileName = $request->input('file');
//        $data = Service::where('id',$request->id)->first();

        $fileName = $request->input('file');
        $data = Service::whereRaw("JSON_CONTAINS(files, '\"$fileName\"')")->first();
//


        if (!in_array($fileName,$data['files'])) {
            return response()->json(['success' => false, 'message' => 'Məlumat tapılmadı.']);
        }

        // faylı massivini əldə edin
        $sliderFile = $data->files; // Artıq massivdir, json_decode etməyə ehtiyac yoxdur

        // faylı massivdən sil
        if (($key = array_search($fileName, $sliderFile)) !== false) {
            unset($sliderFile[$key]); // faylı massivdən çıxar
        }

        // Yenilənmiş massiv
        $data->files = array_values($sliderFile); // İndeksləri yenilə
        $data->save(); // Məlumatları saxla

        // Fiziki faylı sil
        $filePath = public_path('uploads/service/files/' . $fileName);
        if (file_exists($filePath)) {
            unlink($filePath); // faylı sil
        }


        return response()->json(['success' => false, 'message' => 'Fayl tapılmadı'], 404);
    }

}
