@extends('template.default')
    @section('content')
    <section >
        <h1 class="titulo">Produto</h1>
        <div>
        <form action="{{url('/produto/inserir')}}" method="post">
        {{csrf_field()}}  
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="Produto" name="txProduto" value="Insira o produto"/>
        </div>
        
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="IdCategoria" name="txIdCategoria" value="Insira o ID da categoria"/>
        </div>
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="Valor" name="txValor" value="Insira o valor"/>
        </div>
        <div class="espaco">
            <input class="btn btn-danger" type="submit" value="Salvar"/>
        </div>

            </form>
        </div>

            <div>
            <h1 class="titulo">Consultas</h1>
            <form action="{{url('/produto')}}" method="post">
            <div class="espaco">
            <input  class="form-control" type="text" placeholder="Produto" name="txProdutoConsulta" value="Buscar produto"/>
            </div>

            <div class="espaco">
            <input class="btn btn-danger" type="submit" value="Buscar"/>
            </div>
            </form>
            
            </div>
        
            @foreach($produto as $p)
            <div class="space">
            <h1> IdProduto: {{$p->idProduto}} </h1>
            <p> IdCategoria: {{$p->idCategoria}} </p>
            <p> Produto: {{$p->produto}} </p>
            <p> Valor: {{$p->valor}} </p>
            <a href="/produto/{{$p->idProduto}}" class="link"><span class="material-symbols-outlined">delete</span></a>
            <a href="/produtoEditar/{{$p->idProduto}}/editar" class="link"><span class="material-symbols-outlined">edit</span></a>
            </div>
            @endforeach
        
    </section>
    @endsection