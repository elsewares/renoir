<?php

/**
 * Helper to generate thumbnail images dynamically by saving them to the cache.
 * Alternative to phpthumb.
 * 
 * Inspired in http://net.tutsplus.com/tutorials/php/image-resizing-made-easy-with-php/
 * 
 * @author Emerson Soares (dev.emerson@gmail.com)
 * @filesource https://github.com/emersonsoares/ThumbnailsHelper-for-CakePHP
 */
class ThumbnailHelper extends HtmlHelper {

    public $absoluteCachePath = '';
    public $cachePath = '';
    public $newWidth = 150;
    public $newHeight = 225;
    public $srcWidth;
    public $srcHeight;
    public $quality = 80;
    public $path = 'uploads/files/';
    public $srcImage = '';
    public $resizeOption = 'auto';
    public $openedImage = '';
    public $imageResized = '';

    /**
     *
     * @param string $image Caminho da imagem no servidor
     * @param array $params Parametros de configuração do Thumbnail
     * @param array $options Parametros de configuração da tag <img/>
     * @return string Retorna uma tag imagem, configurada de acordo com os parametros recebidos. 
     */
    public function render($image, $params, $options = null) {
        $this->setup($image, $params);

        if (file_exists($this->absoluteCachePath . DS . $this->cachePath . DS . $this->srcImage)) {
            return array('uri' => $this->openCachedImage(),  'options' => $options);
        } else if ($this->openSrcImage()) {
            $this->resizeImage();
            $this->saveImgCache();
            return array('uri' => $this->cachePath . DS . $this->srcImage, 'options' => $options);
        }
    }

    private function setup($image, $params) {
        if (isset($params['path'])) {
            $this->path = $params['path'] . DS;
        }

        if (isset($params['width'])) {
            $this->newWidth = $params['width'];
        }

        if (isset($params['height'])) {
            $this->newHeight = $params['height'];
        }

        if (isset($params['quality'])) {
            $this->quality = $params['quality'];
        }

        if (isset($params['absoluteCachePath'])) {
            $this->absoluteCachePath = $params['absoluteCachePath'];
        } else {
            $this->absoluteCachePath = WWW_ROOT . 'img/thumbs';
        }

        if (isset($params['resizeOption'])) {
            $this->resizeOption = strtolower($params['resizeOption']);
        }

        if (isset($params['cachePath'])) {
            $this->cachePath = $params['cachePath'] . DS . $this->newWidth . 'x' . $this->newHeight . DS . $this->quality . DS . $this->resizeOption;
        } else {
            $this->cachePath = 'cache' . DS . $this->newWidth . 'x' . $this->newHeight . DS . $this->quality . DS . $this->resizeOption;
        }

        $this->srcImage = $image;
    }

    public function openCachedImage() {
        return $this->cachePath . DS . $this->srcImage;
    }

    public function openSrcImage() {
        if (file_exists($this->absoluteCachePath . DS . $this->path . DS . $this->srcImage)) {
            list($width, $heigth) = getimagesize($this->absoluteCachePath . DS . $this->path . DS . $this->srcImage);

            $this->srcWidth = $width;
            $this->srcHeight = $heigth;

            $this->openedImage = $this->openImage($this->absoluteCachePath . DS . $this->path . DS . $this->srcImage);
            return true;
        } else {
            return false;
        }
    }

    public function saveImgCache() {
        $extension = strtolower(strrchr($this->absoluteCachePath . DS . $this->path . DS . $this->srcImage, '.'));

        if (!file_exists($this->absoluteCachePath . DS . $this->cachePath))
            mkdir($this->absoluteCachePath . DS . $this->cachePath, 0777, true);

        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $this->absoluteCachePath . DS . $this->cachePath . DS . $this->srcImage, $this->quality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $this->absoluteCachePath . DS . $this->cachePath . DS . $this->srcImage);
                }
                break;
            case '.png':
                $scaleQuality = round(($imageQuality / 100) * 9);

                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                    imagepng($this->imageResized, $this->absoluteCachePath . DS . $this->cachePath . DS . $this->srcImage, $invertScaleQuality);
                }
                break;
            default:
                break;
        }

        imagedestroy($this->imageResized);
    }

    public function resizeImage() {
        $options = $this->getDimensions();

        $optimalWidth = $options['optimalWidth'];
        $optimalHeight = $options['optimalHeight'];

        $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);

        imagecopyresampled($this->imageResized, $this->openedImage, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->srcWidth, $this->srcHeight);

        if ($this->resizeOption == 'crop') {
            $this->crop($optimalWidth, $optimalHeight);
        }
    }

    public function crop($optimalWidth, $optimalHeight) {

        $cropStartX = ( $optimalWidth / 2) - ( $this->newWidth / 2 );
        $cropStartY = ( $optimalHeight / 2) - ( $this->newHeight / 2 );

        $crop = $this->imageResized;
        $this->imageResized = imagecreatetruecolor($this->newWidth, $this->newHeight);
        imagecopyresampled($this->imageResized, $crop, 0, 0, $cropStartX, $cropStartY, $this->newWidth, $this->newHeight, $this->newWidth, $this->newHeight);
    }

    public function openImage($file) {
        $extension = strtolower(strrchr($file, '.'));

        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                $img = imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = imagecreatefromgif($file);
                break;
            case '.png':
                $img = imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

    public function getDimensions() {

        switch ($this->resizeOption) {
            case 'exact':
                $optimalWidth = $this->newWidth;
                $optimalHeight = $this->newHeight;
                break;
            case 'portrait':
                $optimalWidth = $this->getSizeByFixedHeight($this->newHeight);
                $optimalHeight = $this->newHeight;
                break;
            case 'landscape':
                $optimalWidth = $this->newWidth;
                $optimalHeight = $this->getSizeByFixedWidth($this->newWidth);
                break;
            case 'auto':
                $optionArray = $this->getSizeByAuto($this->newWidth, $this->newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($this->newWidth, $this->newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    public function getSizeByFixedHeight($newHeight) {
        $ratio = $this->srcWidth / $this->srcHeight;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    public function getSizeByFixedWidth($newWidth) {
        $ratio = $this->srcHeight / $this->srcWidth;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }

    public function getSizeByAuto($newWidth, $newHeight) {
        if ($this->srcHeight < $this->srcWidth) {
            $optimalWidth = $newWidth;
            $optimalHeight = $this->getSizeByFixedWidth($newWidth);
        } elseif ($this->srcHeight > $this->srcWidth) {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight = $newHeight;
        } else {
            if ($newHeight < $newWidth) {
                $optimalWidth = $newWidth;
                $optimalHeight = $this->getSizeByFixedWidth($newWidth);
            } else if ($newHeight > $newWidth) {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight = $newHeight;
            } else {
                $optimalWidth = $newWidth;
                $optimalHeight = $newHeight;
            }
        }

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    public function getOptimalCrop($newWidth, $newHeight) {

        $heightRatio = $this->srcHeight / $newHeight;
        $widthRatio = $this->srcWidth / $newWidth;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $this->srcHeight / $optimalRatio;
        $optimalWidth = $this->srcWidth / $optimalRatio;

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

}

?>
