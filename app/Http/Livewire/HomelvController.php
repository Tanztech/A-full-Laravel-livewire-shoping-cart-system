<?php

namespace App\Http\Livewire;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class HomelvController extends Component
{
    protected array $data = [];
    public $price =0;
    public $cartdata,$cartTotal,$cartTotalTax,$cartsubTotal,$Quantity;
    public bool $status;

    protected $listeners = ['CartCleared'];

    public function CartCleared($status){
        if ($status){
            Cart::destroy();
            session()->flash('message','cart has been cleared');
            $this->redirect('home');

        }
    }

    protected function fetchProducts(){
        return Http::get($_ENV['DEV_API_URL'].'/api/all/products')->json()['data'];
    }

    public function render()
    {

        $this->data = ['products'=>$this->fetchProducts()];
        return view('livewire.homelv-controller',$this->data);
    }

    public function AddToCart($id,$price){
        $this->data = [];
        $getProduct = $this->fetchProducts();
        foreach ($getProduct as $product){
            if ($product['id'] === $id){
                $this->data = $product;
            }
        }
       if ( Cart::add(
           [
               'id' => $this->data['p_code'],
               'name' => $this->data['p_name'],
               'qty' => 1,
               'price' => $price,
               'options' => [
                   'pg_code' => $this->data['pg_code'],
                   'uomg_code' => $this->data['uomg_code'],
                   'p_slug' => $this->data['p_slug'],
                   'p_description' => $this->data['p_description'],
                   'category_name' => $this->data['category_name'],
                   'p_tax_exempt' => $this->data['p_tax_exempt'],
               ],
               'associatedModel'=>'ninikm',
               'taxRate'=>$this->data['p_tax_exempt'],
               'isSaved'=>false,
           ])){
           $this->redirect('home');
           session()->flash('message','Product added to cart');

       } else{
           session()->flash('error','Failed to add product to cart');
       }
    }

    public function getcartData(){
       $this->cartdata =  Cart::content()->values()->toArray();
       $this->cartTotal =  Cart::total();
        $this->cartTotalTax = Cart::tax();
        $this->cartsubTotal = Cart::subtotal();;
        $this->emit('CartdataReceived',  Cart::count());
    }

    public function RemoveFromCart($Rowid,$Name,$id){
        Cart::remove($Rowid);
        session()->flash('message',$Name.'of id:'.$id.' has been removed from cart');
        $this->redirect('home');

    }
    public function updateProductQty($rowId,$Name){
     if (intval($this->Quantity) <= 0  || intval($this->Quantity) >= 20){
         session()->flash('error','Quantity must be betwteen 1 and 20');
         $this->redirect('home');
     }else{
         if (Cart::update($rowId, $this->Quantity)){
             session()->flash('message','Qty for product: '.$Name.'has been updated');
             $this->redirect('home');
         }else{
             session()->flash('error','Failed to update product quantity');
         }
     }

    }


}
