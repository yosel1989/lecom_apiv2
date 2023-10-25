<?php

namespace Src\V2\Personal\Infrastructure;

use App\Models\V2\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Src\V2\Personal\Application\CreateUseCase;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class CreateController
{
    private EloquentPersonalRepository $repository;

    public function __construct( EloquentPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $id         = Uuid::uuid4();

        if($request->foto !== 'null'){
            $request->validate([
                'foto' => 'image|mimes:jpeg,jpg'
            ]);
        }

        // obtener el cliente
        $cliente = Cliente::findOrFail($request->idCliente);

        $fileName = (is_null($request->foto) || $request->foto === 'null') ? null : ($id . '.' . $request->foto->extension());
        if( !is_null($request->file('foto')) ){
            $this->resizeAndSTore(300,300,$request->file('foto'),$cliente,$fileName);
        }

        $user = Auth::user();
//        $foto            = $request->file('foto');
        $apellido        = $request->input('apellido');
        $nombre          = $request->input('nombre');
        $idCliente       = $request->idCliente;
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $correo          = $request->input('correo');
        $idSede        = $request->input('idSede');
        $idEstado        = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            asset("uploads/" . $cliente->id . "/" .$fileName),
            $nombre,
            $apellido,
            $idTipoDocumento,
            $numeroDocumento,
            $correo,
            $idCliente,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }

    private function resizeAndSTore( int $width, ?int $height, $image, Cliente $cliente, string $filename ){
        $img = $image;

        //Create a Image object with the tmp path
        $image_resize = Image::make($img->getRealPath());
        $image_resize->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        // verificar que la carpeta existe, sino crearla
        if(!file_exists(public_path("uploads"))){
            mkdir(public_path("uploads"), 666, true);
        }

        // verificar que la carpeta cliente, sino crearla
        if(!file_exists(public_path("uploads/" . $cliente->id))){
            // Crear folder para el cliente
            mkdir(public_path("uploads/" . $cliente->id ), 666, true);
            // Crear archivo de información
            $info = '';
            $info .= 'Id Cliente: ' . $cliente->id . PHP_EOL;
            $info .= 'Código Cliente: ' . $cliente->codigo . PHP_EOL;
            $info .= 'Nombre Cliente: ' . $cliente->nombre . PHP_EOL;
            $info .= 'Fecha Registro: ' . $cliente->fechaRegistro . PHP_EOL;
            Storage::disk('public')->put($cliente->id . "/info.txt" , $info);
        }

        $image_resize->save(public_path("uploads/" . $cliente->id . "/" . $filename));
    }

}
