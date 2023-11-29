<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\product;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Http\Request;
use app\Helpers\Currency;
use App\Repositories\Cart\CartRepository;

class Cartcontroller extends Controller
{
    protected $cart;
    public function __construct(CartRepository $cart)
    {
      $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('front.cart',[
        'cart' => $this->cart
       ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);
        $product = product::findOrFail($request->post('product_id'));
        $this->cart->add($product,$request->post('quantity'));

        return redirect()->route('cart.index')->with('success','Product added to cart!');


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);
        $product = product::findOrFail($request->post('product_id'));
        $repository = new CartModelRepository();
        $repository->update($product,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cart->delete($id);


    }
}
