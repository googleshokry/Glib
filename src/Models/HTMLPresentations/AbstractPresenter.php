<?php

namespace Glib\Models\HTMLPresentations;


use Glib\Models\Contracts\HTMLPresenter;

abstract class AbstractPresenter implements HTMLPresenter
{

    public function getTableInformation(): array
    {
        return [];
    }

    public function restrictedInfo(): array
    {
        return [];
        // TODO: Implement restrictedInfo() method.
    }

    public function aliases(): array
    {
        return [];
        // TODO: Implement aliases() method.
    }

    public function moreCols(): array
    {
        return [];
        // TODO: Implement aliases() method.
    }
}