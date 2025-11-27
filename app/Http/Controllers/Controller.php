<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\CRUDService;
use App\Services\GeoLocalizacaoService;
use App\Services\UploadService;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $crudService;
    protected $uploadService;
    protected $geoLocalizacaoService;

    public function __construct(CRUDService $crudService, UploadService $uploadService, GeoLocalizacaoService $geoLocalizacaoService)
    {
        $this->crudService = $crudService;
        $this->uploadService = $uploadService;
        $this->geoLocalizacaoService = $geoLocalizacaoService;
    }
}
