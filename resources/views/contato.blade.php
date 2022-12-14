@extends('template.default')
    @section('content')
    <section>
    <h1 class="titulo">Contato</h1>
        <div>
        <form action="{{url('/contato/inserir')}}" method="post">
        {{csrf_field()}}                
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="Nome" name="txNome" value="Insira seu nome"/>
        </div>
        <div class="espaco">
            <input  class="form-control" type="email" placeholder="Email" name="txEmail" value="Insira seu email"/>
        </div>
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="Telefone" name="txTel" value="Insira seu telefone"/>
        </div>
        <div class="espaco">
            <input  class="form-control" type="textarea" placeholder="Assunto" name="txAssunto" value="Insira seu assunto"/>
        </div>
        <div class="espaco">
            <input  class="form-control" type="text" placeholder="Mensagem" name="txMsg" value="Insira sua mensagem"/>
        </div>
        <div class="espaco">
            <input class="btn btn-danger" type="submit" value="Salvar"/>
        </div>

            </form>
        </div>
   
        @foreach($contato as $c)
            <div class="space">
            <h1> Id : {{$c->idContato}} </h1>
            <p> Nome: {{$c->nome}} </p>
            <p> Email: {{$c->email}} </p>
            <p> Telefone:{{$c->fone}} </p>
            <p> Assunto: {{$c->assunto}} </p>
            <p> Mensagem: {{$c->mensagem}} </p>
            <a href="/contato/{{$c->idContato}}" class="link"><span class="material-symbols-outlined">delete</span></a>
            <a href="/contatoEditar/{{$c->idContato}}/editar" class="link"><span class="material-symbols-outlined">edit</span></a>
            </div>
            @endforeach
    </section>

    @endsection