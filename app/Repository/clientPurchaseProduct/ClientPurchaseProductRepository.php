<?php

namespace App\Repository\clientPurchaseProduct;

use App\Models\ClientPurchaseProducts;

class ClientPurchaseProductRepository implements ClientPurchaseProductInterface
{


    /**
     * @var ClientPurchaseProducts
     */
    private $clientPurchaseProducts;

    public function __construct(ClientPurchaseProducts $clientPurchaseProducts){

        $this->clientPurchaseProducts = $clientPurchaseProducts;
    }
    public function all()
    {
        $purchaseProducts=$this->clientPurchaseProducts->all();
        return $purchaseProducts;
    }

    public function findById($id)
    {
        $purchaseProduct=ClientPurchaseProducts::find($id);
        return $purchaseProduct;
    }
    public function getPurchaseProductsByClient($id)
    {
        $purchaseProducts=$this->clientPurchaseProducts->where('client_id',$id)->get();
        return $purchaseProducts;
    }
}