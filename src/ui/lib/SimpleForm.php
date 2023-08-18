<?php
declare(strict_types=1);

namespace DuoIncure\ComplexUpgradeUI\ui\lib;

use pocketmine\form\FormValidationException;

abstract class SimpleForm extends Form{

    const IMAGE_TYPE_PATH = 0;
    const IMAGE_TYPE_URL = 1;

    private string $content = "";

    private array $labelMap = [];


    public function __construct(string $title = "", ?Form $previousForm = null){
        parent::__construct(self::TYPE_SIMPLE ,$title, $previousForm);
        $this->data["content"] = $this->content;
    }

    public function processData(&$data) : void {
        if($data !== null) {
            if (!is_int($data)) {
                throw new FormValidationException("Expected an integer response, got " . gettype($data));
            }
            $count = count($this->data["buttons"]);
            if ($data >= $count || $data < 0) {
                throw new FormValidationException("Button $data does not exist");
            }
            $data = $this->labelMap[$data] ?? null;
        }
    }

    /**
     * @return string
     */
    public function getContent() : string {
        return $this->data["content"];
    }

    /**
     * @param string $content
     */
    public function setContent(string $content) : void {
        $this->data["content"] = $content;
    }

    /**
     * @param string      $text
     * @param string|null $label
     * @param int         $imageType
     * @param string      $imagePath
     */
    public function addButton(string $text, ?string $label = null, int $imageType = -1, string $imagePath = "") : void {
        $content = ["text" => $text];
        if($imageType !== -1) {
            $content["image"]["type"] = $imageType === 0 ? "path" : "url";
            $content["image"]["data"] = $imagePath;
        }
        $this->data["buttons"][] = $content;
        $this->labelMap[] = $label ?? count($this->labelMap);
    }
}