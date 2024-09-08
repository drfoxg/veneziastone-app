<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employers = resolve(Employer::class);

        if($employers instanceof Collection) {
            return view('employer', [
                'employers' => $employers,
            ]);
        }

        if(!$employers->exists) {
            $employers = Employer::all();
        }

        return view('employer', [
            'employers' => $employers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create', [
            'routeName' => 'store',
            'routeBack' => 'index',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|min:1|max:100',
            'age' => 'required|integer|min:1|max:200',
            'is_car' => ["required", "regex:/^(?:Да|Нет|да|нет)$/"],
            'children' => 'required|integer|min:0|max:100',
            'salary' => 'required|integer|min:1|max:99999999',
        ]);

        try {

            $isCar = Str::lower($data['is_car']);

            if ($isCar == "да") {
                $data['is_car'] = 1;
            } else {
                $data['is_car'] = 0;
            }

            $employer = Employer::create($data);

            Cache::put('employers:' . $employer->id, $employer);
            Cache::forget('employers:all');

        } catch (QueryException $ex) {
            return redirect()->route('index')->withFailure('Что-то пошло не так.');
        }

        return redirect()->route('index')->withSuccess('Сотрудник был добавлен успешно.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Cache::has('employers:' . $id)) {
            $employer = Cache::get('employers:' . $id);
        }

        return $employer??abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        try {
            Cache::forget('employers:' . $employer->id);
            $employer->delete();
            Cache::forget('employers:all');
        } catch (QueryException $ex) {
            return redirect()->route('index')->withFailure('Сотрудник не был удален из-за ограничений целостности.');
        }

        return redirect()->route('index')->withSuccess('Сотрудник был удален успешно.');
    }
}
