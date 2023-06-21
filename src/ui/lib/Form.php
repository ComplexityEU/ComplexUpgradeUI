<?php
declare(strict_types=1);

namespace DuoIncure\ComplexUpgradeUI\ui\lib;

use InvalidArgumentException;
use pocketmine\form\Form as IForm;
use pocketmine\player\Player;

abstract class Form implements IForm {

    const TYPE_SIMPLE = 0;

    protected array $data = [];

    private ?Form $previousForm;

    public function __construct(int $type, string $title = "", ?Form $previousForm = null) {
        $this->setType($type);
        $this->data["title"] = $title;
        $this->previousForm = $previousForm;
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title) : void {
        $this->data["title"] = $title;
    }

    /**
     * @return string
     */
    public function getTitle() : string {
        return (isset($this->data["title"]) and is_string($this->data["title"])) ? $this->data["title"] : "";
    }

    /**
     * @return ?Form
     */
    public function getPreviousForm() : ?Form{
        return $this->previousForm;
    }

    /**
     * @param int $type
     *
     * @throws InvalidArgumentException
     */
     private function setType(int $type){
         switch($type){
            case 0:
                $typeString = "form";
                break;
            case 1:
                $typeString = "modal";
                break;
            case 2:
                $typeString = "custom_form";
                break;
            default:
                throw new InvalidArgumentException("Invalid value of $type passed to Form::setType()");
        }
        $this->data["type"] = $typeString;
    }

    public function handleResponse(Player $player, $data) : void {
        $this->processData($data);
        if($data === null) {
            $this->onClose($player);
            return;
        }
        $this->onResponse($player, $data);
    }

    public function processData(&$data) : void {
    }

    public function jsonSerialize(): array{
        return $this->data;
    }


    /**
     * Children classes should implement this method to properly
     * deal with non-null player responses.
     *
     * @param Player $player
     * @param        $data
     */
    public abstract function onResponse(Player $player, $data) : void;

    /**
     * This method is called when a player closes the form without sending an response.
     *
     * @param Player $player
     */
    public function onClose(Player $player) : void {

    }
}