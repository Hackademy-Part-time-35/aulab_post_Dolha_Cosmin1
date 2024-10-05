<table class="table table-striped table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titolo</th>
      <th scope="col">Sottotitolo</th>
      <th scope="col">Redattore</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($articles as $article)
    <tr>
      <th scope="row">{{$article->id}}</th>
      <td>{{$article->title}}</td>
      <td>{{$article->subtitle}}</td>
      <td>{{$article->user->name}}</td>
      <td>
        @if (is_null($article->is_accepted))
            <a href="{{route('article.show', $article)}}" class="btn btn-secondary">Leggi l'articolo</a>
        @else
            <form action="{{route('revisor.undoArticle', $article)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary">Riporta in revisione</button>
           </form>
        @endif
      </td>

    </tr>
    @endforeach
  </tbody>
  <p>{{$article->body}}</p>
  @if (Auth::user() && Auth::user()->is_revisor)
        <div class="container my-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-evenly">
                    <form action="{{route('revisor.acceptArticle', $article)}}" method="POST">
                        @csrf 
                        <button type="submit" class="btn btn-success">Accetta l'articolo</button>

                    </form>
                    <form action="{{route('revisor.rejectArticle', $article)}}" method="POST">
                        @csrf 
                        <button type="submit" class="btn btn-danger">Rifiuta l'articolo</button>
                    </form>
                </div>
            </div>

        </div>
    @endif 
</table>