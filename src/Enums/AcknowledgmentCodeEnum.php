<?php

namespace PlatinumPlace\LaravelDgii\Enums;

enum AcknowledgmentCodeEnum: int
{
    case SPECIFICATION_ERROR = 1;

    case SIGNATURE_ERROR = 2;

    case DUPLICATE_DELIVERY = 3;

    case RNC_MISMATCH = 4;
}
