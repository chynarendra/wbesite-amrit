<?php

namespace App\Repository\clientPurchaseProduct;

interface ClientPurchaseProductInterface
{
    public function all();
    public function getPurchaseProductsByClient($id);
    public function findById($id);

}