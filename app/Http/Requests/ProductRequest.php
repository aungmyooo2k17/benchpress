<?php

namespace App\Http\Requests;

use Cratespace\Sentinel\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->product) {
            return $this->isAllowed('manage', $this->product, false);
        }

        return $this->isAuthenticated('Administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('product');
    }
}
