@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nome do Arquivo</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="file">Escolha o Arquivo</label>
        <input type="file" name="file" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Arquivo</button>
</form>

<hr>

<h3>Arquivos Cadastrados</h3>
<ul>
    @foreach($files as $file)
        <li>
            {{ $file->name }} 
            <a href="{{ route('files.download', $file->id) }}">Baixar</a>
        </li>
    @endforeach
</ul>
