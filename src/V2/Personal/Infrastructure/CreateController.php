<?php

namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'imagen' => 'image|mimes:jpeg,jpg'
            ]);
        }

        $fileName = (is_null($request->foto) || $request->foto === 'null') ? null : ($id . '.' . $request->foto->extension());
        if( !is_null($request->file('foto')) ){
            $this->resizeAndSTore(300,300,$request->file('foto'),$id,$fileName);
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
            $fileName,
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

    private function resizeAndSTore( int $width, ?int $height, $image, string $idClient, string $filename ){
        $img = $image;

        //Create a Image object with the tmp path
        $image_resize = Image::make($img->getRealPath());
        $image_resize->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image_resize->save(public_path("uploads/" . $filename));
    }

}
