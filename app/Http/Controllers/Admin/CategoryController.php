<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Translation;
use App\Repositories\CategoryRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{

    protected $categoryRepository;
    protected $currentLang;

    public function __construct(CategoryRepositoryImpl $categoryRepository)
    {
        $this->middleware('permission:category-view')->only('index');
        $this->middleware('permission:category-create')->only(['create', 'store']);
        $this->middleware('permission:category-edit')->only(['edit', 'update']);
        $this->middleware('permission:category-delete')->only('destroy');

        $this->categoryRepository = $categoryRepository;
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
        $categories = $this->categoryRepository->getAll();
        $locales = Translation::where('status',1)->get();
        $mainCategories = Category::where('status',1)->get();
        $currentLang = $this->currentLang;
        return view('admin.category.index', compact('categories','mainCategories','locales','currentLang'));
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $categoryRequest)
    {
        try {
            $data = CategoryHelper::data($categoryRequest);
            $category = $this->categoryRepository->create($data);
            if ($category) {
                $messages = Lang::get('admin.add_success');
            }else{
                $messages = Lang::get('admin.add_error');
            }
            $logData = [
                'subj_id' => $category->id,
                'subj_table' => 'categories',
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
                'subj_table' => 'categories',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(CategoryRequest $categoryRequest, $id)
    {
        try {
            $data = CategoryHelper::data($categoryRequest);
            $category = $this->categoryRepository->update($id,$data);
            if ($category) {
                $messages = Lang::get('admin.up_success');
            }else{
                $messages = Lang::get('admin.up_error');
            }
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'categories',
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
                'subj_table' => 'categories',
                'description' => $exception->getMessage(),
            ];
            saveLog($logData);
            return redirect()->back()->with('errors','errors '. $messages);
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->edit($id);
            $parentCategory= Category::where(['parent_id' => $id])->get();
            $subParentCategory= Category::where(['sub_parent_id' => $id])->get();
            if (!empty($parentCategory[0])) {;
                Category::where(['parent_id' => $id])->delete();
            }elseif (!empty($subParentCategory[0])){
                Category::where(['sub_parent_id' => $id])->delete();
            }
            News::where('category_id',$id)->delete();
            if ($this->categoryRepository->delete($category['id'])) {
                $messages = Lang::get('admin.delete_success');
                $logData = [
                    'subj_id' => $id,
                    'subj_table' => 'categories',
                    'description' => $messages,
                ];
                saveLog($logData);
                return redirect()->back()->with('success', $messages);
            }
        } catch (\Exception $exception) {
            $messages = Lang::get('admin.error');
            $logData = [
                'subj_id' => $id,
                'subj_table' => 'categories',
                'description' => $messages,
            ];
            saveLog($logData);
            return redirect()->back()->with('errors', 'errors ' . $messages);
        }
    }

    public function getParentCategories(Request $request)
    {
        $parentId = $request->input('category_id');
        if (!$parentId) {
            return response()->json(['success' => false, 'message' => 'Invalid parent ID']);
        }

        // Alt kateqoriyaları gətir
        $subCategories = Category::where('parent_id', $parentId)->whereNotNull('parent_id')->whereNull('sub_parent_id')->get()->map(function ($category) {
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
        $subCategories = Category::where('sub_parent_id', $sub_parent_id)->whereNotNull('parent_id')->whereNotNull('sub_parent_id')->get()->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category['title'][$this->currentLang] ?? null,
            ];
        });

        return response()->json(['success' => true, 'subParentCategories' => $subCategories]);
    }
}
