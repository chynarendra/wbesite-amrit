<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientPurchaseProductValidation;
use App\Http\Requests\PurchaseProductRequest;
use App\Models\ClientDetail;
use App\Models\ClientPurchaseProducts;
use App\Models\Configurations\Office;
use App\Models\Product;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\clientPurchaseProduct\ClientPurchaseProductInterface;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ClientPurchaseProductController extends Controller
{
    /**
     * @var ClientPurchaseProductInterface
     */
    private $clientPurchaseProductInterface;
    /**
     * @var AppUserInterface
     */
    private $appUser;
    /**
     * @var ClientDetail
     */
    private $clientDetail;
    /**
     * @var CommonRepository
     */
    private $commonRepository;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Office
     */
    private $office;
    /**
     * @var ClientPurchaseProducts
     */
    private $clientPurchaseProducts;
    private $logMenu = 29;
    /**
     * @var ResourceController
     */
    private $resourceController;

    public function __construct(ClientPurchaseProductInterface $clientPurchaseProductInterface,
                                AppUserInterface $appUser,ClientDetail $clientDetail,ClientPurchaseProducts $clientPurchaseProducts,
                                CommonRepository $commonRepository,Product $product,Office $office,ResourceController $resourceController){

        $this->clientPurchaseProductInterface = $clientPurchaseProductInterface;
        $this->appUser = $appUser;
        $this->clientDetail = $clientDetail;
        $this->commonRepository = $commonRepository;
        $this->product = $product;
        $this->office = $office;
        $this->clientPurchaseProducts = $clientPurchaseProducts;
        $this->resourceController = $resourceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($appUserId,$id)
    {
        //
        $purchaseProducts=$this->clientPurchaseProductInterface->getPurchaseProductsByClient($id);
        $clientDetail=$this->commonRepository->findById($this->clientDetail ,$id);
        $productList=$this->commonRepository->all($this->product, 'id', 'asc');
        $officeList=$this->commonRepository->all($this->office, 'id', 'asc');
        return view('backend.ClientPurchaseProduct.index',compact('purchaseProducts','appUserId','officeList','clientDetail','productList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientPurchaseProductValidation $request)
    {
        $data = $request->all();
        $data['created_by_user_id'] = Auth::user()->id;
        $response = $this->resourceController->store($this->clientPurchaseProducts,$data, $this->logMenu);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($clientId,$id)
    {
        $purchaseProduct=$this->clientPurchaseProductInterface->findById($id);
        $purchaseProducts=$this->clientPurchaseProductInterface->getPurchaseProductsByClient($clientId);
        $clientDetail=$this->commonRepository->findById($this->clientDetail ,$clientId);
        $appUserId=$clientDetail->app_user_id;
        $productList=$this->commonRepository->all($this->product, 'id', 'asc');
        $officeList=$this->commonRepository->all($this->office, 'id', 'asc');
        if($purchaseProduct){
            return view('backend.ClientPurchaseProduct.index',compact('purchaseProducts','productList','officeList','appUserId','clientDetail','purchaseProduct'));
        }else{
            session()->flash('error','Data not found');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$appUserId,$clientid,$id)
    {
        $data  = $request->all();
        $this->resourceController->update($this->clientPurchaseProducts, $id, $data, $this->logMenu);
        session()->flash('success','Purchase product updated successfully!');

        return redirect(url('client/purchaseproduct/'.$appUserId.'/'.$clientid));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->resourceController->destroy($this->clientPurchaseProducts, $id, $this->logMenu);
        return $response;
    }
}
