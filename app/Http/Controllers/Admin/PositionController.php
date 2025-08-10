<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PositionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PositionRequest;
use App\Models\LeaderShip;
use App\Models\Position;
use App\Models\Translation;
use App\Repositories\PositionRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PositionController extends Controller
{
    protected $positionRepository;
    protected $currentLang;

    public function __construct(PositionRepositoryImpl $positionRepository)
    {
        $this->middleware('permission:positions-view')->only('index');
        $this->middleware('permission:positions-create')->only(['create', 'store']);
        $this->middleware('permission:positions-edit')->only(['edit', 'update']);
        $this->middleware('permission:positions-delete')->only('destroy');

        $this->positionRepository = $positionRepository;
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


    public function parent($position_id)
    {
        $parentPosition = Position::where('parent_id',$position_id)->where('status',1)->whereNotNull('parent_id')->get();

        if (!empty($parentPosition)){
            return response()->json($parentPosition);
        }else{
            return response()->json(['success' => false, 'parentPosition' => null],422);
        }
    }

    public function index()
    {
        $positions = $this->positionRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.positions.index', compact('positions','locales','currentLang'));
    }

    public function create()
    {
        //
    }

    public function store(PositionRequest $positionRequest)
    {
        try {
            $data = PositionHelper::data($positionRequest);
            $position = $this->positionRepository->create($data);
            if ($position) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $position->id,
                'subj_table' => 'positions',
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
                'subj_table' => 'positions',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function show(Position $position)
    {
        //
    }

    public function edit(Position $position)
    {
        //
    }

    public function update(PositionRequest $positionRequest, $id)
    {
        try {
            $data = PositionHelper::data($positionRequest);
            $position = $this->positionRepository->update($id,$data);
            if ($position) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'positions',
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
                'subj_table' => 'positions',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $position = $this->positionRepository->edit($id);
            $leader = LeaderShip::where(['position_id' => $id])->first();
            if(empty($leader)){
              $leader = LeaderShip::where(['parent_position_id' => $id])->delete();
            }else{
                LeaderShip::where(['position_id' => $id])->delete();
            }
            if ($this->positionRepository->delete($position['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'positions',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'positions',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }
}
