<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\CRUDService;
use App\Services\GeoLocalizacaoService;
use App\Services\UploadService;
use App\Services\NotificacaoService;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $crudService;
    protected $uploadService;
    protected $geoLocalizacaoService;
    protected $notificacaoService;

    public function __construct(
        CRUDService $crudService, 
        UploadService $uploadService, 
        GeoLocalizacaoService $geoLocalizacaoService,
        NotificacaoService $notificacaoService
    )
    {
        $this->crudService = $crudService;
        $this->uploadService = $uploadService;
        $this->geoLocalizacaoService = $geoLocalizacaoService;
        $this->notificacaoService = $notificacaoService;
    }

    protected function validaOwner($obj) {
        abort_if($obj->user_id != session('user_id'), 403);
    }
}
