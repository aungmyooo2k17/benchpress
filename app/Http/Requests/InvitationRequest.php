<?php

namespace App\Http\Requests;

use App\Models\Invitation;
use Emberfuse\Scorch\Http\Requests\Request;

class InvitationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->isAllowed('create', Invitation::class, false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('invitation');
    }
}
