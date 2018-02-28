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
    /** @var IAlbumArtist */
    protected $albumArtist;

    /** @var IPersistLayer */
    protected $persistLayer;

    /** @var string */
    protected $action;


    /**
     * ChangePositionListUseCase constructor.
     *
     * @param IAlbumArtist  $albumArtist
     * @param IPersistLayer $persistLayer
     * @param string        $action
     */
    public function __construct(IAlbumArtist $albumArtist, IPersistLayer $persistLayer, string $action)
    {
        $this->albumArtist  = $albumArtist;
        $this->persistLayer = $persistLayer;
        $this->action       = $action;
    }


    /**
     * @return IAlbumArtist
     */
    public function execute(): IAlbumArtist
    {
        $position = $this->albumArtist->getPosition();
        $newPosition = $this->getNewPosition($position);

        if ($newPosition !== $position) {
            $this->albumArtist->setPosition($newPosition);
            $this->persistLayer->save($this->albumArtist);
        }

        return $this->albumArtist;
    }


    /**
     * @param int $position
     * @return int
     */
    protected function getNewPosition(int $position): int
    {
        switch ($this->action) {
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