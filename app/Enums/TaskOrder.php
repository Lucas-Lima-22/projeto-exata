<?php

namespace App\Enums;

enum TaskOrder:string
{
    case Title = "title";
    case Oldest = "oldest";
    case Latest = "latest";
}

?>