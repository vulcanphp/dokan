<?php

namespace App\Models;

use VulcanPhp\Core\Helpers\Str;
use VulcanPhp\SimpleDb\Model;

class Category extends Model
{
    public static function tableName(): string
    {
        return 'categories';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['title', 'image'];
    }

    public function save(bool $force = false)
    {
        if (input()->hasFile('image')) {
            // delete previous image
            if (isset($this->id) && isset($this->image)) {
                unlink(storage_dir($this->image));
            }

            // set upload dir
            storage()->setConfig('upload_dir', 'category');

            // upload image
            $this->load([
                'image' => str_ireplace(
                    storage_dir(),
                    '',
                    storage()->upload('image')[0]
                )
            ]);
        }

        return parent::save();
    }

    public function getSlug(): string
    {
        return home_url('category/' . Str::slug($this->title) . '-' . $this->id);
    }
}
