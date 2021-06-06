<?php

namespace App\Http\Requests;

use App\Models\Product;
use Emberfuse\Scorch\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->isAllowed(
            'create',
            $this->product ?? new Product(),
            false
        );
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
