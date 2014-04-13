<?php
namespace Raptor\Sanitise;
use Raptor;
use HTMLPurifier;

class Example extends Raptor\Example {

    public function renderContent($section, $buffer = null) {
        $result = parent::renderContent($section, $buffer);
        $purifier = new HTMLPurifier();
        $result = $purifier->purify($result);
        return $result;
    }

}
