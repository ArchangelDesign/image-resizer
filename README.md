# Archangel Design Image Resizer
Free lightweight PHP 5.5 Image Resize Class

This library has been created because I've had an unusual resize request that expected a square as a result in all cases. 

Supports
  - JPEG
  - PNG
  - BMP
  - GIF

Outpust JPEG files.

## Methods

     public function avatar($targetPath, $size, array $backgroundColor = [255, 255, 255])

Outputs JPEG file as a square. Original file will fit inside a square and put in the center. The rest will be filled with specified color. Useful for avatars that are resized on the front end, css code always expects square.

    public function simpleResize($newWidth, $newHeight, $mode, $targetPath)
    
Outpust JPEG file resized to given dimensions. 3 modes are available

    const RESIZE_MODE_STRETCH = 1;
    const RESIZE_MODE_MAINTAIN_WIDTH = 2;
    const RESIZE_MODE_MAINTAIN_HEIGHT = 2;
    
    