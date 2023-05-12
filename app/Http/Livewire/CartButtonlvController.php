<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartButtonlvController extends Component
{
    public  $data ;
    protected $listeners = ['CartdataReceived'];

    public function CartdataReceived($data){
        $this->data = $data;
    }

    public function ClearCart(){
        $this->emit('CartCleared',$status=true);
    }
    public function render()
    {
        return view('livewire.cart-buttonlv-controller');
    }
}
