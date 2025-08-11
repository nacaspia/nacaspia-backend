<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommitsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommitsRequest;
use App\Models\Commit;
use App\Models\Translation;
use App\Repositories\CommitsRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CommitController extends Controller
{
    protected $commitRepository;
    protected $currentLang;

    public function __construct(CommitsRepositoryImpl $commitRepository)
    {
        $this->middleware('permission:category-view')->only('index');
        $this->middleware('permission:category-create')->only(['create', 'store']);
        $this->middleware('permission:category-edit')->only(['edit', 'update']);
        $this->middleware('permission:category-delete')->only('destroy');

        $this->commitRepository = $commitRepository;
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
        $commits = $this->commitRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.commits.index', compact('commits','locales','currentLang'));
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
    public function store(CommitsRequest $commitsRequest)
    {
        try {
            $data = CommitsHelper::data($commitsRequest);
            $commit = $this->commitRepository->create($data);
            if ($commit) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $commit->id,
                'subj_table' => 'commits',
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
                'subj_table' => 'commits',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commit $commit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commit $commit)
    {
        //
    }

    public function update(CommitsRequest $commitsRequest, $id)
    {
        try {
            $data = CommitsHelper::data($commitsRequest);
            $commit = $this->commitRepository->update($id,$data);
            if ($commit) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'commit',
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
                'subj_table' => 'commits',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $commit = $this->commitRepository->edit($id);
            if ($this->commitRepository->delete($commit['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'commits',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'commits',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }

}
