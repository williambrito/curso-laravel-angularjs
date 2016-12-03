<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 02/12/2016
 * Time: 23:05
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}