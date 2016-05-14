<?php
/**
 * Archangel Design Image Resizer
 * Free PHP library for image resizing
 * designed to handle unusual cases
 * copyright (c) Rafal Martinez-Marjanski
 * @date 2016-05-15
 */

namespace ArchangelDesign;
use ArchangelDesign\Exception\FileNotFoundException;
use ArchangelDesign\Exception\InvalidFormatException;

/**
 * Class ImageResizer
 * @package ArchangelDesign
 */
class ImageResizer
{
    /**
     * @var null|resource
     */
    private $fileHandle = null;

    /**
     * @var string
     */
    private $filePath = "";

    /**
     * @param string $path
     * @throws FileNotFoundException
     */
    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException("Invalid path given $path");
        }
        $this->fileHandle = $this->loadFile($path);
        $this->filePath = $path;
        return true;
    }

    /**
     * @param string $path
     * @throws InvalidFormatException
     * @return resource
     */
    private function loadFile($path)
    {
        $type = exif_imagetype($path);
        switch ($type) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_GIF:
                return imagecreatefromgif($path);
                break;
            case IMAGETYPE_PNG:
                return imagecreatefrompng($path);
                break;
            case IMAGETYPE_BMP:
                return imagecreatefromwbmp($path);
                break;
            default:
                throw new InvalidFormatException("Invalid file format $type");
        }
    }

    /**
     * Outputs a JPEG file to specified directory
     * The result is always a square of given size
     * If the input file is not a square, borders
     * are added to force  square
     * @param $targetPath
     * @param int $size - size of the square
     * @param array $backgroundColor
     */
    public function avatar($targetPath, $size, array $backgroundColor = [255, 255, 255])
    {
        $img = imagecreatetruecolor($size, $size);
        $bg = imagecolorallocate($img, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);
        imagefilledrectangle($img, 0, 0, $size, $size, $bg);

        $sourceImage = $this->fileHandle;

        $dim = getimagesize($this->filePath);
        $w = $dim[0];
        $h = $dim[1];
        $halfSize = $size / 2;

        if ($w >= $h) {
            $aspect = $h / $w;
            $h = $size * $aspect;
            $dest_y = ($halfSize - ($h / 2));
            $sourceImage = imagescale($sourceImage, $size, $h, IMG_BILINEAR_FIXED);
            imagecopy($img, $sourceImage, 0, $dest_y, 0, 0, $size, $h);
        }

        if ($h >= $w) {
            $aspect = $w / $h;
            $w = $size * $aspect;
            $dest_x = ($halfSize - ($w / 2));
            $sourceImage = imagescale($sourceImage, $w, $size, IMG_BILINEAR_FIXED);
            imagecopy($img, $sourceImage, $dest_x, 0, 0, 0, $w, $size);
        }
        imagejpeg($img, $targetPath, 100);
    }
}