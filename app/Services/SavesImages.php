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
    public function save($fieldName, $destFolder, $width, $height, $oldName = NULL)
    {
        // Название изображения
        $name = str_random(32);

        // Полный путь к каталогу для сохранения
        $fullPathDestFolder = $this->imgPath . $destFolder . DIRECTORY_SEPARATOR;

        // Загруженный файл
        $uploadFile = Input::file($fieldName);
        $uploadedFileName = $name . '.' . $uploadFile->getClientOriginalExtension();

        // Сохранение с преобразование размера
        Image::make($uploadFile)
            ->resize($width, $height)
            ->save($fullPathDestFolder . $uploadedFileName);

        // Если есть старый файл, то удаляем его
        if ($oldName)
        {
            File::delete($fullPathDestFolder . $oldName);
        }

        return $uploadedFileName;
    }

}