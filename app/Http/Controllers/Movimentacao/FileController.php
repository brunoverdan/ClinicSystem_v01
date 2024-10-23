<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        // Pega todos os arquivos cadastrados
        $files = File::all();
        return view('Movimentacao.File.index', compact('files'));
    }

    public function store(Request $request)
    {
        // Validação do arquivo
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpeg,png,jpg|max:2048',
        ]);

        $clienteId = $request->input('cliente_id'); // Recupera o cliente_id

        // Salva o arquivo no storage
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');

            // Salva as informações no banco de dados
            File::create([
                'name' => $request->name,
                'file_path' => $filePath,
                'cliente_id' => $clienteId,
            ]);

            return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');
        }
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        // Use response()->file() para abrir o arquivo em outra aba
    return response()->file(storage_path('app/public/' . $file->file_path));
    }
}
