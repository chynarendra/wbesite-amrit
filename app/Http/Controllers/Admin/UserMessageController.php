<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\UserMessage;
use App\Repository\CommonRepository;

class UserMessageController extends BaseController
{
    //
    private $model;
    private $resource;
    private $viewFile = 'backend.userMessage.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'asc';
    private $paginateNo = 100;

    public function __construct(UserMessage $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }

    public function index()
    {
        $data['page_title'] = 'User Message';
        $data['page_url'] = '/user/message';
        $data['page_route'] = 'message';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }
}
