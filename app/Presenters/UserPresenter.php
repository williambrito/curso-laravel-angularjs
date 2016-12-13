<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 13/12/2016
 * Time: 23:05
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new UserTransformer();
    }
}