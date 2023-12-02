<?php

namespace Src\V2\Personal\Infrastructure;

use App\Models\V2\Cliente;
use App\Models\V2\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Src\V2\Personal\Application\UpdateUseCase;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class UpdateController
{
    private EloquentPersonalRepository $repository;

    public function __construct( EloquentPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $fecha = new \DateTime();

        if($request->foto !== 'null'){
            $request->validate([
                'foto' => 'image|mimes:jpeg,jpg'
            ]);
        }

//        throw new \InvalidArgumentException($request->input('idCliente'));

        // obtener el cliente y el personal
        $cliente = Cliente::findOrFail($request->input('idCliente'));
        $personal = Personal::findOrFail($request->id);


        $fileName = (is_null($request->foto) || $request->foto === 'null') ? null : ($request->id . '.' . $fecha->getTimestamp() . '.' . $request->foto->extension());
        if( !is_null($request->file('foto')) ){
            $this->resizeAndSTore(300,300,$request->file('foto'),$cliente,$fileName);
        }

        // Eliminar la foto antigua si se cambio o elimino
        if($request->input('cambioFoto') && $personal->foto){
            if (File::exists(public_path($personal->foto))) {
                File::delete(public_path($personal->foto));
            }
        }

//        dd($request->input('apellido'));

        $user = Auth::user();
        $idPersonal      = $request->id;
        $foto            = $fileName ? ("uploads/" . $cliente->id . "/" .$fileName) : null;
        $apellido        = $request->input('apellido');
        $nombre          = $request->input('nombre');
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $correo          = $request->input('correo');
        $idSede          = $request->input('idSede');
        $idEstado        = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idPersonal,
            $foto,
            $nombre,
            $apellido,
            $idTipoDocumento,
            $numeroDocumento,
            $correo,
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
            mkdir(public_path("uploads"), 0755, true);
        }

        // verificar que la carpeta cliente, sino crearla
        if(!file_exists(public_path("uploads/" . $cliente->id))){
            // Crear folder para el cliente
            mkdir(public_path("uploads/" . $cliente->id ), 0755, true);
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
