<?php
class SysMessage {
    const ERROR = 'ERROR';
    const SUCCESS = 'SUCCESS';

    private $type;
    private $message;
    private $extraData;

    public function __construct($type, $message, $extraData = null) {
        $this->type = $type;
        $this->message = $message;
        $this->extraData = $extraData;
    }

    public function getType() {
        return $this->type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getExtraData() {
        return $this->extraData;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setExtraData($extraData) {
        $this->extraData = $extraData;
    }
}
?>