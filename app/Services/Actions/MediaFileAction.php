<?php

namespace App\Services\Actions;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Image;

class MediaFileAction
{
    public function uploadImage(UploadedFile $file): string
    {
        //        $this->createThumbnail();
        return Cloudinary::upload($file->getRealPath(), ['folder' => 'product_images'])->getSecurePath();

    }

    public function uploadVideo(UploadedFile $file): string
    {
        return Cloudinary::uploadVideo($file->getRealPath(), ['folder' => 'product_videos'])->getSecurePath();
    }

    public function createThumbnail()
    {
        $uploadedImage = request()->file('image');
        $uploadedPath = $uploadedImage->store('uploads', 'public');

        // Create a thumbnail using Spatie Image
        $thumbnailImage = Image::load($uploadedPath)
            ->quality(40);

        // Generate a unique filename for the thumbnail
        $thumbnailFileName = 'thumbnail_'.pathinfo($uploadedPath, PATHINFO_FILENAME).'.jpg';

        dd($thumbnailFileName);
        // Save the thumbnail locally
        $thumbnailPath = storage_path('app/public/thumbnails/'.$thumbnailFileName);
        $thumbnailImage->save($thumbnailPath);

        // Resize the image to create a thumbnail

        //        return Cloudinary::upload($thumbnailPath, ['folder' => "product_images_thumbnail"])->getSecurePath();
    }
}
