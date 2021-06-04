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
        if (! is_null($this->invitation)) {
            return $this->isAllowed('update', $this->invitation);
        }

        return $this->isAllowed('create', new Invitation(), false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->method() === 'PUT') {
            return [];
        }

        return $this->getRulesFor('invitation');
    }
}
