<?php

namespace App\Models;

use VulcanPhp\Core\Helpers\Str;
use VulcanPhp\FileSystem\Image;
use VulcanPhp\SimpleDb\Model;

class Product extends Model
{
    public static function tableName(): string
    {
        return 'products';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['title', 'category', 'price', 'quantity', 'image', 'description'];
    }

    public function save(bool $force = false)
    {
        if (input()->hasFile('image')) {
            // delete previous image
            if (isset($this->id) && isset($this->image)) {
                $this->deleteImages();
            }

            // set upload dir
            storage()->setConfig('upload_dir', 'product');

            // upload product image
            $upload = storage()->upload('image')[0];

            // set uploaded product image
            $this->load([
                'image' => str_ireplace(
                    [storage_dir(), '\\'],
                    ['', '/'],
                    $upload
                )
            ]);

            // create product thumbs
            Image::bulkResize($upload, [
                200 => 200, // small thumbnail
                400 => 400, // medium thumbnail
            ]);

            // resize original image to 600x600
            Image::resize($upload, 600, 600);
        }

        $this->title        = str_replace(['"', "'", '`'], '', $this->title ?? '');
        $this->description  = str_replace(['"', "'", '`'], '', $this->description ?? '');

        return parent::save();
    }

    public function deleteImages(): void
    {
        foreach ([
            storage_dir($this->image),
            storage_dir($this->imageSize(200, 200)),
            storage_dir($this->imageSize(400, 400)),
        ] as $image) {
            unlink($image);
        }
    }

    public function imageSize(int $width, int $height): string
    {
        $ext = pathinfo($this->image, PATHINFO_EXTENSION);

        return str_ireplace('.' . $ext, '-' . $width . 'x' . $height . '.' . $ext, $this->image);
    }

    public function getSlug(): string
    {
        return home_url(Str::slug($this->title . '-' . $this->id));
    }
}
