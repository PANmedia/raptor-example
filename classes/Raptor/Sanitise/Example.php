<?php
namespace Raptor\Sanitise;
use Raptor;
use HTMLPurifier;

class Example extends Raptor\Example {

    public function renderContent($id, $buffer = null) {
        $result = parent::renderContent($id, $buffer);
        $purifier = new HTMLPurifier();
        $result = $purifier->purify($result);
        return $result;
    }

}
