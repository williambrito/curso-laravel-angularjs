<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 15:14
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'file' => 'required|mimes:jpeg,jpg,png,pdf,zip'
    ];
}