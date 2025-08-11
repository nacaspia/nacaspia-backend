<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FaqsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqsRequest;
use App\Models\Faq;
use App\Models\Translation;
use App\Repositories\FaqsRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $faqsRepository;
    protected $currentLang;

    public function __construct(FaqsRepositoryImpl $faqsRepository)
    {
        $this->middleware('permission:category-view')->only('index');
        $this->middleware('permission:category-create')->only(['create', 'store']);
        $this->middleware('permission:category-edit')->only(['edit', 'update']);
        $this->middleware('permission:category-delete')->only('destroy');

        $this->faqsRepository = $faqsRepository;
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
        $faqs = $this->faqsRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.faqs.index', compact('faqs','locales','currentLang'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(FaqsRequest $faqsRequest)
    {
        try {
            $data = FaqsHelper::data($faqsRequest);
            $faqs = $this->faqsRepository->create($data);
            if ($faqs) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $faqs->id,
                'subj_table' => 'faqs',
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
                'subj_table' => 'faqs',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqsRequest $faqsRequest, $id)
    {
        try {
            $data = FaqsHelper::data($faqsRequest);
            $faqs = $this->faqsRepository->update($id,$data);
            if ($faqs) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'faqs',
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
                'subj_table' => 'faqs',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $faqs = $this->faqsRepository->edit($id);
            if ($this->faqsRepository->delete($faqs['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'faqs',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'faqs',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }

}
