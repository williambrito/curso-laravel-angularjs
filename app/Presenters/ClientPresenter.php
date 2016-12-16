<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 15/12/2016
 * Time: 23:05
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ClientTransformer();
    }
}