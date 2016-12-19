<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 15:14
 */

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,pdf,zip'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'description' => 'required'
        ]
    ];
}