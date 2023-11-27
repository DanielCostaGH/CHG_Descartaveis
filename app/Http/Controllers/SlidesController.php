<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidesController extends Controller
{

    public function updateSlides(Request $request)
    {
        // Define o caminho do diretório onde as imagens serão armazenadas
        $rootDirectory = 'images/slides';
        $publicPath = public_path($rootDirectory);

        // Verifica se o diretório existe, se não, cria
        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0777, true);
        }

        // Processa cada arquivo de imagem enviado
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Move a imagem para o diretório público
            $image->move($publicPath, $filename);

            // Cria uma nova instância de Slide e salva no banco
            $slide = new Slide();
            $slide->images = $filename; // Supondo que 'image' seja o nome da coluna no banco de dados
            $slide->save();

            return response()->json(['message' => 'Imagem adicionada com sucesso!', 'slide_id' => $slide->id], 200);
        }

        return response()->json(['message' => 'Nenhuma imagem enviada.'], 400);
    }



    public function getSlides()
    {
        $slides = Slide::all();
        return response()->json($slides);
    }


    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        $imagePath = 'images/slides/' . $slide->images;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $slide->delete();

        return response()->json(['message' => 'Slide excluído com sucesso']);
    }
}
