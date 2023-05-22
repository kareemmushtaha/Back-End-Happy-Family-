<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Aria;
use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isJson;
use function Webmozart\Assert\Tests\StaticAnalysis\null;


class SearchController extends Controller
{
    public $users_paginate;

    public function __construct(User $users_paginate)
    {
        $this->users_paginate = $users_paginate;
    }

    public function advanced_search()
    {
        $data['countries'] = Country::query()->get();
        $data['cities'] = City::query()->get();
        $data['questions'] = Question::query()->Active()->get();

        return view('site.advanced-search', $data);
    }

    public function filterAreas(Request $request)
    {
        $areas = Aria::query()->where('country_id', $request->country_id)->get();

        return response()->json([
            'status' => true,
            'areas' => $areas,
        ]);
    }

    public function filterCities(Request $request)
    {
        $cities = City::query()->where('aria_id', $request->area_id)->get();
        return response()->json([
            'status' => true,
            'cities' => $cities,
        ]);
    }

    public function resultAdvancedSearch(Request $request)
    {
        $search = $request->search ?? '';
        $answers = [];

        $year_from = $request->year_from ? Carbon::now()->subYear($request->year_from)->format('Y') : null;
        $year_to = $request->year_to ? Carbon::now()->subYear($request->year_to)->format('Y') : null;
        $country = $request->country ? $request->country : null;
        $area = $request->area ? $request->area : null;
        $city = $request->city ? $request->city : null;
        $height_from = $request->height_from ? intval($request->height_from) : null;
        $height_to = $request->height_to ? intval($request->height_to) : null;
        $weight_from = $request->weight_from ? intval($request->weight_from) : null;
        $weight_to = $request->weight_to ? intval($request->weight_to) : null;

        if ($request->answers) {
            if ($this->is_serialized($request->answers) == true) {
                $answers_unserialize = unserialize($request->answers);
                foreach ($answers_unserialize as $answer) {
                    if ($answer != null) {
                        array_push($answers, $answer);
                    }
                }
            } else {
                foreach ($request->answers as $answer) {
                    if ($answer != null) {
                        array_push($answers, $answer);
                    }
                }
            }
        }
        $data['country'] = $request->country;
        $data['area'] = $request->area;
        $data['city'] = $request->city;
        $data['year_from'] = $request->year_from;
        $data['year_to'] = $request->year_to;
        $data['height_from'] = $request->height_from;
        $data['height_to'] = $request->height_to;
        $data['weight_from'] = $request->weight_from;
        $data['search'] = $request->search;
        $data['weight_to'] = $request->weight_to;
        $data['answers'] = serialize($answers);
        $data['get_users'] = $this->users_paginate->query()
            ->where('id', '!=', auth()->user()->id)
            ->where('show_profile', 1)->when($country != null, function ($query_1) use ($country) {
                $query_1->where('country_id', $country);

            })->when($area != null, function ($query_2) use ($area) {

                $query_2->where('aria_id', $area);

            })->when($city != null, function ($query_3) use ($city) {

                $query_3->where('city_id', $city);

            })->when($weight_from != null && $weight_to != null, function ($query_4) use ($weight_from, $weight_to) {

                $query_4->whereBetween('width', [$weight_from, $weight_to]);

            })->when($height_from != null && $height_to != null, function ($query_5) use ($height_from, $height_to) {
                $query_5->whereBetween('height', [$height_from, $height_to]);

            })->when($year_from != null && $year_to != null, function ($query_6) use ($year_from, $year_to) {
                $query_6->whereBetween('year', [$year_to, $year_from]);

            })->when(count($answers) > 0, function ($query_7) use ($answers) {
                $query_7->whereHas('user_question_answers', function ($query_7_1) use ($answers) {
                    $query_7_1->whereIn('answer_question_id', $answers);
                });
            })->when($search, function ($query_8) use ($search) {
                $query_8->where('first_name', $search)->orWhere('last_name', $search)->orWhere('fake_name', $search);
            })->paginate(6);

        $data['users'] = \App\Http\Resources\ShowUserResource::collection($data['get_users']);

        if ($request->ajax()) {
            return view('site._resultAdvanceSearchPaginate', $data);
        } else {
            return view('site.result-search', $data);

        }
    }


    public function paginateUser(Request $request)
    {
        return $this->users_paginate;
    }

    function is_serialized($data, $strict = true)
    {
        // If it isn't a string, it isn't serialized.
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' === $data) {
            return true;
        }
        if (strlen($data) < 4) {
            return false;
        }
        if (':' !== $data[1]) {
            return false;
        }
        if ($strict) {
            $lastc = substr($data, -1);
            if (';' !== $lastc && '}' !== $lastc) {
                return false;
            }
        } else {
            $semicolon = strpos($data, ';');
            $brace = strpos($data, '}');
            // Either ; or } must exist.
            if (false === $semicolon && false === $brace) {
                return false;
            }
            // But neither must be in the first X characters.
            if (false !== $semicolon && $semicolon < 3) {
                return false;
            }
            if (false !== $brace && $brace < 4) {
                return false;
            }
        }
        $token = $data[0];
        switch ($token) {
            case 's':
                if ($strict) {
                    if ('"' !== substr($data, -2, 1)) {
                        return false;
                    }
                } elseif (false === strpos($data, '"')) {
                    return false;
                }
            // Or else fall through.
            case 'a':
            case 'O':
                return (bool)preg_match("/^{$token}:[0-9]+:/s", $data);
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool)preg_match("/^{$token}:[0-9.E+-]+;$end/", $data);
        }
        return false;
    }

}
