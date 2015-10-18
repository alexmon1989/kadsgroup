<?php namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class SavesImages {

    private $imgPath;

    public function __construct()
    {
        $this->imgPath = public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);
    }

    /**
     * Метод для сохранения изображения в соотв. папку
     *
     * @param $fieldName    Название поля формы, из которой произв. загрузка
     * @param $destFolder   Каталог для сохранения (относительно public/assets/img/)
     * @param $width Ширина, пикс.
     * @param $height Высота, пикс.
     * @param $oldName старое название (если параметр передан, то файл будет удалён)
     *
     * @return string Название файла изображения
     */
    public function save($fieldName, $destFolder, $width = NULL, $height = NULL, $oldName = NULL)
    {
        // Ширина и высота не могут быть NULL одновременно
        if (is_null($width) && is_null($height)) {
            throw new Exception('Ширина и высота не могут быть NULL одновременно.');
        }

        // Название изображения
        $name = str_random(32);

        // Полный путь к каталогу для сохранения
        $fullPathDestFolder = $this->imgPath . $destFolder . DIRECTORY_SEPARATOR;

        // Загруженный файл
        $uploadFile = Input::file($fieldName);
        $uploadedFileName = $name . '.' . $uploadFile->getClientOriginalExtension();

        $img = Image::make($uploadFile);
        // Если указаны оба аргумента, то сохраняем без сохранения пропорций
        if ($width && $height) {
            $img->resize($width, $height);
        }
        // А если один из них не указан, то сохраняем пропорции
        if (is_null($width)) {
            $img->resize(NULL, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if (is_null($height)) {
            $img->resize($width, NULL, function ($constraint) {
                $constraint->aspectRatio();
            });
        }


        $img->save($fullPathDestFolder . $uploadedFileName);

        // Если есть старый файл, то удаляем его
        if ($oldName)
        {
            File::delete($fullPathDestFolder . $oldName);
        }

        return $uploadedFileName;
    }

}