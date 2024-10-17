@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('files.store', ['cliente_id' => $cliente->id]) }}" method="POST" enctype="multipart/form-data">
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

<h3 class="my-4">Arquivos Cadastrados</h3>

@if($files->isEmpty())
    <p>Nenhum arquivo cadastrado.</p>
@else
    <div class="list-group">
        @foreach($files as $file)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-file-earmark"></i> <!-- Ícone de arquivo -->
                    {{ $file->name }}
                </span>
                <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-download"></i> <!-- Ícone de download -->
                    Baixar
                </a>
            </div>
        @endforeach
    </div>
@endif

