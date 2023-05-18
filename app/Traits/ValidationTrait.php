<?php
namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

trait ValidationTrait
{
    public function validateData($data, $rules)
    {
        return Validator::make($data, $rules);
    }
}
