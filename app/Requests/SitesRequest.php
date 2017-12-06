<?php

namespace CachetHQ\Cachet\Requests;

use CachetHQ\Cachet\Requests\Request;

/**
 * Class AddMethodRequest
 * @package App\Http\Requests\Frontend\User
 */
class SitesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'url' => 'required|max:255'
        ];
    }

}