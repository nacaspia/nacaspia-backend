<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UsefulLinkHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsefulLinkRequest;
use App\Models\Translation;
use App\Models\UsefulLink;
use App\Repositories\UsefulLinkRepositoryImpl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UsefulLinkController extends Controller
{
    protected $usefulLinkRepository;
    protected $currentLang;

    public function __construct(UsefulLinkRepositoryImpl $usefulLinkRepository)
    {
        $this->middleware('permission:useful-link-view')->only('index');
        $this->middleware('permission:useful-link-create')->only(['create', 'store']);
        $this->middleware('permission:useful-link-edit')->only(['edit', 'update']);
        $this->middleware('permission:useful-link-delete')->only('destroy');

        $this->usefulLinkRepository = $usefulLinkRepository;
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
        $usefulLinks = $this->usefulLinkRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.useful-link.index',compact('usefulLinks','locales','currentLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsefulLinkRequest $usefulLinkRequest)
    {
        try {
            $data = UsefulLinkHelper::data($usefulLinkRequest);
            $usefulLink = $this->usefulLinkRepository->create($data);
            if ($usefulLink) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $usefulLink->id,
                'subj_table' => 'useful_links',
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
                'subj_table' => 'useful_links',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UsefulLink $usefulLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsefulLinkRequest $usefulLinkRequest, $id)
    {
        try {
            $usefulLink = $this->usefulLinkRepository->edit($id);
            $data = UsefulLinkHelper::data($usefulLinkRequest,$usefulLink);
            $usefulLink = $this->usefulLinkRepository->update($id,$data);
            if ($usefulLink) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'useful_links',
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
                'subj_table' => 'useful_links',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $usefulLink = $this->usefulLinkRepository->edit($id);
            if ($this->usefulLinkRepository->delete($usefulLink['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'useful_links',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'useful_links',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }
}
