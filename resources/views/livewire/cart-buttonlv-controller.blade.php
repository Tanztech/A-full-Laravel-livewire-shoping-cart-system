<div class="d-flex">
    <button id='cart-button' class="trigger btn cart-button-style d-flex text-center justify-content-between" style="width: 140px"><label >Cart</label> <span class="bg-warning " style="border-radius: 50%; width: 25px; height:25px;">{{$data}}</span></button>
    <button wire:click="ClearCart" @if($data == 0) disabled @endif class=" my-2 btn btn-danger">Clear Cart</button>
</div>
