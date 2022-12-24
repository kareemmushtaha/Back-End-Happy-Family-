<?php

namespace App\Http\Resources;


use App\Models\Aria;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use function Webmozart\Assert\Tests\StaticAnalysis\null;
use function Webmozart\Assert\Tests\StaticAnalysis\true;


class   ShowUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (auth()->check()) {
            //if user authentication

            //check user have subscription or not have
            if (checkUserHaveSubscription(auth()->user()->id)) {
                //user have subscription

                $data = [
                    'id' => $this->id,
                    'fake_name' => $this->fake_name,
                    'photo' => $this->photo,
                    'nationality' => $this->nationality,
                    'birth_date' => $this->age(),
                    'country' => Country::query()->find($this->country_id) ? Country::query()->find($this->country_id)->title : null,
                    'city' => City::query()->find($this->city_id) ? City::query()->find($this->city_id)->title : null,
                    'aria' => Aria::query()->find($this->aria_id) ? Aria::query()->find($this->aria_id)->title : null,
                    'height' => $this->height,
                    'width' => $this->width,
                    'gender' => $this->getGender(),
                    'can_contact_us' => true,
                    'auth' => true,
                    'can_show_answer_questions' => true,
                ];
            } else {
                //user  not have subscription
                $data = [
                    'id' => $this->id,
                    'fake_name' => $this->fake_name,
                    'photo' => $this->photo,
                    'nationality' => $this->nationality,
                    'birth_date' => $this->age(),
                    'country' => Country::query()->find($this->country_id) ? Country::query()->find($this->country_id)->title : null,
                    'city' => City::query()->find($this->city_id) ? City::query()->find($this->city_id)->title : null,
                    'aria' => Aria::query()->find($this->aria_id) ? Aria::query()->find($this->aria_id)->title : null,
                    'height' => $this->height,
                    'width' => $this->width,
                    'gender' => $this->getGender(),
                    'can_contact_us' => false,
                    'auth' => true,
                    'can_show_answer_questions' => true,
                ];
            }
        } else {
            //if user guest unAuthentication
            $data = [
                'id' => $this->id,
                'fake_name' => $this->fake_name,
                'photo' => $this->photo,
                'nationality' => $this->nationality,
                'birth_date' => $this->age(),
                'country' => Country::query()->find($this->country_id) ? Country::query()->find($this->country_id)->title : null,
                'city' => "******",
                'aria' => "******",
                'height' => "******",
                'width' => "******",
                'gender' => $this->getGender(),
                'can_contact_us' => false,
                'auth' => false,
                'can_show_answer_questions' => false,
            ];
        }

        return $data;
    }


}
