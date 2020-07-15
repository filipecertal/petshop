<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Categoria;
use App\Comentario;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $produtos = \DB::table('produtos')
            ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->select('produtos.*', 'categorias.nome AS nome_categoria')
            ->get();

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $categorias = Categoria::all();

        return view('produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $tmp = $this->validator();

        $imagem = $request->file('imagem');
        $extension = $imagem->getClientOriginalExtension();

        $filename = time().'_'.$imagem->getFilename().'.'.$extension;

        \Storage::disk('public')->put($filename, \File::get($imagem));

        $tmp['imagem'] = $filename;

       // dd($tmp);

        Produto::create($tmp);

        return redirect(route('admin.produtos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {

        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }


        $categorias = Categoria::all();

        return view('produtos.edit', compact('produto'), compact('categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $tmp = request()->validate([
            'nome' => ['required', 'max:50'],
            'categoria' => ['required', 'numeric', 'min:0'],
            'descricao' => ['required', 'min:5', 'max:255'],
            'preco' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
        ]);

        if (request('imagem') !== null) {


            $imagem = $request->file('imagem');
            $extension = $imagem->getClientOriginalExtension();
    
            $filename = time().'_'.$imagem->getFilename().'.'.$extension;
    
            \Storage::disk('public')->put($filename, \File::get($imagem));
    
            $produto->imagem = $filename;
        }

        $produto->nome = request('nome');
        $produto->categoria_id = request('categoria');
        $produto->descricao = request('descricao');
        $produto->preco = request('preco');
        $produto->stock = request('stock');

        $produto->save();

        return redirect(route('admin.produtos.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect(route('admin.produtos.index'));
    }

    public function delete(Produto $produto)
    {
        return view('produtos.delete', compact('produto'));
    }

    protected function validator()
    {
        return request()->validate([
            'nome' => ['required', 'min:3', 'max:50'],
            'categoria_id' => ['required', 'numeric', 'min:1'],
            'imagem' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'descricao' => ['required', 'min:5', 'max:255'],
            'preco' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function addToCart($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            abort(404);
        }

        $cart = session()->get('cart');

        if (!$cart) {

            $cart = [
                $id => [
                    'nome' => $produto->nome,
                    'quantidade' => request('quantidade'),
                    'preco' => $produto->preco,
                    'imagem' => $produto->imagem,
                ]
            ];

            session()->put('cart', $cart);
            return redirect()->back()->with( __('sucesso'), __('O produto foi adicionado com sucesso ao carrinho.'));
        
        } 
        
        if (isset($cart[$id])) {

            $cart[$id]['quantidade'] += request('quantidade');

            session()->put('cart', $cart);

            return redirect()->back()->with( __('sucesso'), __('O produto foi adicionado com sucesso ao carrinho.'));
     
        }

        $cart += [
            $id => [
                'nome' => $produto->nome,
                'quantidade' => request('quantidade'),
                'preco' => $produto->preco,
                'imagem' => $produto->imagem,
            ]
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with( __('sucesso'), __('O produto foi adicionado com sucesso ao carrinho.'));

    }

    public function showCart()
    {
        $cart = session()->get('cart');

        return view('produtos.showcart', compact('cart'));
    }

    public function showProduto($id)
    {
        $produto = Produto::find($id);

        return view('produtos.showproduto', compact('produto'));
    }

    public function updatecart()
    {

       $cart = session()->get('cart');

       foreach (request('quantidades') as $key=>$quantidade) {
           $cart[$key]['quantidade'] = $quantidade;
       }

       if (request('apagar') !== null) {

            foreach (request('apagar') as $item) {

                unset( $cart[$item] );
            }

       }

        session()->put('cart', $cart);

        return redirect(route('produtos.showcart'));
    }

    public function addcomment($produto_id)
    {


    
        Comentario::create(request()->validate([
            'user_id' => ['required', 'numeric'],
            'produto_id' => ['required', 'numeric'],
            'texto' => ['required', 'min:3'],
        ]));

        return redirect(url()->previous());
    }
}
