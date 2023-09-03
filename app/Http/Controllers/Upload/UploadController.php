<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\Upload\ImageRequest;
use App\Http\Responses\DeletedResponse;
use App\Http\Responses\Image\ImageResponse;
use App\Http\Services\EntityMediatr;
use App\Http\Services\Service;
use App\Models\Images\Image;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends Controller
{

    private EntityMediatr $mediatr;

    public function __construct()
    {
        $this->mediatr = new EntityMediatr(new Image(), new Service());
    }

    #[Route('/api/image/upload', methods: ["POST"])]
    public function upload(ImageRequest $request): ImageResponse
    {
        $imageName = Storage::disk('time')->put('', $request->file('image'));
        $image = $this->mediatr->store(null, function (Image $image) use ($imageName) {
            $image->name = $imageName;
            return $image;
        });
        return ImageResponse::make($image)->created();
    }

    #[Route('/api/images', methods: ["GET"])]
    public function index(): AnonymousResourceCollection
    {
        $images = $this->mediatr->all(null, function (Image $image) {
            return $image::all();
        });
        return ImageResponse::collection($images);
    }

    #[Route('/api/images', methods: ["DELETE"])]
    public function destroy(DestroyRequest $request): DeletedResponse
    {
        $images = $this->mediatr->all(null, function (Image $image) use ($request) {
           return $image::whereIn('id', $request->all())->get();
        });
        foreach ($images as $image) {
            /** @var Image $image */
            Storage::disk($image->storage)->delete($image->name);
        }
        $this->mediatr->destroy($request->all());
        return DeletedResponse::make([])->deleted();
    }
}
