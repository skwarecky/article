<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateAuthorEditor implements Rule
{
	private $error = '';
	private $field = '';
	private $name = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($checkedField, $name)
    {
		$this->field = $checkedField;
		$this->name = $name;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
	{
        if($value == 1){
			if(request()->get($this->field) == 1){
				$this->error = " $this->name is checked ";
				return false;
			}
		}
		if($value == 0) {
			if (request()->get($this->field) == 0) {
				$this->error = " $this->name is not checked ";
				return false;
			}
		}

		return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
	{
        return ":attribute cannot be checked if {$this->error}. ";
    }
}
