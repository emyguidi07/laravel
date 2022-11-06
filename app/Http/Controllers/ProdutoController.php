<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProdutoModel;


class ProdutoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produto = ProdutoModel::all();
        return view('produto', compact('produto'));
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
    public function store(Request $request)
    {
        $produto = new ProdutoModel();
        $produto -> produto = $request->txProduto;
        $produto -> idCategoria = $request->txIdCategoria;
        $produto -> valor = $request->txValor;
        $produto -> save();
        return redirect("/produto");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $nomeProduto = $request->txProduto;

        if (isset($request->valorMin))
            $valorMin = $request->valorMin;
        else 
            $valorMin = 0;
        
        if (isset($request->valorMax))            
            $valorMax = $request->valorMax;
        else 
            $valorMax = 0;    

        
        if ($valorMax > $valorMin) {
            $produto = DB::table('tbProduto')->where('produto', 'like', '%'. $nomeProduto .'%')
            ->whereBetween('valor', array($valorMin , $valorMax))
            ->join('tbCategoria', 'tbProduto.idCategoria', '=', 'tbCategoria.idCategoria')
            ->select('categoria', 'produto', 'valor')->get();
        } elseif ($valorMin > 0) {
            $produto = DB::table('tbProduto')->where('produto', 'like', '%'. $nomeProduto .'%')
            ->where('valor','>=' , $valorMin)
            ->join('tbCategoria', 'tbProduto.idCategoria', '=', 'tbCategoria.idCategoria')
            ->select('categoria', 'produto', 'valor')->get();
        } else {
            $produto = DB::table('tbProduto')->where('produto', 'like', '%'. $nomeProduto .'%')
            ->join('tbCategoria', 'tbProduto.idCategoria', '=', 'tbCategoria.idCategoria')
            ->select('categoria', 'produto', 'valor')->get();
        }

        return view('welcome', compact('produto'));
    }
    public function edit($id)
    {
        $produto = ProdutoModel::find($id);
        $title = "Editar Produto - {$produto->produto}, {$produto->idCategoria}, {$produto->valor} ";
        return view('produtoEditar', compact('title', 'produto'));
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
        $produto = ProdutoModel::find($id);
        $produto->update(['produto'=>$request->txProduto]);
        $produto->update(['idCategoria'=>$request->txIdCategoria]);
        $produto->update(['valor'=>$request->txValor]);
        return redirect("/produto");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProdutoModel::where('idProduto',$id)->delete();
        return redirect("/produto");
    }
}
