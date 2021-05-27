<?php

namespace App\Http\Requests;

use Cratespace\Sentinel\Http\Requests\Request;

class InvitationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (! is_null($this->invitations)) {
            return $this->isAllowed('manage', $this->invitation, false);
        }

        return $this->isAuthenticated();
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

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->setErrorBag('inviteStaffMemeber');
    }
}
