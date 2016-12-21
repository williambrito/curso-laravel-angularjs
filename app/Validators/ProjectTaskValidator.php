<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 21/12/2016
 * Time: 09:04
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'status' => 'required'
    ];
}