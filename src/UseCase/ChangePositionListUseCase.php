<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:49
 */

namespace App\UseCase;

use App\Entity\IAlbumArtist;
use App\Service\IPersistLayer;

/**
 * Class ChangePositionListUseCase
 * @package App\UseCase
 */
class ChangePositionListUseCase
{
    /** @var IPersistLayer */
    protected $persistLayer;


    /**
     * ChangePositionListUseCase constructor.
     *
     * @param IPersistLayer $persistLayer
     */
    public function __construct(IPersistLayer $persistLayer)
    {
        $this->persistLayer = $persistLayer;
    }


    /**
     * @param IAlbumArtist $albumArtist
     * @param string       $action
     *
     * @return IAlbumArtist
     */
    public function execute(IAlbumArtist $albumArtist, string $action): IAlbumArtist
    {
        $position    = $albumArtist->getPosition();
        $newPosition = $this->getNewPosition($action, $position);

        if ($newPosition !== $position) {
            $albumArtist->setPosition($newPosition);
            $this->persistLayer->save($albumArtist);
        }

        return $albumArtist;
    }


    /**
     * @param int $position
     * @return int
     */

    /**
     * @param string $action
     * @param int    $position
     *
     * @return int
     */
    protected function getNewPosition(string $action, int $position): int
    {
        switch ($action) {
            case 'top':
                $position = 0;
                break;

            case 'up':
                if($position > 0) {
                    --$position;
                }
                break;

            case 'down':
                ++$position;
                break;

            case 'bottom':
                $position = -1;
                break;

        }

        return $position;
    }
}